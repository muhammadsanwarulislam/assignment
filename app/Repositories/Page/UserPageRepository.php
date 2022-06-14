<?php
namespace Repository\Page;

use App\Models\UserPage;
use Repository\BaseRepository;

class UserPageRepository extends BaseRepository {

    public function model()
    {
        return UserPage::class;
    }
    
}