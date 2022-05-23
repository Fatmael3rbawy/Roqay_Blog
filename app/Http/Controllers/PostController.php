<?php

namespace App\Http\Controllers;

use App\Http\Requests\post\StorePostRequest;
use App\Http\Requests\post\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $posts = Post::where('user_id', '=', $user_id)
            ->orderBy('id', 'desc')
            ->paginate(10);
        // dd($posts);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('posts.create', compact('categories', 'tags'));
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
        $image->move(public_path('images/posts'), $image_name);

        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category,
            'image' => $image_name
        ]);

        $post->tags()->sync($request->tags);

        return redirect(route('posts.index'))->with('message', 'The post has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $post = Post::find($id);
        return view('posts.edit', compact('post', 'categories', 'tags'));
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
                unlink(public_path('images/posts/') . $image_name);
            }
            //store post image in public/images/posts
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $image_name = "post" . uniqid() . ".$ext";
            $image->move(public_path('images/posts'), $image_name);
        }

        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category,
            'image' => $image_name

        ]);
        $post->tags()->sync($request->tags);

        return redirect(route('posts.index'))->with('message', 'The post has been updated successfully');
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
            unlink(public_path('images/posts/') . $post->image);
        }
        $post->delete();
        return back()->with('message', 'The post has been deleted successfully');
    }
}
