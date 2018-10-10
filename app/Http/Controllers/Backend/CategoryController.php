<?php

namespace App\Http\Controllers\Backend;

use Response;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use App\Http\Controllers\AppBaseController;
use Prettus\Repository\Criteria\RequestCriteria;

class CategoryController extends AppBaseController
{
    /** @var  CategoryRepository */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepository = $categoryRepo;
    }

    /**
     * Display a listing of the Category.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('backend.categories.index');
    }

    /**
     * Show the form for creating a new Category.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.categories.create');
    }

    /**
     * Show the form for editing the specified Category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($slug)
    {
        $category = $this->categoryRepository->findWhere([
            'slug' => $slug
        ])->first();

        if (empty($category)) {
            session()->flash('error', 'Category not found');
            return back();
        }

        return view('backend.categories.edit')->with('category', $category);
    }
}
