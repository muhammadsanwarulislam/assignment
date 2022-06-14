<?php

namespace App\Http\Controllers\API\Backend\UserFollower;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\JsonResponseTrait;
use Repository\Follower\UserFollowerRepository;

class UserFollowerController extends Controller
{
    use JsonResponseTrait;

    protected $followerRepo;

    function __construct(UserFollowerRepository $followerRepo) {
        $this->followerRepo = $followerRepo;
    }

    public function listOfFollower()
    {
        $followers = $this->followerRepo->getFollowers();

        return $this->json('List of followers', $followers);
    }

    public function sentFollowRequest(Request $request)
    {
        $user = $this->followerRepo->create($request->except('user_id') + [
                'user_id'      =>  Auth::id()
            ]);
        return $this->json('Request sent',[
            'user_id'       =>  $user['user_id'],
            ]);
    }

}
