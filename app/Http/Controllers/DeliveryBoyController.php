<?php

namespace App\Http\Controllers;

use App\Models\DeliveryBoy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DeliveryBoyController extends Controller
{
    public function addDeliveryBoy($id = null)
    {
        $deliveryBoy = null;

        if ($id) {
            $deliveryBoy = DeliveryBoy::findOrFail($id);
        }

        return view('admin.pages.delivery_boy.registerboy', compact('deliveryBoy'));
    }

    public function saveDeliveryBoy(Request $request)
    {
        // return $request->all();
        $id = $request->id;

        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|digits:10|unique:delivery_boys,mobile,' . $id,
            'email' => 'nullable|email|max:255|unique:delivery_boys,email,' . $id,
            'password' => $id? 'nullable|string|min:6': 'required|string|min:6',
            'address' => 'nullable|string',
        ]);

        if ($id) {

            $deliveryBoy = DeliveryBoy::findOrFail($id);

        } else {

            $deliveryBoy = new DeliveryBoy();
        }

        $deliveryBoy->name = $request->name;

        $deliveryBoy->mobile = $request->mobile;

        $deliveryBoy->email = $request->email;

        $deliveryBoy->address = $request->address;

        $deliveryBoy->vehicle_type = $request->vehicle_type;

        $deliveryBoy->vehicle_number = $request->vehicle_number;

        $deliveryBoy->is_online = $request->is_online ?? 0;

        $deliveryBoy->is_active = $request->is_active ?? 1;


        if ($request->filled('password')) {

            $deliveryBoy->password = Hash::make($request->password);
        }


        /*
        |--------------------------------------------------------------------------
        | Profile Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('profile_image')) {

            $image = $request->file('profile_image');

            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            $image->move(
                public_path('delivery_boys'),
                $imageName
            );

            $deliveryBoy->profile_image = 'delivery_boys/' . $imageName;
        }


        $deliveryBoy->save();

        if ($id) {
            return redirect()->route('admin.deliveryboy')->with('success', 'Delivery boy updated successfully.');
        }

        return redirect()->route('admin.deliveryboy')->with('success', 'Delivery boy added successfully.');
    }

    

    public function deliveryBoy(Request $request)
    {
        $alldata = DeliveryBoy::all();

        return view('admin.pages.delivery_boy.deliveryboy', compact('alldata'));
    }

    public function toggleDeliveryBoyStatus($id)
    {
        $deliveryBoy = DeliveryBoy::findOrFail($id);
        $deliveryBoy->status = !$deliveryBoy->status;
        $deliveryBoy->save();

        return redirect()->route('admin.deliveryboy')->with('success', 'Delivery boy status updated successfully.');
    }

    public function deleteDeliveryBoy($id)
    {
        $deliveryBoy = DeliveryBoy::findOrFail($id);
        $deliveryBoy->delete();

        return redirect()->route('admin.deliveryboy')->with('success', 'Delivery boy deleted successfully.');
    }
}
