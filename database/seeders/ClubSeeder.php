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
        $timestamp = now();

        DB::table('clubs')->insert([
            ['name' => 'FEB', 'coach' => 'Michael Johnson', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['name' => 'FHK', 'coach' => 'Andrew Smith', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['name' => 'FITL', 'coach' => 'Robert Williams', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['name' => 'FPSI', 'coach' => 'Daniel Brown', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['name' => 'FIKOM', 'coach' => 'Christopher Davis', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['name' => 'FT', 'coach' => 'Jonathan Miller', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['name' => 'FAD', 'coach' => 'Anthony Wilson', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['name' => 'FLA', 'coach' => 'Thomas Moore', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['name' => 'FTP', 'coach' => 'Matthew Taylor', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['name' => 'FK', 'coach' => 'Steven Anderson', 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ]);
    }
}
