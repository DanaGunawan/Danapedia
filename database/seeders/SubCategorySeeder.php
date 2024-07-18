<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\subCategory;
use App\Models\Category;
use Str;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
          $categories = DB::table('category')->pluck('id', 'name')->toArray();
          $adminId = DB::table('users')->where('name','admin')->where('is_admin',1)->value('id');

   
        // Sub categories data
        $subCategories = [
            // Sub categories for 'Baju'
            [
                'category_id' => $categories['Baju'] ?? null,
                'name' => 'Baju Formal',
                'slug' => Str::slug('Baju Formal'),
                'meta_title' => 'Sub Kategori Baju Formal',
                'meta_description' => 'Koleksi berbagai jenis baju formal',
                'meta_keywords' => 'baju formal, pakaian, fashion',
                'status' => 'Active',
                'is_deleted' => 0,
                'created_at' => now(),
                'created_by' => $adminId,
                'updated_at' => now(),
            ],
            [
                'category_id' => $categories['Baju'] ?? null,
                'name' => 'Baju Kasual',
                'slug' => Str::slug('Baju Kasual'),
                'meta_title' => 'Sub Kategori Baju Kasual',
                'meta_description' => 'Koleksi berbagai jenis baju kasual',
                'meta_keywords' => 'baju kasual, pakaian, fashion',
                'status' => 'Active',
                'is_deleted' => 0,
                'created_at' => now(),
                'created_by' => $adminId,
                'updated_at' => now(),
            ],

            // Sub categories for 'Celana'
            [
                'category_id' => $categories['Celana'] ?? null,
                'name' => 'Celana Panjang',
                'slug' => Str::slug('Celana Panjang'),
                'meta_title' => 'Sub Kategori Celana Panjang',
                'meta_description' => 'Koleksi berbagai jenis celana panjang',
                'meta_keywords' => 'celana panjang, pakaian, fashion',
                'status' => 'Active',
                'is_deleted' => 0,
                'created_at' => now(),
                'created_by' => $adminId,
                'updated_at' => now(),
            ],
            [
                'category_id' => $categories['Celana'] ?? null,
                'name' => 'Celana Pendek',
                'slug' => Str::slug('Celana Pendek'),
                'meta_title' => 'Sub Kategori Celana Pendek',
                'meta_description' => 'Koleksi berbagai jenis celana pendek',
                'meta_keywords' => 'celana pendek, pakaian, fashion',
                'status' => 'Active',
                'is_deleted' => 0,
                'created_at' => now(),
                'created_by' => $adminId,
                'updated_at' => now(),
            ],

            // Sub categories for 'Topi'
            [
                'category_id' => $categories['Topi'] ?? null,
                'name' => 'Topi Baseball',
                'slug' => Str::slug('Topi Baseball'),
                'meta_title' => 'Sub Kategori Topi Baseball',
                'meta_description' => 'Koleksi berbagai jenis topi baseball',
                'meta_keywords' => 'topi baseball, aksesoris, fashion',
                'status' => 'Active',
                'is_deleted' => 0,
                'created_at' => now(),
                'created_by' => $adminId,
                'updated_at' => now(),
            ],
            [
                'category_id' => $categories['Topi'] ?? null,
                'name' => 'Topi Fedora',
                'slug' => Str::slug('Topi Fedora'),
                'meta_title' => 'Sub Kategori Topi Fedora',
                'meta_description' => 'Koleksi berbagai jenis topi fedora',
                'meta_keywords' => 'topi fedora, aksesoris, fashion',
                'status' => 'Active',
                'is_deleted' => 0,
                'created_at' => now(),
                'created_by' => $adminId,
                'updated_at' => now(),
            ],

            // Sub categories for 'Sepatu'
            [
                'category_id' => $categories['Sepatu'] ?? null,
                'name' => 'Sneakers',
                'slug' => Str::slug('Sneakers'),
                'meta_title' => 'Sub Kategori Sneakers',
                'meta_description' => 'Koleksi berbagai jenis sneakers',
                'meta_keywords' => 'sneakers, sepatu, fashion',
                'status' => 'Active',
                'is_deleted' => 0,
                'created_at' => now(),
                'created_by' => $adminId,
                'updated_at' => now(),
            ],
            [
                'category_id' => $categories['Sepatu'] ?? null,
                'name' => 'Boots',
                'slug' => Str::slug('Boots'),
                'meta_title' => 'Sub Kategori Boots',
                'meta_description' => 'Koleksi berbagai jenis boots',
                'meta_keywords' => 'boots, sepatu, fashion',
                'status' => 'Active',
                'is_deleted' => 0,
                'created_at' => now(),
                'created_by' => $adminId,
                'updated_at' => now(),
            ],
        ];

        // Insert sub categories
        DB::table('sub_category')->insert($subCategories);
    }
    }

