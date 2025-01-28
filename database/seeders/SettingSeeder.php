<?php

namespace Database\Seeders;

use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'rate_charged', 'value' => json_encode(70), 'start_date' => Carbon::now(), 'end_date' => null],
            ['key' => 'basket', 'value' => json_encode(11), 'start_date' => Carbon::now(), 'end_date' => null],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
