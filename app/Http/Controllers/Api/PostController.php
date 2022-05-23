<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\post\StorePostRequest;
use App\Http\Requests\post\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Tag;
use App\Traits\GeneralTrait;

class PostController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $posts = Post::where('user_id', '=', $user_id)->with('tags')
            ->orderBy('id', 'desc')
            ->paginate(5);
        // dd($posts);
        return $this->returnData('Post',$posts,'Successfull process');
        return $this->returnData('Post', PostResource::collection($posts),'Successfull process');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        //store image in public/images/products
        $image = $request->file('image');
        $ext = $image->getClientOriginalExtension();
        $image_name = "post" . uniqid() . ".$ext";
        $image->move(public_path('images/Api/posts'), $image_name);

        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => $request->user_id,
            'category_id' => $request->category,
            'image' => $image_name
        ]);

        $post->tags()->sync($request->tags);

        return $this->returnSuccessMessage( 'The post has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id)->with('tags')->first();
        return $this->returnData('Post',new PostResource($post));
    }

   /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::find($id);
        $image_name = $post->image;
        // check if user upload image or not
        if ($request->hasFile('image')) {
            // check if post has image or not
            if ($image_name !== '' & 0) {
                unlink(public_path('images/Api/posts/') . $image_name);
            }
            //store post image in public/images/posts
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $image_name = "post" . uniqid() . ".$ext";
            $image->move(public_path('images/Api/posts'), $image_name);
        }

        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category,
            'image' => $image_name

        ]);
        $post->tags()->sync($request->tags);

        return $this->returnSuccessMessage('The post has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post->image !== '') {
            unlink(public_path('images/Api/posts/') . $post->image);
        }
        $post->delete();
        return $this->returnSuccessMessage('The post has been deleted successfully');
    }
}
