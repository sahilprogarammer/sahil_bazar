<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Address;
use App\Models\Category;
use App\Models\DeliveryCharge;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function home()
    {
        $categories = Category::where('status', 'active')
            ->with([
                'subcategories' => function ($query) {
                    $query->where('status', 'active');
                }
            ])
            ->get();

        // return $categories;
        $popularProducts = Product::where('status', 'active')->where('is_popular', 1)->get();

        // return $popularProducts;

        $defaultAddress = null;

        if (Auth::check()) {
            $defaultAddress = Address::where('user_id', Auth::id())
                ->where('is_default', 1)
                ->first();
        }

        // return $defaultAddress;

        return view('frontend.pages.home', compact('categories', 'popularProducts', 'defaultAddress'));
    }

    public function category(Category $category)
    {
        $category->load([
            'subcategories' => function ($query) {
                $query->where('status', 'active');
            }
        ]);

        return view('frontend.pages.categories', compact('category'));
    }

    public function subcategory(Category $category, Subcategory $subcategory)
    {
        if (
            $category->status !== 'active' ||
            $subcategory->status !== 'active' ||
            $subcategory->category_id != $category->id
        ) {
            abort(404);
        }

        $products = $subcategory->products()
            ->where('status', 'active')
            ->paginate(12);

        // return $products;

        // return [$category,$subcategory,$products];

        return view(
            'frontend.pages.products',
            compact('category', 'subcategory', 'products')
        );
    }

    public function cart()
    {
        $defaultAddress = null;

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $defaultAddress = Address::where('user_id', $user_id)
                ->where('is_default', 1)
                ->first();
        }

        $deliveryCharges = DeliveryCharge::where('is_active', 1)
            ->orderBy('min_distance')
            ->orderBy('min_order_amount')
            ->get();

        // return $defaultAddress;
        return view('frontend.pages.cart', compact('defaultAddress', 'deliveryCharges'));
    }



    public function orderSubmit(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Please login before placing order.',
            ], 401);
        }

        $request->validate([
            'address_id' => 'required|integer|exists:addresses,id',
            'cart' => 'required|string',
        ]);

        $cart = json_decode($request->cart, true);

        if (!is_array($cart) || empty($cart)) {
            return response()->json([
                'success' => false,
                'message' => 'Your cart is empty.',
            ], 422);
        }

        $address = Address::where('id', $request->address_id)
            ->where('user_id', $user->id)
            ->first();

        if (!$address) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid delivery address.',
            ], 422);
        }

        /*
    |--------------------------------------------------------------------------
    | Calculate Subtotal
    |--------------------------------------------------------------------------
    */

        $subtotal = 0;

        foreach ($cart as $item) {
            $subtotal += (float) ($item['total_price'] ?? 0);
        }

        $subtotal = round($subtotal, 2);


        $discount = 0;
        $deliveryCharge = 0;
        $tax = 0;

        $deliveryDistance = 0;

        $deliveryRules = \App\Models\DeliveryCharge::where('is_active', 1)
            ->orderBy('min_distance')
            ->get();

        foreach ($deliveryRules as $rule) {

            $minDistance = (float) $rule->min_distance;
            $maxDistance = (float) $rule->max_distance;
            $minAmount = (float) $rule->min_order_amount;
            $maxAmount = (float) $rule->max_order_amount;

            $distanceMatches =
                $deliveryDistance >= $minDistance &&
                $deliveryDistance <= $maxDistance;

            $amountMatches =
                $subtotal >= $minAmount &&
                ($maxAmount <= 0 || $subtotal <= $maxAmount);

            if ($distanceMatches && $amountMatches) {
                $deliveryCharge = (float) $rule->charge;
                break;
            }
        }

        $totalAmount = round(
            $subtotal - $discount + $deliveryCharge + $tax,
            2
        );


        DB::beginTransaction();

        try {

            $orderNumber = 'NB' . strtoupper(Str::random(4));

            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => $orderNumber,
                'address_id' => $address->id,

                'subtotal' => $subtotal,
                'discount' => $discount,
                'delivery_charge' => $deliveryCharge,
                'tax' => $tax,
                'total_amount' => $totalAmount,

                'payment_method' => $request->payment_method,
                'payment_status' => 0,
                'order_status' => 'pending',
                'notes' => $request->notes ?? null,
                'placed_at' => now(),
            ]);

            foreach ($cart as $item) {

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'] ?? null,
                    'product_name' => $item['name'] ?? '',
                    'quantity' => $item['quantity'] ?? 0,
                    'unit' => $item['unit'] ?? null,
                    'price' => $item['price'] ?? 0,
                    'discount_price' => $item['discount_price'] ?? 0,
                    'selling_price' => $item['selling_price'] ?? 0,
                    'total_price' => $item['total_price'] ?? 0,
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully.',

                'order_id' => $order->id,
                'order_number' => $order->order_number,

                'subtotal' => $subtotal,
                'delivery_charge' => $deliveryCharge,
                'discount' => $discount,
                'tax' => $tax,
                'total_amount' => $totalAmount,

                'redirect' => route('check-out', [
                    'subtotal' => $subtotal,
                    'deliveryCharge' => $deliveryCharge,
                    'totalAmount' => $totalAmount,
                    'addressId' => $address->id,
                ]),
            ]);
        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error('Order placement failed', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Unable to place order. Please try again.',
            ], 500);
        }
    }


    public function profile()
    {
        $user = Auth::user();
        // return $user;
        $orderCount = Order::where('user_id', $user->id)->count();
        $addressCount = Address::where('user_id', $user->id)->count();
        // return [$orderCount, $addressCount];
        return view('frontend.pages.profile', compact('user', 'orderCount', 'addressCount'));
    }


    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Please login first.'
            ], 401);
        }

        /*
    |--------------------------------------------------------------------------
    | Validation
    |--------------------------------------------------------------------------
    */

        $request->validate([
            'name' => 'required|string|max:100',

            'email' => [
                'nullable',
                'email',
                'max:150',
                'unique:users,email,' . $user->id,
            ],

            'profile_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);


        /*
    |--------------------------------------------------------------------------
    | Update Data
    |--------------------------------------------------------------------------
    */

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];


        /*
    |--------------------------------------------------------------------------
    | Profile Image
    |--------------------------------------------------------------------------
    */

        if ($request->hasFile('profile_image')) {

            $file = $request->file('profile_image');

            $folder = public_path('profiles');

            // Create folder if not exists
            if (!File::exists($folder)) {
                File::makeDirectory(
                    $folder,
                    0755,
                    true
                );
            }


            /*
        |--------------------------------------------------------------------------
        | Delete Old Image
        |--------------------------------------------------------------------------
        */

            if (
                !empty($user->profile_image) &&
                File::exists(
                    $folder . '/' . $user->profile_image
                )
            ) {
                File::delete(
                    $folder . '/' . $user->profile_image
                );
            }


            /*
        |--------------------------------------------------------------------------
        | New Image
        |--------------------------------------------------------------------------
        */

            $filename =
                time() . '_' .
                uniqid() . '.' .
                $file->getClientOriginalExtension();


            $file->move(
                $folder,
                $filename
            );


            // Only change image when new image is selected
            $data['profile_image'] = $filename;
        }


        /*
    |--------------------------------------------------------------------------
    | Update User
    |--------------------------------------------------------------------------
    */

        User::where('id', $user->id)->update($data);


        /*
    |--------------------------------------------------------------------------
    | Get Updated User
    |--------------------------------------------------------------------------
    */

        $user = User::find($user->id);


        /*
    |--------------------------------------------------------------------------
    | Response
    |--------------------------------------------------------------------------
    */

        return response()->json([

            'success' => true,

            'message' => 'Profile updated successfully.',

            'user' => [

                'id' => $user->id,

                'name' => $user->name,

                'email' => $user->email,

                'mobile' => $user->mobile,

                'profile_image' => $user->profile_image
                    ? asset(
                        'profiles/' .
                            $user->profile_image
                    )
                    : null,
            ],

        ]);
    }

    public function myOrders()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('home');
        }

        $orders = Order::with('orderItems')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        // return $orders;

        return view('frontend.pages.myorder', compact('orders'));
    }

    public function orderCancel($id)
    {
        $userId = Auth::user()->id;
        $order = Order::where('order_number', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        if ($order->order_status !== 'pending') {
            return back()->with(
                'error',
                'This order cannot be cancelled.'
            );
        }

        $order->order_status = 'cancelled';
        $order->payment_status = 3; // Mark payment status as cancelled
        $order->save();

        return back()->with(
            'success',
            'Your order has been cancelled successfully.'
        );
    }



    public function checkout()
    {
        // return $orderId = session('checkout_order_id');
        return view('frontend.pages.checkout');
    }

    public function refresh(Request $request)
    {
        $validated = $request->validate([
            'cart' => ['required', 'array'],
            'cart.*.product_id' => ['required', 'integer'],
            'cart.*.quantity' => ['required', 'numeric', 'min:0.01'],
        ]);

        $cart = $validated['cart'];

        $productIds = collect($cart)
            ->pluck('product_id')
            ->unique()
            ->values();

        $products = DB::table('products')
            ->whereIn('id', $productIds)
            ->get()
            ->keyBy('id');

        $items = [];

        foreach ($cart as $cartItem) {
            $product = $products->get($cartItem['product_id']);

            // Ignore products that no longer exist.
            if (!$product) {
                continue;
            }

            $quantity = (float) $cartItem['quantity'];
            $unit = strtolower($product->unit ?? 'gram');

            $price = (float) $product->price;
            $discountPrice = (float) ($product->discount_price ?? 0);

            // Always use the latest database price.
            $sellingPrice = $discountPrice > 0
                ? $discountPrice
                : $price;

            $minimumQty = (float) ($product->minimum_order_qty ?? 0);

            // Calculate total using the latest database price.
            switch ($unit) {
                case 'gram':
                    $totalPrice = ($quantity / 1000) * $sellingPrice;
                    break;

                case 'piece':
                    $totalPrice = $minimumQty > 0
                        ? ($quantity * $sellingPrice / $minimumQty)
                        : 0;
                    break;

                case 'kg':
                case 'packet':
                case 'liter':
                default:
                    $totalPrice = $quantity * $sellingPrice;
                    break;
            }

            // Handle product images stored as JSON or a string.
            $images = $product->images ?? null;

            if (is_string($images)) {
                $decodedImages = json_decode($images, true);

                if (json_last_error() === JSON_ERROR_NONE) {
                    $images = $decodedImages;
                } else {
                    $images = [$images];
                }
            }

            $image = is_array($images)
                ? ($images[0] ?? '')
                : '';

            $items[] = [
                'product_id' => (string) $product->id,
                'name' => $product->name,
                'quantity' => $quantity,
                'unit' => $unit,
                'price' => $price,
                'discount_price' => $discountPrice,
                'selling_price' => $sellingPrice,
                'minimum_order_qty' => $minimumQty,
                'total_price' => round($totalPrice, 2),
                'image' => $image
                    ? asset(ltrim($image, '/'))
                    : '',
            ];
        }

        return response()->json([
            'success' => true,
            'items' => $items,
        ]);
    }

    public function explore()
    {
        $subcategories = Subcategory::with('category')
            ->where('status', 1)
            ->orderBy('name', 'asc')
            ->get();
        // return $subcategories;
        return view('frontend.pages.explore', compact('subcategories'));
    }

    public function location()
    {
        return view('frontend/location');
    }

    public function aboutUs()
    {
        return view('frontend.pages.about-us');
    }

    public function helpSupport()
    {
        return view('frontend.pages.help-support');
    }
}
