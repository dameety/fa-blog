<?php

namespace App\Widgets;

use App\Repositories\PostRepository;
use Arrilot\Widgets\AbstractWidget;

class FeaturedPost extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $featuredPosts = app(PostRepository::class)
            ->findWhere(['is_featured' => true]);

        return view('frontend.widgets.featured_post', [
            'config' => $this->config,
            'featuredPosts' => $featuredPosts
        ]);
    }
}
