<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Str;
class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $adminId = DB::table('users')->where('name', 'admin')->where('is_admin', 1)->value('id');

         $categories = DB::table('category')->pluck('id', 'name')->toArray();
         $subCategories = DB::table('sub_category')->pluck('id', 'name')->toArray();
 
         $products = [
             [
                 'title' => 'Baju Formal Premium',
                 'slug' => Str::slug('Baju Formal Premium'),
                 'description' => 'Baju formal premium dengan bahan berkualitas tinggi.',
                 'price' => 250000,
                 'category_id' => $categories['Baju'] ?? null,
                 'sub_category_id' => $subCategories['Baju Formal'] ?? null,
                 'images' => 'default.jpeg',
                 'status' => 'Active',
                 'is_deleted' => 0,
                 'created_at' => now(),
                 'created_by' => $adminId,
                 'updated_at' => now(),
             ],
             [
                 'title' => 'Baju Kasual Nyaman',
                 'slug' => Str::slug('Baju Kasual Nyaman'),
                 'description' => 'Baju kasual yang nyaman untuk digunakan sehari-hari.',
                 'price' => 120000,
                 'category_id' => $categories['Baju'] ?? null,
                 'sub_category_id' => $subCategories['Baju Kasual'] ?? null,
                 'image' => 'default.jpeg',
                 'status' => 'Active',
                 'is_deleted' => 0,
                 'created_at' => now(),
                 'created_by' => $adminId,
                 'updated_at' => now(),
             ],
             [
                 'title' => 'Celana Panjang Slim Fit',
                 'slug' => Str::slug('Celana Panjang Slim Fit'),
                 'description' => 'Celana panjang slim fit yang nyaman untuk digunakan sehari-hari.',
                 'price' => 150000,
                 'category_id' => $categories['Celana'] ?? null,
                 'sub_category_id' => $subCategories['Celana Panjang'] ?? null,
                 'image' => 'default.jpeg',
                 'status' => 'Active',
                 'is_deleted' => 0,
                 'created_at' => now(),
                 'created_by' => $adminId,
                 'updated_at' => now(),
             ],
             [
                 'title' => 'Celana Pendek Santai',
                 'slug' => Str::slug('Celana Pendek Santai'),
                 'description' => 'Celana pendek yang cocok untuk kegiatan santai.',
                 'price' => 80000,
                 'category_id' => $categories['Celana'] ?? null,
                 'sub_category_id' => $subCategories['Celana Pendek'] ?? null,
                 'image' => 'default.jpeg',
                 'status' => 'Active',
                 'is_deleted' => 0,
                 'created_at' => now(),
                 'created_by' => $adminId,
                 'updated_at' => now(),
             ],
             [
                 'title' => 'Topi Baseball Classic',
                 'slug' => Str::slug('Topi Baseball Classic'),
                 'description' => 'Topi baseball dengan desain klasik yang cocok untuk semua usia.',
                 'price' => 50000,
                 'category_id' => $categories['Topi'] ?? null,
                 'sub_category_id' => $subCategories['Topi Baseball'] ?? null,
                 'image' => 'default.jpeg',
                 'status' => 'Active',
                 'is_deleted' => 0,
                 'created_at' => now(),
                 'created_by' => $adminId,
                 'updated_at' => now(),
             ],
             [
                 'title' => 'Topi Fedora Elegan',
                 'slug' => Str::slug('Topi Fedora Elegan'),
                 'description' => 'Topi fedora dengan desain elegan untuk tampilan yang lebih gaya.',
                 'price' => 70000,
                 'category_id' => $categories['Topi'] ?? null,
                 'sub_category_id' => $subCategories['Topi Fedora'] ?? null,
                 'image' => 'default.jpeg',
                 'status' => 'Active',
                 'is_deleted' => 0,
                 'created_at' => now(),
                 'created_by' => $adminId,
                 'updated_at' => now(),
             ],
             [
                 'title' => 'Sneakers Trendy',
                 'slug' => Str::slug('Sneakers Trendy'),
                 'description' => 'Sneakers trendy yang nyaman untuk berbagai aktivitas.',
                 'price' => 300000,
                 'category_id' => $categories['Sepatu'] ?? null,
                 'sub_category_id' => $subCategories['Sneakers'] ?? null,
                 'image' => 'default.jpeg',
                 'status' => 'Active',
                 'is_deleted' => 0,
                 'created_at' => now(),
                 'created_by' => $adminId,
                 'updated_at' => now(),
             ],
             [
                 'title' => 'Boots Tahan Air',
                 'slug' => Str::slug('Boots Tahan Air'),
                 'description' => 'Boots yang tahan air dan cocok untuk berbagai kondisi cuaca.',
                 'price' => 400000,
                 'category_id' => $categories['Sepatu'] ?? null,
                 'sub_category_id' => $subCategories['Boots'] ?? null,
                 'image' => 'default.jpeg',
                 'status' => 'Active',
                 'is_deleted' => 0,
                 'created_at' => now(),
                 'created_by' => $adminId,
                 'updated_at' => now(),
             ],
         ];
 
         // Insert products
         DB::table('products')->insert($products);
     }
    }

