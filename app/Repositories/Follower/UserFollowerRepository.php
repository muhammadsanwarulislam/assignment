<?php

namespace Repository\Follower;

use App\Models\UserFollow;
use Repository\BaseRepository;


class UserFollowerRepository extends BaseRepository
{
    public function model()
    {
        return UserFollow::class;
    }

    public function getFollowers()
    {
        return $this->model()::where('user_to',auth()->user()->id)->get();
    }

    public function getFollowing()
    {
        return $this->model()::where('user_id',auth()->user()->id)->get();
    }

    public function checkFollowRequest($user_to)
    {
        return $this->model()::where('user_to',$user_to)->first();
    }
}
