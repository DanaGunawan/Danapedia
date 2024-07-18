<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Str;
use App\Models\brands;


class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminId = DB::table('users')->where('name','admin')->where('is_admin',1)->value('id');
        $brands = [
            [
                'name' => 'revoir',
                'slug' => Str::slug('revoir'),
                'created_by' => $adminId,
                'is_deleted' => 0,
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(), 

            ]
        ];
        foreach($brands as $brand){
            brands::create($brand);
        }
    }
}
