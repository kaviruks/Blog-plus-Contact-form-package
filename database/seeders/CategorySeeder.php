<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'title' => 'Apartment 1',
            'meta_title' => 'apartment',
            'content' => 'abc',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('categories')->insert([
            'parent_id' => '1',
            'title' => 'Apartment 1.1',
            'meta_title' => 'apartment',
            'content' => 'asd',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('categories')->insert([
            'parent_id' => '1',
            'title' => 'Apartment 1.2',
            'meta_title' => 'apartment',
            'content' => 'qwe',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('categories')->insert([
            'title' => 'Apartment 2',
            'meta_title' => 'apartment',
            'content' => 'asd',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('categories')->insert([
            'title' => 'Apartment 3',
            'meta_title' => 'apartment',
            'content' => 'asd',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
