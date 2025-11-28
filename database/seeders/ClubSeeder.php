<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clubs')->insert([
            [
                'name' => 'FEB',
                'coach' => 'Michael Johnson'
            ],
            [
                'name' => 'FHK',
                'coach' => 'Andrew Smith'
            ],
            [
                'name' => 'FITL',
                'coach' => 'Robert Williams'
            ],
            [
                'name' => 'FPSI',
                'coach' => 'Daniel Brown'
            ],
            [
                'name' => 'FIKOM',
                'coach' => 'Christopher Davis'
            ],
            [
                'name' => 'FT',
                'coach' => 'Jonathan Miller'
            ],
            [
                'name' => 'FAD',
                'coach' => 'Anthony Wilson' 
            ],
            [
                'name' => 'FLA',
                'coach' => 'Thomas Moore'
            ],
            [
                'name' => 'FTP',
                'coach' => 'Matthew Taylor'
            ],
            [
                'name' => 'FK',
                'coach' => 'Steven Anderson'
            ]
        ]);
    }
}
