<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Repositories\Contracts\IBlog;
use App\Http\Requests\Blog\BlogRequest;

class BlogPostController extends Controller
{
    protected $blogs;
    public function __construct(IBlog $blogs) {
        $this->blogs = $blogs;
    }

    public function index() {
        $getAllPosts = $this->blogs->all();
        return BlogResource::collection($getAllPosts);
    }

    public function createBlog(BlogRequest $request) {
        $request->validated();

        $createBlog = $this->blogs->create([
            'title' => $request->title,
            'content' => $request->content,
            'published_date' => now(),
            'user_id' => auth()->id(),
        ]);

        return new BlogResource($createBlog);
    }

    public function updateBlog(BlogRequest $request, $blogID) {
        $blog = $this->blogs->find($blogID);
        
        $this->authorize('update', $blog);

        $updateBlog = $this->blogs->update($blogID,[
            'title'=> $request->title,
            'content'=> $request->content
        ]);

        return new BlogResource($blog);
    }

    public function deleteBlog($blogID) {

        $this->authorize('delete', $blogID);

        $blog = $this->blogs->find($blogID);

        $this->blogs->delete($blogID);


        return response()->json([
            'messages' => 'Post successfully delted'
        ], 200);
    }
}
