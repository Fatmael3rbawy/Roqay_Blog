<?php
namespace App\Http\Eloquent;
use App\Http\Eloquent\BaseRepository;
use App\Http\Interfaces\TransactionRepositoryInterface;
use App\Models\Transaction;

class TransactionRepository extends BaseRepository implements TransactionRepositoryInterface {

/**
    * TransactionRepository constructor.
    *
    * @param Transaction $model
    */
    public function __construct(Transaction $model)
    {
        parent::__construct($model);
    }
    
    public function payments($id){
       return $this->model->where('user_id', $id)->get();
    }
    
}
