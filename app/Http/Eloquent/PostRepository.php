<?php
namespace App\Http\Eloquent;
use App\Http\Eloquent\BaseRepository;
use App\Http\Interfaces\PostRepositoryInterface;
use App\Models\Post;

class PostRepository extends BaseRepository implements PostRepositoryInterface {

/**
    * PostRepository constructor.
    *
    * @param Post $model
    */
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }
    
}
