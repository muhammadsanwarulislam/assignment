<?php

namespace App\Http\Controllers\API\Backend\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Repository\Page\PageRepository;
use App\Http\Controllers\API\JsonResponseTrait;

class PageController extends Controller
{
    use JsonResponseTrait;

    protected $userPageRepo;

    function __construct(PageRepository $userPageRepo)
    {
        $this->userPageRepo = $userPageRepo;
    }

    public function store(Request $request)
    {
        $user = $this->userPageRepo->create($request->except('user_id') + [
            'user_id'      =>  Auth::id()
        ]);
        return $this->json('Page create');
        }
}
