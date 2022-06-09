<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\TransactionRepositoryInterface;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    
    private $transactionRepoInterface;
    public function __construct(TransactionRepositoryInterface $transactionRepoInterface)
    {
        $this->transactionRepoInterface = $transactionRepoInterface;
    }

      /**
     * Display a listing of the user payments.
     *
     * @return \Illuminate\Http\Response
     */
    public function payments()
    {
        $payments = $this->transactionRepoInterface->payments(auth()->user()->id);
        return view('users.payments',compact('payments'));
    }

     
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->transactionRepoInterface->delete($id);
        return back()->with('message','the transaction deleted successfully');
    }
}
