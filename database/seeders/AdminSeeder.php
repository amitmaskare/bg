<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'name' => 'Bargain',
            'email' =>'admin@gmail.com',
            'password' =>Hash::make(123456),
            'designationId'=>'admin',
            'status'=>'Active',
            'created_at' => Carbon::now(), 
            'updated_at' => Carbon::now(),
        ]);
    }
}
