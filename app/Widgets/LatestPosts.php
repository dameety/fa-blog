<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Repositories\PostRepository;

class LatestPosts extends AbstractWidget
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
        $latestPosts = app(PostRepository::class)
            ->orderBy('created_at', 'desc')
            ->simplePaginate(5);

        return view('frontend.widgets.latest_posts', [
            'config' => $this->config,
            'latestPosts' => $latestPosts
        ]);
    }
}
