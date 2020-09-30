<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $confirmation_code = str_random(30);
        $password = Hash::make('admin');
        DB::table('users')->insert([
            'uid' => md5(microtime()),
            'cnic_no' => '123456785451',
            'fatherName' => 'Quisque',
            'email' => 'admin@admin.com',
            'password' => $password,
            'is_active' => 1,
            'role_id' => 1,
            'gender_id' => 1,
            'experience' => 'N/A',
            'qualification' => 'N/A',
            'longitude' => 'N/A',
            'latitude' => 'N/A',
            'device_token' => 'N/A',
            'confirmed' => 0,
            'username' => 'SuperAdmin',
            'profileImage' => 'https://img.icons8.com/ios/50/000000/gender-neutral-user.png',
            'confirmation_code' => $confirmation_code
        ]);
    }
}
