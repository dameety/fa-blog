<?php

namespace App\Services;

use App\Repositories\PostRepository;

class PostService
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function store ($inputs, $categories)
    {
        $post = $this->postRepository->create($inputs);

//        $tags = explode(',', $new_tags);
//        $post->tag($tags);
//        $post->tag($selected_tags);

        foreach ($categories as $category) {
            $category->posts()->attach($post);
        }
        return $post;
    }

    public function update($id, $inputs, $categories)
    {
        $post = $this->postRepository->update($inputs, $id);

        foreach ($categories as $category) {

            if(! $category->posts->contains($post->id)) {
                $category->posts()->attach($post);
            }

        }
        return $post;
    }
}