<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Post;
use Carbon\Carbon;
use Auth;

class PostsController extends BaseController
{

	public function __construct(){
		$this->middlewate('auth');
	}

	public function getPosts(){
		$posts = Post::latest('published_at')->published()->get();
    }

    public function getPost($id){

    }

    public function create(PostRequest $request){
    	$user = Auth::User();
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->published_at = $request->published_at;
        $post->user_id = $user->id;
        $post->save();
        return $post;
    }

    public function update($id PostRequest $request){
    	
    }

    public function delete($id){
    	
    }
}
