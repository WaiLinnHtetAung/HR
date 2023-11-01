<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CheckInCheckout;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CheckinCheckoutController extends Controller
{
    public function index()
    {
        $hash = Hash::make(date('Y-m-d'));

        return view('admin.checkinout.index', compact('hash'));
    }

    public function checkinCheckout(Request $request)
    {
        if (now()->format('D') == 'Sat' || now()->format('D') == 'Sun') {
            return [
                'status' => 'fail',
                'message' => 'Today is off day.',
            ];
        }

        $user = User::where('pin_code', $request->pin_code)->first();

        if (!$user) {
            return [
                'status' => 'fail',
                'message' => 'Pin Code Wrong',
            ];
        }

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

    }
}
