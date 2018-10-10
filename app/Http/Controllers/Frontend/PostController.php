<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\CategoryRepository;
use Response;
use Illuminate\Http\Request;
use App\Criteria\FindBySlugCriteria;
use App\Repositories\PostRepository;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\AppBaseController;
use Prettus\Repository\Criteria\RequestCriteria;

class PostController extends AppBaseController
{
    /** @var  PostRepository */
    private $postRepository;

    private $categoryRepository;

    public function __construct(PostRepository $postRepo,
        CategoryRepository $categoryRepository)
    {
        $this->postRepository = $postRepo;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the Post.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->postRepository->pushCriteria(new RequestCriteria($request));
        $posts = $this->postRepository->all();

        return view('posts.index')
            ->with('posts', $posts);
    }

    /**
     * Show the form for creating a new Post.
     *
     * @return Response
     */
    public function create()
    {
        return view('posts.create');
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
        $input = $request->all();

        $post = $this->postRepository->create($input);

        Flash::success('Post saved successfully.');

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified Post.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($slug)
    {
        $post = $this->postRepository
            ->with(['author', 'categories'])
            ->findWhere(['slug' => $slug])->first();

        if (empty($post)) {
            session()->flash('error', 'Post not found.');
            return back();
        }

        return view('frontend.posts.show')->with('post', $post);
    }


    public function categoryPosts($slug)
    {
        $category = $this->categoryRepository
            ->with(['posts'])
            ->findWhere(['slug' => $slug])->first();

        if (empty($category)) {
            session()->flash('error', 'Category not found.');
            return back();
        }

        $posts = $category->posts()->simplePaginate(14);

        return view('frontend.categories.posts', [
            'category' => $category,
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for editing the specified Post.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $post = $this->postRepository->findWithoutFail($id);

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        return view('posts.edit')->with('post', $post);
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
        $post = $this->postRepository->findWithoutFail($id);

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        $post = $this->postRepository->update($request->all(), $id);

        Flash::success('Post updated successfully.');

        return redirect(route('posts.index'));
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
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        $this->postRepository->delete($id);

        Flash::success('Post deleted successfully.');

        return redirect(route('posts.index'));
    }
}
