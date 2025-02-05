<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;
use Carbon\Carbon;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'rate_charged', 'value' => 70, 'start_date' => Carbon::now(), 'end_date' => null],
            ['key' => 'basket', 'value' => 11, 'start_date' => Carbon::now(), 'end_date' => null],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
