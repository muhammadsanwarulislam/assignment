<?php

namespace App\Http\Controllers\API\Backend\Follower;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\JsonResponseTrait;
use Repository\Follower\FollowerRepository;
use Repository\User\UserRepository;

class FollowerController extends Controller
{
    use JsonResponseTrait;

    protected $followerRepo, $userRepo;

    function __construct(FollowerRepository $followerRepo, UserRepository $userRepo) {
        $this->followerRepo = $followerRepo;
        $this->userRepo     = $userRepo;
    }

    public function sentFollowRequest(Request $request)
    {
        //prevent logged in user request
        if(Auth::id() == $request->follower_id)
        {
            return $this->bad('You can not request yourself');
        }

        //Check follower request id is exist in User table
        $checkUserIsExist = $this->userRepo->checkUserIsExist($request->follower_id);
        //Check follower resquest is exist in Follower table
        $checkFollowerRequestIsExist = $this->followerRepo->checkFollowRequest($request->follower_id);

        if($checkFollowerRequestIsExist)
        {
            return $this->bad('Already you are folloing the user');
        }
        elseif($checkUserIsExist == null)
        {
            return $this->bad('User is not exist in User table');
        }
        else
        {
            $user = $this->followerRepo->create($request->except('user_id') + [
                    'user_id'      =>  Auth::id()
                ]);
            return $this->json('Request sent');
        }
    }
}
