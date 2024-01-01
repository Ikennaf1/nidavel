<?php

use App\Models\Post;

function home()
{
    $settings = Settings::getInstance();
    $homepage = $settings->get('general', 'homepage');
    $limit = $settings->get('general', 'query_limit');

    if ($homepage === 'index') {
        $posts = Post::where('post_type', 'post')
            ->where('status', 'published')
            ->latest()
            ->orderBy('id', 'DESC')
            // ->limit($limit)
            ->get();
        return view('front.posts', [
            "posts" => $posts
        ]);
    }
    else if (is_int($homepage)) {
        $page = Post::find($homepage);
        return view('front.page', [
            'page' => $page
        ]);
    }
    else {
        return view('front.pages.' . $homepage);
    }
}
