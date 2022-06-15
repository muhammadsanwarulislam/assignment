<?php

namespace App\Http\Controllers\API\Backend\Post;

use Illuminate\Http\Request;
use Repository\Post\PostRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\JsonResponseTrait;

class PostController extends Controller
{
    use JsonResponseTrait;

    protected $postRepo;

    function __construct(PostRepository $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    public function index()
    {
        return $this->postRepo->getAll();
    }
    
    public function store(Request $request)
    {
       $this->postRepo->create($request->except('user_id') + ['user_id' =>  Auth::id()]);
        return $this->json('Post created');
    }
}
