<?php
namespace Repository\Post;

use App\Models\Post;
use Repository\BaseRepository;

class PostRepository extends BaseRepository {
    public function model()
    {
        return Post::class;
    }
}
