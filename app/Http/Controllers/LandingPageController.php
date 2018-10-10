<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CategoryRepository;
use Response;

class LandingPageController extends AppBaseController
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function home()
    {
        $posts = $this->postRepository->with(['author', 'categories'])
            ->simplePaginate(10);

        $sliders = $this->postRepository->with(['author', 'categories'])
            ->findWhere([
                'is_slidable' => true
            ]);

        return view('frontend.index', [
            'posts' => $posts,
            'sliders' => $sliders
        ]);
    }
}
