<?php

namespace Database\Seeders;

use App\Models\CheckInCheckout;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            $periods = new CarbonPeriod('2023-01-01', '2023-10-31');
            foreach ($periods as $period) {
                if ($period->format('D') != 'Sat' && $period->format('D') != 'Sun') {
                    CheckInCheckout::create([
                        'user_id' => $user->id,
                        'date' => $period->format('Y-m-d'),
                        'checkin_time' => Carbon::parse($period->format('Y-m-d') . ' ' . '09:00:00')->subMinutes(rand(1, 55)),
                        'checkout_time' => Carbon::parse($period->format('Y-m-d') . ' ' . '18:00:00')->subMinutes(rand(1, 55)),
                    ]);

                }
            }
        }
    }
}
