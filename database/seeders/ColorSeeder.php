<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Str;
use App\Models\color;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminId = DB::table('users')->where('name','admin')->where('is_admin',1)->value('id');

        $colors = [
            [
                'name' => 'hitam',
                'code' => '#000000',
                'created_by' => $adminId,
                'is_deleted' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'merah',
                'code' => '#eb0a0a',
                'created_by' => $adminId,
                'is_deleted' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'kuning',
                'code' => '	#ede60c',
                'created_by' => $adminId,
                'is_deleted' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'hijau',
                'code' => '#0df828',
                'created_by' => $adminId,
                'is_deleted' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'biru',
                'code' => '#0f4fe6',
                'created_by' => $adminId,
                'is_deleted' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            

        ];
        foreach ($colors as $color){
            color::insert($color);
        }
    }
}
