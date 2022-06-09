<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
     private $categoryRepoInterface;
    public function __construct(CategoryRepositoryInterface $categoryRepoInterface)
    {
        $this->categoryRepoInterface = $categoryRepoInterface;
    }
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepoInterface->all();
        return view('categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|min:3'
        ]);
        $attributes = [
            'name'=>$request->name,
            'user_id'=> Auth::user()->id
        ];
        $this->categoryRepoInterface->create($attributes);

        return redirect(route('category.index'))->with('message','the category has been ceated successfully');
    }

   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepoInterface->find($id);
        return view('categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|string|min:3'
        ]);

        $attributes =[
            'name'=>$request->name
        ];
        $this->categoryRepoInterface->update($attributes,$id);

        return redirect(route('category.index'))->with('message','the category has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $this->categoryRepoInterface->delete($id);
        return back()->with('message','the category has been deleted successfully');
    }
}
