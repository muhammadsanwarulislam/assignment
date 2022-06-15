<?php
namespace Repository\Page;

use App\Models\Page;
use Repository\BaseRepository;

class PageRepository extends BaseRepository {

    public function model()
    {
        return Page::class;
    }

    public function checkUserIsAssignThePage($user_id, $pageID)
    {
        return $this->model()::where('user_id', $user_id)->where('id', $pageID)->first();
    }
}