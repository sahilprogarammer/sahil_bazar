<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function login()
    {
        return view('admin.auth.login');
    }

    public function authenticate(Request $request)
    {
        // return $request->all();
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if (Auth::guard('admin')->attempt($credentials)) {

            // Prevent session fixation
            $request->session()->regenerate();

            return redirect()->intended(
                route('admin.dashboard')
            );
        }


        return back()
            ->withErrors([
                'email' => 'Invalid email or password.',
            ])
            ->withInput($request->only('email'));
    }


    /**
     * Admin logout
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }



    public function dashboard(Request $request)
    {
        // Default: today
        $fromDate = $request->input(
            'from_date',
            today()->format('Y-m-d')
        );

        $toDate = $request->input(
            'to_date',
            today()->format('Y-m-d')
        );

        /*
    |--------------------------------------------------------------------------
    | Orders for selected date range
    |--------------------------------------------------------------------------
    */

        $orders = Order::whereNot('payment_status', 0)
            ->whereBetween('created_at', [
                $fromDate . ' 00:00:00',
                $toDate . ' 23:59:59'
            ])
            ->get();

        /*
    |--------------------------------------------------------------------------
    | Dashboard statistics
    |--------------------------------------------------------------------------
    */

        $totalOrders = $orders->count();

        $totalRevenue = $orders->sum('total_amount');

        $pendingOrder = $orders
            ->where('order_status', 'pending')
            ->count();

        $completedOrder = $orders
            ->where('order_status', 'delivered')
            ->count();

        $totalUser = User::count();

        /*
    |--------------------------------------------------------------------------
    | ORDER STATUS COUNTS
    |--------------------------------------------------------------------------
    */

        $orderStatusCounts = [

            'pending' => $orders
                ->where('order_status', 'pending')
                ->count(),

            'confirmed' => $orders
                ->where('order_status', 'confirmed')
                ->count(),

            'preparing' => $orders
                ->where('order_status', 'preparing')
                ->count(),

            'out_for_delivery' => $orders
                ->where('order_status', 'out_for_delivery')
                ->count(),

            'delivered' => $orders
                ->where('order_status', 'delivered')
                ->count(),

        ];

        /*
    |--------------------------------------------------------------------------
    | SALES GRAPH
    |--------------------------------------------------------------------------
    */

        $salesData = $orders
            ->groupBy(function ($order) {

                return $order->created_at
                    ->format('Y-m-d');
            })
            ->map(function ($dayOrders) {

                return $dayOrders->sum('total_amount');
            });

        $chartLabels = [];

        $chartData = [];

        $period = \Carbon\CarbonPeriod::create(
            $fromDate,
            $toDate
        );

        foreach ($period as $date) {

            $dateKey = $date->format('Y-m-d');

            $chartLabels[] = $date->format('d M');

            $chartData[] = (float) (
                $salesData[$dateKey] ?? 0
            );
        }

        return view(
            'admin.dashboard.index',
            compact(
                'totalOrders',
                'totalRevenue',
                'pendingOrder',
                'completedOrder',
                'totalUser',
                'fromDate',
                'toDate',
                'chartLabels',
                'chartData',
                'orderStatusCounts'
            )
        );
    }
}
