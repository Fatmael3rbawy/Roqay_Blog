<?php
namespace App\Http\Eloquent;
use App\Http\Eloquent\BaseRepository;
use App\Http\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface {

/**
    * CategoryRepository constructor.
    *
    * @param Category $model
    */
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }
    
}
