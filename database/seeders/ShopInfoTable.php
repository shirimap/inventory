<?php

namespace Database\Seeders;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\ShopInfo;
class ShopInfoTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();
        $user = ShopInfo::create([
            'name' => 'KIMARO  COMPANY LIMITED',
            'logo' => 'images/logo.jpg',
            'slogan'=>'Hub For Smart Builders',
            'created_at'=> $date,
            // 'updated_at'=>$date,


        ]);
    }
}
