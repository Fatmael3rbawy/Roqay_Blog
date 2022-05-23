<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Traits\GeneralTrait;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
   use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')
        ->paginate(10);
        return $this->returnData('Category',CategoryResource::collection($categories));
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

        Category::create([
            'name'=>$request->name,
            'user_id'=> Auth::user()->id
        ]);

        return $this->returnSuccessMessage('the category has been created successfully');
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

        $category = Category::find($id);
        $category->update([
            'name'=>$request->name
        ]);

        return $this->returnSuccessMessage('the category has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return $this->returnSuccessMessage('the category has been deleted successfully');
    }
}
