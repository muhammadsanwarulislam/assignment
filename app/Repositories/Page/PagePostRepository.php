<?php
namespace Repository\Page;

use App\Models\PageFeed;
use Repository\BaseRepository;

class PagePostRepository extends BaseRepository {
    public function model()
    {
        return PageFeed::class;
    }
}