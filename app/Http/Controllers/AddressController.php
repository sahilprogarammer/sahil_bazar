<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function getAddresses()
    {
        $addresses = Address::where('user_id', Auth::id())
            ->orderByDesc('is_default')
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'addresses' => $addresses,
        ]);
    }

    public function address()
    {
        return view('frontend.components.address');
    }

    public function addressStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'mobile' => [
                'required',
                'string',
                'regex:/^[0-9]{10}$/',
            ],

            'address_type' => 'required|in:home,work,other',

            'house_no' => 'required|string|max:255',
            'street'   => 'required|string|max:255',
            'landmark' => 'nullable|string|max:255',

            // 'city'    => 'required|string|max:255',
            // 'state'   => 'required|string|max:255',

            // 'pincode' => [
            //     'required',
            //     'string',
            //     'regex:/^[0-9]{6}$/',
            // ],

            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',

            'is_default' => 'nullable|boolean',
        ]);

        $user = Auth::user();

        DB::transaction(function () use ($validated, $user, &$address) {

            $isDefault = !empty($validated['is_default']);

            $hasAddress = Address::where('user_id', $user->id)->exists();

            if (!$hasAddress) {
                $isDefault = true;
            }

            if ($isDefault) {
                Address::where('user_id', $user->id)
                    ->update([
                        'is_default' => false,
                    ]);
            }


            $fullAddress = collect([
                $validated['house_no'] ?? null,
                $validated['street'] ?? null,
                $validated['landmark'] ?? null,
                $validated['city'] ?? null,
                $validated['state'] ?? null,
                $validated['pincode'] ?? null,
            ])
                ->filter()
                ->implode(', ');


            $address = Address::create([
                'user_id' => $user->id,

                'name' => $validated['name'],
                'mobile' => $validated['mobile'],

                'address_type' => $validated['address_type'],

                'house_no' => $validated['house_no'],
                'street' => $validated['street'],
                'area' => $validated['street'],
                'landmark' => $validated['landmark'] ?? null,

                // 'city' => $validated['city'],
                // 'state' => $validated['state'],
                // 'pincode' => $validated['pincode'],

                'latitude' => $validated['latitude'] ?? null,
                'longitude' => $validated['longitude'] ?? null,

                'full_address' => $fullAddress,

                'is_default' => $isDefault,
            ]);
        });


        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Address saved successfully.',
                'address' => $address,
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'Address saved successfully.');
    }

    public function addressUpdate(Request $request, Address $address)
    {
        // Only the owner can edit
        abort_if($address->user_id !== Auth::id(), 403);

        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'mobile' => [
                'required',
                'string',
                'regex:/^[0-9]{10}$/',
            ],

            'address_type' => 'required|in:home,work,other',

            'house_no' => 'required|string|max:255',
            'street'   => 'required|string|max:255',
            'landmark' => 'nullable|string|max:255',

            // 'city'    => 'sometimes|required|string|max:255',
            // 'state'   => 'sometimes|required|string|max:255',

            // 'pincode' => [
            //     'sometimes',
            //     'required',
            //     'string',
            //     'regex:/^[0-9]{6}$/',
            // ],

            'latitude'  => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',

            'is_default' => 'nullable|boolean',
        ]);

        DB::transaction(function () use ($validated, $address, $request) {

            // Keep it default if it already is one. The user changes the default
            // by choosing another address, so the user is never left without one.
            $isDefault = $request->boolean('is_default') || $address->is_default;

            if ($isDefault) {
                Address::where('user_id', $address->user_id)
                    ->where('id', '!=', $address->id)
                    ->update(['is_default' => false]);
            }

            // Use the new value if sent, otherwise keep the existing one
            $city    = $validated['city']    ?? $address->city;
            $state   = $validated['state']   ?? $address->state;
            $pincode = $validated['pincode'] ?? $address->pincode;

            $fullAddress = collect([
                $validated['house_no'],
                $validated['street'],
                $validated['landmark'] ?? null,
                $city,
                $state,
                $pincode,
            ])
                ->filter()
                ->implode(', ');

            $address->update([
                'name'         => $validated['name'],
                'mobile'       => $validated['mobile'],
                'address_type' => $validated['address_type'],

                'house_no' => $validated['house_no'],
                'street'   => $validated['street'],
                'area'     => $validated['street'],
                'landmark' => $validated['landmark'] ?? null,

                // 'city'    => $city,
                // 'state'   => $state,
                // 'pincode' => $pincode,

                'latitude'  => $validated['latitude']  ?? null,
                'longitude' => $validated['longitude'] ?? null,

                'full_address' => $fullAddress,
                'is_default'   => $isDefault,
            ]);
        });

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Address updated successfully.',
                'address' => $address->fresh(),
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'Address updated successfully.');
    }

    public function setDefault(Request $request)
    {
        $request->validate([
            'address_id' => 'required|integer|exists:addresses,id',
        ]);

        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Please login first.',
            ], 401);
        }

        $user_id = $user->id;

        /*
    |--------------------------------------------------------------------------
    | Find address belonging to logged-in user
    |--------------------------------------------------------------------------
    */

        $address = Address::where('id', $request->address_id)
            ->where('user_id', $user_id)
            ->first();

        if (!$address) {
            return response()->json([
                'success' => false,
                'message' => 'Address not found.',
            ], 404);
        }

        /*
    |--------------------------------------------------------------------------
    | Already default
    |--------------------------------------------------------------------------
    */

        if ((int) $address->is_default === 1) {

            return response()->json([
                'success' => true,
                'message' => 'This address is already your default address.',
                'address' => $address->fresh(),
            ]);
        }

        /*
    |--------------------------------------------------------------------------
    | Remove default from current user's other addresses
    |--------------------------------------------------------------------------
    */

        Address::where('user_id', $user_id)
            ->where('id', '!=', $address->id)
            ->update([
                'is_default' => 0
            ]);

        /*
    |--------------------------------------------------------------------------
    | Set selected address as default
    |--------------------------------------------------------------------------
    */

        $address->update([
            'is_default' => 1
        ]);

        /*
    |--------------------------------------------------------------------------
    | Response
    |--------------------------------------------------------------------------
    */

        return response()->json([
            'success' => true,
            'message' => 'Default address updated successfully.',
            'address' => $address->fresh(),
        ]);
    }
}
