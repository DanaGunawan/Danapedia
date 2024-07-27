<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;
use App\Models\Category;
use Illuminate\Support\Facades\DB;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminId = DB::table('users')->where('name','admin')->where('is_admin',1)->value('id');

        $categories = [
            [
                'name' => 'Baju',
                'slug' => Str::slug('Baju'),
                'meta_title' => ' Baju',
                'meta_description' => 'Koleksi berbagai jenis baju',
                'meta_keywords' => 'baju, fashion, pakaian',
                'status' => 'Active',
                'is_deleted' => 0,
                'created_at' => now(),
                'created_by' => $adminId,
                'updated_at' => now(),
            ],
            [
                'name' => 'Celana',
                'slug' => Str::slug('Celana'),
                'meta_title' => ' Celana',
                'meta_description' => 'Koleksi berbagai jenis celana',
                'meta_keywords' => 'celana, fashion, pakaian',
                'status' => 'Active',
                'is_deleted' => 0,
                'created_at' => now(),
                'created_by' => $adminId,
                'updated_at' => now(),
            ],
            [
                'name' => 'Topi',
                'slug' => Str::slug('Topi'),
                'meta_title' => ' Topi',
                'meta_description' => 'Koleksi berbagai jenis topi',
                'meta_keywords' => 'topi, fashion, aksesoris',
                'status' => 'Active',
                'is_deleted' => 0,
                'created_at' => now(),
                'created_by' => $adminId,
                'updated_at' => now(),
            ],
            [
                'name' => 'Polo',
                'slug' => Str::slug('Polo'),
                'meta_title' => ' Polo',
                'meta_description' => 'Koleksi berbagai jenis polo',
                'meta_keywords' => 'polo, baju, fashion',
                'status' => 'Active',
                'is_deleted' => 0,
                'created_at' => now(),
                'created_by' => $adminId,
                'updated_at' => now(),
            ],
            [
                'name' => 'Sepatu',
                'slug' => Str::slug('Sepatu'),
                'meta_title' => ' Sepatu',
                'meta_description' => 'Koleksi berbagai jenis sepatu',
                'meta_keywords' => 'sepatu, sneakers, boots, footwear',
                'status' => 'Active',
                'is_deleted' => 0,
                'created_at' => now(),
                'created_by' => $adminId,
                'updated_at' => now(),
            ],
        ];

        foreach ($categories as $category){
        Category::create($category);
        }
    }
}
