<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category()
    {
        $categories = Category::latest()->get();
        return view('admin.pages.category', compact('categories'));
    }

    public function addCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'type' => 'required|in:veg,nonveg',
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        // =========================================
        // UPDATE CATEGORY
        // =========================================

        if ($request->id) {

            $category = Category::findOrFail($request->id);

            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->type = $request->type;
            $category->status = $request->status;
            $category->description = $request->description;


            // =====================================
            // UPDATE IMAGE
            // =====================================

            if ($request->hasFile('image')) {

                // Delete old image
                if (
                    $category->image &&
                    file_exists(public_path($category->image))
                ) {
                    unlink(public_path($category->image));
                }


                // Upload new image
                $image = $request->file('image');

                $imageName = time() . '_' .
                    uniqid() . '.' .
                    $image->getClientOriginalExtension();

                $image->move(
                    public_path('categories'),
                    $imageName
                );

                $category->image = 'categories/' . $imageName;
            }


            $category->save();


            return back()->with(
                'success',
                'Category updated successfully.'
            );
        }


        // =========================================
        // ADD CATEGORY
        // =========================================

        $category = new Category();

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->type = $request->type;
        $category->status = $request->status;
        $category->description = $request->description;


        // =========================================
        // UPLOAD IMAGE
        // =========================================

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $imageName = time() . '_' .
                uniqid() . '.' .
                $image->getClientOriginalExtension();

            $image->move(
                public_path('categories'),
                $imageName
            );

            $category->image = 'categories/' . $imageName;
        }


        $category->save();


        return back()->with(
            'success',
            'Category created successfully.'
        );
    }

    public function subcategory()
    {
        $subcategories = Subcategory::with('category')
            ->latest()
            ->get();

        $categories = Category::where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('admin.pages.subcategory', compact(
            'subcategories',
            'categories'
        ));
    }

    public function addSubcategory(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'       => 'required|string|max:255',
            'slug'       => 'required|string|max:255',
            'type'       => 'required|in:veg,nonveg',
            'status'     => 'required|in:active,inactive',
            'description' => 'nullable|string',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // =========================================
        // UPDATE SUBCATEGORY
        // =========================================

        if ($request->id) {

            $subcategory = Subcategory::findOrFail($request->id);

            $subcategory->category_id = $request->category_id;
            $subcategory->name        = $request->name;
            $subcategory->slug        = $request->slug;
            $subcategory->type        = $request->type;
            $subcategory->status      = $request->status;
            $subcategory->description = $request->description;

            // =====================================
            // UPDATE IMAGE
            // =====================================

            if ($request->hasFile('image')) {

                // Delete old image
                if (
                    $subcategory->image &&
                    file_exists(public_path($subcategory->image))
                ) {
                    unlink(public_path($subcategory->image));
                }

                // Upload new image
                $image = $request->file('image');

                $imageName = time() . '_' .
                    uniqid() . '.' .
                    $image->getClientOriginalExtension();

                // Make sure folder exists
                if (!file_exists(public_path('subcategories'))) {
                    mkdir(public_path('subcategories'), 0755, true);
                }

                $image->move(
                    public_path('subcategories'),
                    $imageName
                );

                $subcategory->image = 'subcategories/' . $imageName;
            }

            $subcategory->save();

            return back()->with(
                'success',
                'Subcategory updated successfully.'
            );
        }

        // =========================================
        // ADD SUBCATEGORY
        // =========================================

        $subcategory = new Subcategory();

        $subcategory->category_id = $request->category_id;
        $subcategory->name        = $request->name;
        $subcategory->slug        = $request->slug;
        $subcategory->type        = $request->type;
        $subcategory->status      = $request->status;
        $subcategory->description = $request->description;

        // =========================================
        // UPLOAD IMAGE
        // =========================================

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $imageName = time() . '_' .
                uniqid() . '.' .
                $image->getClientOriginalExtension();

            // Make sure folder exists
            if (!file_exists(public_path('subcategories'))) {
                mkdir(public_path('subcategories'), 0755, true);
            }

            $image->move(
                public_path('subcategories'),
                $imageName
            );

            $subcategory->image = 'subcategories/' . $imageName;
        }

        $subcategory->save();

        return back()->with(
            'success',
            'Subcategory created successfully.'
        );
    }
}
