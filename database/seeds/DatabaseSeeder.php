<?php

use Illuminate\Database\Seeder;
use App\Models\Post;

class DatabaseSeeder extends Seeder{
    public function run(){
        $this->call(PostsSeeder::class);
    }
}

class PostsSeeder extends Seeder{
    public function run(){
        DB::table('Posts')->delete();
        
        Post::create([
            'title' => 'First post',
            'slug' => 'first-post',
            'excerpt' => '<b>First post body</b>',
            'content' => '<b>Content First post body</b>',
            'published' => true,
            'published_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
       
        Post::create([
            'title' => 'Second post',
            'slug' => 'second-post',
            'excerpt' => '<b>Second post body</b>',
            'content' => '<b>Content Second post body</b>',
            'published' => false,
            'published_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        
        Post::create([
            'title' => 'Third post',
            'slug' => 'third-post',
            'excerpt' => '<b>Third post body</b>',
            'content' => '<b>Third Second post body</b>',
            'published' => false,
            'published_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
    }
}
