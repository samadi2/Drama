<?php

namespace Database\Seeders;


use App\Models\User;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory(5)->create();
        \App\Models\Post::factory(20)->create();

        for ($i=0; $i < 30; $i++) { 
            $like= new Like();

            $like->user_id = User::all()->random(1)->first()->id;
            $like->post_id = Post::all()->random(1)->first()->id;

            $like->save();
        }
    }
}
