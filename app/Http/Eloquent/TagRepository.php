<?php
namespace App\Http\Eloquent;
use App\Http\Eloquent\BaseRepository;
use App\Http\Interfaces\TagRepositoryInterface;
use App\Models\Tag;

class TagRepository extends BaseRepository implements TagRepositoryInterface {

/**
    * TagRepository constructor.
    *
    * @param Tag $model
    */
    public function __construct(Tag $model)
    {
        parent::__construct($model);
    }
    
}
