<?php
namespace Repository\Page;

use App\Models\Page;
use Repository\BaseRepository;

class PageRepository extends BaseRepository {

    public function model()
    {
        return Page::class;
    }
    
}