<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // 追加するとseederを利用したデータ生成が可能

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('positions')->insert([
            'name' => 'GK'
        ]);
        DB::table('positions')->insert([
            'name' => 'RSB'
        ]);
        DB::table('positions')->insert([
            'name' => 'LSB'
        ]);
        DB::table('positions')->insert([
            'name' => 'CB'
        ]);
        DB::table('positions')->insert([
            'name' => 'DMF'
        ]);
        DB::table('positions')->insert([
            'name' => 'CMF'
        ]);
        DB::table('positions')->insert([
            'name' => 'OMF'
        ]);
        DB::table('positions')->insert([
            'name' => 'RMF'
        ]);
        DB::table('positions')->insert([
            'name' => 'LMF'
        ]);
        DB::table('positions')->insert([
            'name' => 'RWG'
        ]);
        DB::table('positions')->insert([
            'name' => 'LWG'
        ]);
        DB::table('positions')->insert([
            'name' => 'ST'
        ]);
        DB::table('positions')->insert([
            'name' => 'FW'
        ]);
    }
}
