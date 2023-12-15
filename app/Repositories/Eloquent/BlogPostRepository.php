<?php 
namespace App\Repositories\Eloquent;

use App\Models\Blog\BlogPost;
use App\Repositories\Contracts\IBlog;

class BlogPostRepository extends BaseRepository implements IBlog {
    public function model() {
        return BlogPost::class;
    }
}