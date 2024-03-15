<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('bankuser')->insert([
            [
                "user_id" => 1,
                "name" => "Atta Halilintar",
                "date_of_birth" => "2012-12-12",
                "email" => "annomaker@gmail.com",
                "phone_number" => "+62123456789",
                "account_number" => "MANDIRI123490"
            ],
            [
                "user_id" => 2,
                "name" => "Dewi Dyah",
                "date_of_birth" => "2012-12-12",
                "email" => "dewidyah@gmail.com",
                "phone_number" => "+62123456789",
                "account_number" => "MANDIRI153490"
            ],
        ]);
    }
}
