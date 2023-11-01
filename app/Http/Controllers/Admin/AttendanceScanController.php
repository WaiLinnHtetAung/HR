<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CheckInCheckout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AttendanceScanController extends Controller
{
    public function index()
    {
        return view('admin.attendance_scan.index');
    }

    public function store(Request $request)
    {
        $value = $request->value;

        if (now()->format('D') == 'Sat' || now()->format('D') == 'Sun') {
            return [
                'status' => 'fail',
                'message' => 'Today is off day.',
            ];
        }

        if (Hash::check(date('Y-m-d'), $value)) {

            $user = auth()->user();
            $checkin_checkout_data = CheckInCheckout::firstOrCreate(
                [
                    'user_id' => $user->id,
                    'date' => now()->format('Y-m-d'),
                ]
            );

            // checkin or checkout
            if (!$checkin_checkout_data->checkin_time) {
                $checkin_checkout_data->update(['checkin_time' => now()]);

                return [
                    'status' => 'success',
                    'message' => 'Successfully check in at .' . now(),
                ];
            } else if (!$checkin_checkout_data->checkout_time) {
                $checkin_checkout_data->update(['checkout_time' => now()]);
                return [
                    'status' => 'success',
                    'message' => 'Successfully check out at .' . now(),
                ];
            } else {
                return [
                    'status' => 'fail',
                    'message' => 'Already Checkin & Checkout for today',
                ];
            }

        } else {
            return [
                'status' => 'fail',
                'message' => 'Your QR is not valid',
            ];
        }

    }

}
