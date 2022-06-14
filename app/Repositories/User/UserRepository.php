<?php

namespace Repository\User;

use App\Models\User;
use Repository\BaseRepository;


class UserRepository extends BaseRepository
{
    public function model()
    {
        return User::class;
    }

    public function generateAccessToken(User $user): string
    {
        return $user->createToken('authToken')->accessToken;
    }

}
