<?php

namespace App\Http\Controllers\Ajax;

use Response;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\CategoryRepository;
use App\Http\Controllers\AppBaseController;

class GetAllController extends AppBaseController
{
    /** @var  CategoryRepository */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepository = $categoryRepo;
    }

    public function all($table_name)
    {
        if($table_name == 'tags') {
            $data = Post::allTagsList();
            return $this->sendResponse($data, 'Successful retrieval.');
        }

        if($table_name == 'categories') {
            $data = $this->categoryRepository->all()->pluck('name', 'id');
            return $this->sendResponse($data, 'Successful retrieval.');
        }

        $data = DB::table($table_name)->get();
        return $this->sendResponse($data, 'Successful retrieval.');
    }
}
