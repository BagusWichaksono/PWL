<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $toyota = Category::firstOrCreate(
            ['slug' => 'toyota'],
            [
                'name' => 'Toyota',
                'slug' => 'toyota',
            ]
        );

        $honda = Category::firstOrCreate(
            ['slug' => 'honda'],
            [
                'name' => 'Honda',
                'slug' => 'honda',
            ]
        );

        $mitsubishi = Category::firstOrCreate(
            ['slug' => 'mitsubishi'],
            [
                'name' => 'Mitsubishi',
                'slug' => 'mitsubishi',
            ]
        );

        $posts = [
            [
                'title' => 'Toyota Avanza',
                'category_id' => $toyota->id,
                'color' => '#dc2626',
                'tags' => 'mpv, keluarga',
                'published' => true,
                'created_at' => Carbon::parse('2026-02-28 14:36:12'),
            ],
            [
                'title' => 'Toyota Innova Reborn',
                'category_id' => $toyota->id,
                'color' => '#2563eb',
                'tags' => 'mpv, diesel',
                'published' => true,
                'created_at' => Carbon::parse('2026-03-01 10:11:46'),
            ],
            [
                'title' => 'Honda Civic Turbo',
                'category_id' => $honda->id,
                'color' => '#16a34a',
                'tags' => 'sedan, turbo',
                'published' => true,
                'created_at' => Carbon::parse('2026-03-02 09:20:00'),
            ],
            [
                'title' => 'Honda Brio RS',
                'category_id' => $honda->id,
                'color' => '#f97316',
                'tags' => 'city car, hatchback',
                'published' => false,
                'created_at' => Carbon::parse('2026-03-03 13:45:00'),
            ],
            [
                'title' => 'Mitsubishi Pajero Sport',
                'category_id' => $mitsubishi->id,
                'color' => '#7c3aed',
                'tags' => 'suv, diesel',
                'published' => true,
                'created_at' => Carbon::parse('2026-03-04 08:15:00'),
            ],
            [
                'title' => 'Mitsubishi Xpander',
                'category_id' => $mitsubishi->id,
                'color' => '#0f172a',
                'tags' => 'mpv, modern',
                'published' => false,
                'created_at' => Carbon::parse('2026-03-05 11:25:00'),
            ],
        ];

        foreach ($posts as $data) {
            Post::updateOrCreate(
                [
                    'slug' => Str::slug($data['title']),
                ],
                [
                    'title' => $data['title'],
                    'slug' => Str::slug($data['title']),
                    'category_id' => $data['category_id'],
                    'color' => $data['color'],
                    'tags' => $data['tags'],
                    'published' => $data['published'],
                    'created_at' => $data['created_at'],
                    'updated_at' => $data['created_at'],
                ]
            );
        }
    }
}