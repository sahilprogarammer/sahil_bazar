<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\DeliveryCharge;
use App\Models\Order;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'available_from' => $request->available_from,
            'available_until' => $request->available_until,
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


    public function allUnavailability(Request $request)
    {
        $data = DB::table('product_availabilities')
            ->leftJoin(
                'subcategories',
                'product_availabilities.subcategory_id',
                '=',
                'subcategories.id'
            )
            ->leftJoin(
                'products',
                'product_availabilities.product_id',
                '=',
                'products.id'
            )
            ->select(
                'product_availabilities.subcategory_id',
                'product_availabilities.product_id',
                'subcategories.name as subcategory_name',
                'product_availabilities.date',
                'product_availabilities.availability_status',
                'products.name as product_name'
            )
            ->orderByDesc('product_availabilities.date')
            ->get()

            // Group by subcategory, date, and status.
            ->groupBy(function ($item) {
                return $item->subcategory_id . '_' .
                    $item->date . '_' .
                    $item->availability_status;
            })

            // Prepare grouped data for the Blade view.
            ->map(function ($items) {
                $first = $items->first();

                return (object) [
                    'subcategory_id' => $first->subcategory_id,

                    'subcategory_name' => $first->subcategory_name,

                    'date' => $first->date,

                    'availability_status' => $first->availability_status,

                    // Actual product IDs for Edit modal selection.
                    'product_ids' => $items
                        ->pluck('product_id')
                        ->filter()
                        ->unique()
                        ->values()
                        ->all(),

                    // Product names for displaying in the table.
                    'products' => $items
                        ->pluck('product_name')
                        ->filter()
                        ->unique()
                        ->values(),
                ];
            })
            ->values();

        return view(
            'admin.pages.unavailable.all-unavailable',
            compact('data')
        );
    }

    public function subcategories()
    {
        $subcategories = Subcategory::query()
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json([
            'subcategories' => $subcategories,
        ]);
    }

    public function products(Subcategory $subcategory)
    {
        $products = Product::query()
            ->where('subcategory_id', $subcategory->id)
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json([
            'products' => $products,
        ]);
    }

    public function availabilityStore(Request $request)
    {
        $validated = $request->validate([
            'subcategory_id'      => ['required', 'integer', 'exists:subcategories,id'],
            'product_ids'         => ['required', 'array', 'min:1'],
            'product_ids.*'       => ['required', 'integer', 'distinct', 'exists:products,id'],
            'date'                => ['required', 'date_format:Y-m-d'],
            'availability_status' => ['required', 'in:available,out_of_stock'],

            // edit-only fields
            'is_edit'             => ['nullable', 'in:0,1'],
            'old_subcategory_id'  => ['required_if:is_edit,1', 'nullable', 'integer'],
            'old_date'            => ['required_if:is_edit,1', 'nullable', 'date_format:Y-m-d'],
            'old_product_ids'     => ['required_if:is_edit,1', 'nullable', 'string'],
        ]);

        $isEdit = ($validated['is_edit'] ?? '0') === '1';
        $now    = now();

        DB::transaction(function () use ($validated, $isEdit, $now) {

            // ---------- EDIT: remove the old records first ----------
            if ($isEdit) {
                $oldProductIds = json_decode($validated['old_product_ids'], true);

                if (!is_array($oldProductIds)) {
                    $oldProductIds = [];
                }

                DB::table('product_availabilities')
                    ->where('subcategory_id', $validated['old_subcategory_id'])
                    ->where('date', $validated['old_date'])
                    ->whereIn('product_id', $oldProductIds)
                    ->delete();
            }

            // ---------- Avoid duplicates: one status per product per date ----------
            DB::table('product_availabilities')
                ->where('date', $validated['date'])
                ->whereIn('product_id', $validated['product_ids'])
                ->delete();

            // ---------- Insert the new rows ----------
            $rows = collect($validated['product_ids'])
                ->map(function ($productId) use ($validated, $now) {
                    return [
                        'subcategory_id'      => $validated['subcategory_id'],
                        'product_id'          => $productId,
                        'date'                => $validated['date'],
                        'availability_status' => $validated['availability_status'],
                        'created_at'          => $now,
                        'updated_at'          => $now,
                    ];
                })
                ->all();

            DB::table('product_availabilities')->insert($rows);
        });

        return redirect()
            ->back()
            ->with('success', $isEdit
                ? 'Product availability updated successfully.'
                : 'Product availability saved successfully.');
    }

    public function availabilityDestroy(Request $request)
    {
        $validated = $request->validate([
            'subcategory_id' => ['required', 'integer'],
            'product_ids'    => ['required', 'array', 'min:1'],
            'product_ids.*'  => ['required', 'integer'],
            'date'           => ['required', 'date_format:Y-m-d'],
        ]);

        $deleted = DB::table('product_availabilities')
            ->where('subcategory_id', $validated['subcategory_id'])
            ->where('date', $validated['date'])
            ->whereIn('product_id', $validated['product_ids'])
            ->delete();

        if ($deleted === 0) {
            return redirect()
                ->back()
                ->with('error', 'No availability records were found to delete.');
        }

        return redirect()
            ->back()
            ->with('success', 'Product availability deleted successfully.');
    }
}
