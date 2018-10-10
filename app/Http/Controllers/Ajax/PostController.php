<?php

namespace App\Http\Controllers\Ajax;

use Response;
use Illuminate\Http\Request;
use App\Services\PostService;
use App\Criteria\SearchCriteria;
use App\Repositories\PostRepository;
use App\Http\Requests\CreatePostRequest;
use App\Repositories\CategoryRepository;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\AppBaseController;
use Prettus\Repository\Criteria\RequestCriteria;

class PostController extends AppBaseController
{
    /** @var  CategoryRepository */
    private $categoryRepository;

    /** @var  PostRepository */
    private $postRepository;

    private $postService;

    public function __construct(
        PostRepository $postRepo,
        PostService $postService,
        CategoryRepository $categoryRepository)
    {
        $this->postRepository = $postRepo;
        $this->categoryRepository = $categoryRepository;
        $this->postService = $postService;
    }


    /**
     * Display a listing of the Post.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $columns = ['title', 'category_id', 'author_id', 'status'];
        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = $this->postRepository->with(['author', 'categories'])->orderBy($columns[$column], $dir);

        if ($searchValue) {

            $query = $query->scopeQuery(function($query) use ($searchValue) {
                return $query->where('title',  'like', '%' . $searchValue . '%')
                    ->orWhere('status', 'like', '%' . $searchValue . '%')
                    ->orWhereHas('author', function($q) use ($searchValue) {
                        $q->where('email', 'LIKE', '%' . $searchValue . '%');
                    })
                    ->orWhereHas('categories', function($q) use ($searchValue) {
                        $q->where('name', 'LIKE', '%' . $searchValue . '%');
                    });
            });

        }

        $posts = $query->paginate($length);
        return $this->sendResponse(['data' => $posts->toArray(), 'draw' => $request->input('draw')], 'Successful');
    }



    public function bulkDelete (Request $request)
    {
        try {
            foreach($request->post_ids as $id) {
                $this->postRepository->delete($id);
            }
        } catch(\Exception $e) {
            $error = $e;
            return $this->sendError($e, 'Post successfully deleted.');
        }

        session('success', 'Posts Successfully deleted.');

        return $this->sendResponse($request->post_ids, 'Posts Successfully deleted');
    }



    public function addToFeatured ($id)
    {
        $post = $this->postRepository->findWithoutFail($id);
        if (empty($post)) {
            return $this->sendError($id, 'Post not found.');
        }

        $post = $this->postRepository->update(['is_featured' => true], $id);
        session()->flash('success', 'Post successfully updated');

        return $this->sendResponse($post, 'Post successfully updated');
    }



    public function removeFromFeatured ($id)
    {
        $post = $this->postRepository->findWithoutFail($id);
        if (empty($post)) {
            return $this->sendError($id, 'Post not found.');
        }

        $post = $this->postRepository->update(['is_featured' => false], $id);
        session()->flash('success', 'Post successfully unfeatured');

        return $this->sendResponse($post, 'Post successfully unfeatured');
    }



    public function slidable($id)
    {
        $post = $this->postRepository->findWithoutFail($id);
        if (empty($post)) {
            return $this->sendError($id, 'Post not found.');
        }

        if($post->is_slidable) {
            $post = $this->postRepository->update(['is_slidable' => false], $id);
            session()->flash('success', 'Post successfully remove to slider');

            return $this->sendResponse($post, 'Post successfully remove to slider');
        }

        if(!$post->is_slidable) {
            $post = $this->postRepository->update(['is_slidable' => true], $id);
            session()->flash('success', 'Post successfully added to slider');

            return $this->sendResponse($post, 'Post successfully added to slider');
        }
    }



    /**
     * Store a newly created Post in storage.
     *
     * @param CreatePostRequest $request
     *
     * @return Response
     */
    public function store(CreatePostRequest $request)
    {
        $categories = [];
        foreach($request->categories as $category) {
            $foundCategory = $this->categoryRepository->findWhere([
                'name' => $category
            ])->first();
            if(empty($foundCategory)) {
                return $this->sendError( $category.'category not found.');
            }
            $categories[] = $foundCategory;
        }

        $post = $this->postService->store(
            $request->only('title', 'body', 'excerpt', 'status'),
//            $request->tags,
            $categories
        );


        $post->addMediaFromBase64($request->image)->toMediaCollection();

        return $this->sendResponse($post, 'Post created successfully.');
    }



    /**
     * Update the specified Post in storage.
     *
     * @param  int              $id
     * @param UpdatePostRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostRequest $request)
    {
        $post = $this->postRepository->findWhere([
            'slug' => $request->slug
        ])->first();
        if (empty($post)) {
            return $this->sendError('Post not found.');
        }

        $categories = [];
        foreach($request->categories as $category) {
            $foundCategory = $this->categoryRepository->findWhere([
                'name' => $category
            ])->first();
            if(empty($foundCategory)) {
                return $this->sendError( $category.'category not found.');
            }
            $categories[] = $foundCategory;
        }

        $post = $this->postService->update(
            $post->id,
            $request->only('title', 'body', 'excerpt', 'status'),
//            $request->tags,
            $categories
        );

        if($request->has('image')) {
            $post->addMediaFromBase64($request->image)->toMediaCollection();
        }

        return $this->sendResponse($post, 'Post updated successfully.');
    }

    /**
     * Remove the specified Post from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $post = $this->postRepository->findWithoutFail($id);
        if (empty($post)) {
            return $this->sendError([], 'Post not found');
        }

        $this->postRepository->delete($id);

        return $this->sendResponse($id, 'Post deleted successfully.');
    }
}
