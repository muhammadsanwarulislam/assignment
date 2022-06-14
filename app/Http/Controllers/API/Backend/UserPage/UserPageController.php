<?php

namespace App\Http\Controllers\API\Backend\UserPage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Repository\Page\UserPageRepository;
use App\Http\Controllers\API\JsonResponseTrait;

class UserPageController extends Controller
{
    use JsonResponseTrait;

    protected $userPageRepo;

    function __construct(UserPageRepository $userPageRepo)
    {
        $this->userPageRepo = $userPageRepo;
    }

    public function store(Request $request)
    {
        $user = $this->followerRepo->create($request->except('user_id') + [
            'user_id'      =>  Auth::id()
        ]);
        return $this->json('Request sent',[
            'user_id'       =>  $user['user_id'],
            ]);
        }
}
