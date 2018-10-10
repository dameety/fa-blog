<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks = 0");
        DB::table('posts')->delete();
        DB::table('category_post')->delete();

        $categories = \App\Models\Category::all();
        foreach($categories as $category) {
            $posts = factory(\App\Models\Post::class, 41)->create();
            $newCategory = factory(\App\Models\Category::class)->create();

            $newCategory->posts()->attach($posts);
            $category->posts()->attach($posts);
        }

        //add media to image
        $posts = Post::all();
        $images_folder = base_path() . '/database/images/';

        foreach ($posts as $post) {
            $image_path = $images_folder . random_int(1, 5) . '.jpeg';

            $post->addMedia($image_path)
                ->preservingOriginal()
                ->toMediaCollection();

            $post->reading_duration = $this->calculateReadTime($post->body);
            $post->save();
        }
    }

    private static function calculateReadTime($postBody)
    {
        $word_count = str_word_count(strip_tags($postBody));

        $minutes = floor($word_count / 200);
        $seconds = floor($word_count % 200 / (200 / 60));

        $str_minutes = ($minutes == 1) ? "minute" : "minutes";
        $str_seconds = ($seconds == 1) ? "second" : "seconds";

        if ($minutes == 0) {
            return "{$seconds} {$str_seconds}";
        }
        else {
            return "{$minutes} {$str_minutes}, {$seconds} {$str_seconds}";
        }
    }
}
