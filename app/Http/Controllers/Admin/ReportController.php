<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function completeorder(Request $request)
    {
        $query = Order::with([
            'orderItems.product',
            'address'
        ])->where(
            'order_status',
            'delivered'
        );


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


        $orders = $query
            ->latest()
            ->paginate(20);


        // Keep filter values for Blade
        $fromDate = $request->from_date;
        $toDate   = $request->to_date;
        $orderId  = $request->order_id;
        $status   = $request->status;


        return view(
            'admin.pages.report.complete_order',
            compact(
                'orders',
                'fromDate',
                'toDate',
                'orderId',
                'status'
            )
        );
    }

    public function cancelorder(Request $request)
    {
        $query = Order::with([
            'orderItems.product',
            'address'
        ])->where(
            'order_status',
            'canceled'
        );


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


        $orders = $query
            ->latest()
            ->paginate(20);


        // Keep filter values for Blade
        $fromDate = $request->from_date;
        $toDate   = $request->to_date;
        $orderId  = $request->order_id;
        $status   = $request->status;


        return view(
            'admin.pages.report.cancel_order',
            compact(
                'orders',
                'fromDate',
                'toDate',
                'orderId',
                'status'
            )
        );
    }

    public function pendingorder(Request $request)
    {
        $query = Order::with([
            'orderItems.product',
            'address'
        ])->where(
            'order_status',
            'pending'
        );


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


        $orders = $query
            ->latest()
            ->paginate(20);


        // Keep filter values for Blade
        $fromDate = $request->from_date;
        $toDate   = $request->to_date;
        $orderId  = $request->order_id;
        $status   = $request->status;


        return view(
            'admin.pages.report.pending_order',
            compact(
                'orders',
                'fromDate',
                'toDate',
                'orderId',
                'status'
            )
        );
    }
}
