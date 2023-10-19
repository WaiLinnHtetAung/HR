<?php

namespace Database\Seeders;

use App\Models\CompanySetting;
use Illuminate\Database\Seeder;

class CompanySettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!CompanySetting::exists()) {
            $company_setting = [
                [
                    'id' => 1,
                    'name' => 'GreenLigh Company',
                    'email' => 'greenligt@gmail.com',
                    'phone' => '0942342344',
                    'address' => 'No(322), 2th Floor, Thingangyun, Yangon',
                    'start_time' => '09:00:00',
                    'end_time' => '18:00:00',
                    'break_start_time' => '12:00:00',
                    'break_end_time' => '13:00:00',
                ],
            ];

            CompanySetting::insert($company_setting);
        }
    }
}
