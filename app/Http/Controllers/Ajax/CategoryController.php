<?php

namespace App\Http\Controllers\Ajax;

use Response;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
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
        $columns = ['name', 'description', 'created_at'];
        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = $this->categoryRepository->with(['posts'])->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query = $query->scopeQuery(function($query) use ($searchValue) {
                return $query->where('name',  'like', '%' . $searchValue . '%')
                    ->orWhere('description', 'like', '%' . $searchValue . '%');
            });
        }

        $categories = $query->paginate($length);
        return $this->sendResponse(['data' => $categories->toArray(), 'draw' => $request->input('draw')], 'Successful');
    }



    public function bulkDelete (Request $request)
    {
        try {
            foreach($request->category_ids as $id) {
                $this->categoryRepository->delete($id);
            }
        } catch(\Exception $e) {
            $error = $e;
            return $this->sendError($e, 'Category was not deleted.');
        }

        return $this->sendResponse([], 'Categories Successfully deleted');
    }



    /**
     * Store a newly created Category in storage.
     *
     * @param CreateCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $input = $request->only('name', 'description');

        $category = $this->categoryRepository->create($input);

        return $this->sendResponse($category, 'Category created successfully!');
    }



    /**
     * Update the specified Category in storage.
     *
     * @param  int              $id
     * @param UpdateCategoryRequest $request
     *
     * @return Response
     */
    public function update($slug, UpdateCategoryRequest $request)
    {
        $category = $this->categoryRepository->findWhere([
            'slug' => $slug
        ])->first();

        if (empty($category)) {
            session()->flash('error', 'Category not found');
            return $this->sendError('Category not found.');
        }

        $category = $this->categoryRepository->update($request->all(), $category->id);

        return $this->sendResponse($category, 'Category updated successfully.');
    }


    /**
     * Remove the specified Category from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $category = $this->categoryRepository->findWithoutFail($id);
        if (empty($category)) {
            return $this->sendError([], 'Category not found');
        }

        $this->categoryRepository->delete($id);

        return $this->sendResponse($id, 'Category deleted successfully.');
    }
}
