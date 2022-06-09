<?php
namespace App\Http\Interfaces;
use Illuminate\Database\Eloquent\Model;   
use Illuminate\Support\Collection;
interface BaseRepositoryInterface{


     /**
    * @param array $attributes
    * @return Model
    */
   public function create(array $attributes): Model;

   /**
    * @param $id
    * @return Model
    */
   public function find($id): ?Model;

   public function all() ;

    public function update(array $attributes ,$id);

    public function delete($id);



}