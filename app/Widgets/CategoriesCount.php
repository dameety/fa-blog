<?php

namespace App\Widgets;

use App\Repositories\CategoryRepository;
use Arrilot\Widgets\AbstractWidget;

class CategoriesCount extends AbstractWidget
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
        $category = app(CategoryRepository::class);

        $categories = $category->all();

        $categories->map(function($category) {
            $category['count'] = $category->posts()->count();
        });

        return view('frontend.widgets.categories_count', [
            'config' => $this->config,
            'categories' => $categories
        ]);
    }
}
