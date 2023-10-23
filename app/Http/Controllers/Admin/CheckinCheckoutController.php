<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CheckInCheckout;
use App\Models\User;
use Illuminate\Http\Request;

class CheckinCheckoutController extends Controller
{
    public function index()
    {
        return view('admin.checkinout.index');
    }

    public function checkin(Request $request)
    {
        $user = User::where('pin_code', $request->pin_code)->first();

        if (!$user) {
            return [
                'status' => 'fail',
                'message' => 'Pin Code Wrong',
            ];
        }
        if (CheckInCheckout::whereNotNull('checkin_time')->exists()) {
            return [
                'status' => 'fail',
                'message' => 'Already checkin',
            ];
        }

        $checkin = CheckInCheckout::create([
            'user_id' => $user->id,
            'checkin_time' => now(),
        ]);

        return [
            'status' => 'success',
            'message' => 'Successfully Check In at ' . now(),
        ];
    }
}
