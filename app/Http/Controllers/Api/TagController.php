<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagsResource;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\GeneralTrait;
class TagController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::orderBy('id', 'desc')
        ->paginate(10);
        return $this->returnData('Tag',TagsResource::collection($tags));
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

        Tag::create([
            'name'=>$request->name,
            'user_id' =>Auth::user()->id

        ]);

        return $this->returnSuccessMessage('the tag has been ceated successfully');
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

        $tag = Tag::find($id);
        $tag->update([
            'name'=>$request->name
            
        ]);

        return $this->returnSuccessMessage('the tag has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->delete();
        return $this->returnSuccessMessage('the tag has been deleted successfully');
    }
}