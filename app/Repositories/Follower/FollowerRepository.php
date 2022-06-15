<?php

namespace Repository\Follower;

use App\Models\Follower;
use Repository\BaseRepository;


class FollowerRepository extends BaseRepository
{
    public function model()
    {
        return Follower::class;
    }

    public function checkFollowRequest($follower_id, $user_id)
    {
        return $this->model()::where('follower_id',$follower_id)->where('user_id', $user_id)->first();
    }
}
