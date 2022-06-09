<?php

namespace App\Http\Eloquent;

use App\Http\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BaseRepository implements BaseRepositoryInterface
{

    /**      
     * @var Model      
     */
    protected $model;

    /**      
     * BaseRepository constructor.      
     *      
     * @param Model $model      
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @param $id
     * @return Model
     */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * @return Collection
     */
    public function all()
    {
        return $this->model->orderby('id', 'desc' )->paginate(8);
    }
    
   
    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }
    public function update($attributes ,$id)
    {
        return $this->model->findOrFail($id)->update($attributes);
    }
}
