<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\DeliveryCharge;
use App\Models\Order;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function product()
    {
        $products = Product::with([
            'category',
            'subcategory',
        ])
            ->latest()
            ->paginate(10);

        return view(
            'admin.pages.product',
            compact('products')
        );
    }

    public function productAdd()
    {
        $categories = Category::where('status', 'active')
            ->orderBy('name')
            ->get();

        $subcategories = Subcategory::where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('admin.pages.addproduct', compact(
            'categories',
            'subcategories'
        ));
        // return view('admin.pages.addproduct');
    }

    public function order(Request $request)
    {
        $query = Order::with([
            'orderItems.product',
            'address'
        ]);


        // From Date
        if ($request->filled('from_date')) {

            $query->whereDate(
                'created_at',
                '>=',
                $request->from_date
            );
        }


        // To Date
        if ($request->filled('to_date')) {

            $query->whereDate(
                'created_at',
                '<=',
                $request->to_date
            );
        }


        // Default current date
        if (
            !$request->filled('from_date') &&
            !$request->filled('to_date')
        ) {

            $query->whereDate(
                'created_at',
                today()
            );
        }


        // Order ID / Order Number
        if ($request->filled('order_id')) {

            $orderId = $request->order_id;

            $query->where(function ($q) use ($orderId) {

                $q->where(
                    'order_number',
                    'LIKE',
                    '%' . $orderId . '%'
                );

                if (is_numeric($orderId)) {

                    $q->orWhere('id', $orderId);
                }
            });
        }


        // Status
        if ($request->filled('status')) {

            $query->where(
                'order_status',
                $request->status
            );
        }


        $orders = $query
            ->latest()
            ->paginate(20);


        // Keep filter values for Blade
        $fromDate = $request->from_date;
        $toDate   = $request->to_date;
        $orderId  = $request->order_id;
        $status   = $request->status;


        return view(
            'admin.pages.report.order',
            compact(
                'orders',
                'fromDate',
                'toDate',
                'orderId',
                'status'
            )
        );
    }



    //step1
    public function step1(Request $request)
    {
        $categories = Category::where('status', 'active')->get();
        $subcategories = Subcategory::where('status', 'active')->get();

        $product = null;

        // If editing
        if ($request->has('id')) {
            $product = Product::findOrFail($request->id);
        }

        return view('admin.pages.product.step1', compact(
            'categories',
            'subcategories',
            'product'
        ));
    }


    public function step1Save(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'slug' => 'required|string|max:255',

            'category_id' => 'required|exists:categories,id',

            'subcategory_id' => 'nullable|exists:subcategories,id',
        ]);

        // UPDATE

        if ($request->filled('id')) {

            $product = Product::findOrFail($request->id);

            $product->update($validated);

            return redirect()
                ->route('product.step2', ['id' => $product->id])
                ->with('success', 'Product updated successfully.');
        }

        //Create

        $product = Product::create($validated);

        return redirect()
            ->route('product.step2', ['id' => $product->id])
            ->with('success', 'Product created successfully.');
    }

    public function step2($id)
    {
        $product = Product::findOrFail($id);

        return view(
            'admin.pages.product.step2',
            compact('product')
        );
    }

    public function step2Save(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'unit' => 'required|in:kg,gram,piece,packet,liter',

            'minimum_order_qty' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'discount_price' => [
                'nullable',
                'numeric',
                'min:0',
                'lt:price',
            ],
        ]);

        $product->update([
            'unit' => $validated['unit'],
            'minimum_order_qty' => $validated['minimum_order_qty'],
            'price' => $validated['price'],
            'discount_price' => $validated['discount_price'] ?? null,
        ]);

        return redirect()
            ->route('product.step3', ['id' => $product->id])
            ->with('success', 'Pricing & stock updated successfully.');
    }


    public function step3($id)
    {
        $product = Product::findOrFail($id);

        return view(
            'admin.pages.product.step3',
            compact('product')
        );
    }

    public function step3Save(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'short_description' => [
                'nullable',
                'string',
                'max:500',
            ],

            'long_description' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'images' => [
                'nullable',
                'array',
                'max:10',
            ],

            'images.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);



        $images = $product->images ?? [];


        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {

                $fileName =
                    time() .
                    '_' .
                    uniqid() .
                    '.' .
                    $image->getClientOriginalExtension();

                // public/products
                $image->move(
                    public_path('products'),
                    $fileName
                );

                // Save path in database
                $images[] = 'products/' . $fileName;
            }
        }
        $product->update([
            'short_desc' => $validated['short_description'] ?? null,

            'long_desc' => $validated['long_description'] ?? null,

            'images' => $images,
        ]);


        return redirect()
            ->route('product.step4', [
                'id' => $product->id,
            ])
            ->with(
                'success',
                'Product media and details saved successfully.'
            );
    }


    public function step4($id)
    {
        $product = Product::with([
            'category',
            'subcategory'
        ])->findOrFail($id);

        return view(
            'admin.pages.product.step4',
            compact('product')
        );
    }


    public function toggleStatus($id)
    {
        $product = Product::findOrFail($id);

        $product->status = $product->status === 'active'
            ? 'inactive'
            : 'active';

        $product->save();

        return back()->with('success', 'Product status updated successfully.');
    }


    // Delivery Charges
    public function deliverycharges(Request $request)
    {
        // $deliveryCharges = Product::select('delivery_charges')
        //     ->first();

        $deliveryCharges = DeliveryCharge::latest()->get();

        return view(
            'admin.pages.delivery-charges',
            compact('deliveryCharges')
        );
    }

    public function addDeliverycharges(Request $request)
    {
        $validated = $request->validate([
            'min_distance'     => 'required|numeric|min:0',
            'max_distance'     => 'required|numeric|gt:min_distance',
            'min_order_amount' => 'required|numeric|min:0',
            'max_order_amount' => 'required|numeric|gte:min_order_amount',
            'charge'           => 'required|numeric|min:0',
            'is_active'        => 'nullable|boolean',
        ]);

        // Checkbox
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        if (isset($request->id)) {
            $deliveryCharge = DeliveryCharge::findOrFail($request->id);

            $deliveryCharge->update($validated);

            return redirect()
                ->route('admin.deliverycharges')
                ->with('success', 'Delivery charges updated successfully.');
        } else {

            // ADD
            DeliveryCharge::create($validated);

            return redirect()
                ->route('admin.deliverycharges')
                ->with('success', 'Delivery charges added successfully.');
        }
    }
}
