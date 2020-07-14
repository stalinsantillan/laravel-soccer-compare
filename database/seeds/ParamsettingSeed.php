<?php

use Illuminate\Database\Seeder;
use App\Models\User\Paramsetting;

class ParamsettingSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paramsetting = Paramsetting::create();
    }
}
