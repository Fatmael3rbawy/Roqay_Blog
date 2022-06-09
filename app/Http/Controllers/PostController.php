<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\PostRepositoryInterface;
use App\Http\Interfaces\TagRepositoryInterface;
use App\Http\Interfaces\CategoryRepositoryInterface;
use App\Http\Requests\post\StorePostRequest;
use App\Http\Requests\post\UpdatePostRequest;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    use GeneralTrait;

    private $postRepoInterface;
    private $tagRepoInterface;
    private $categoryRepoInterface;

    public function __construct(PostRepositoryInterface $postRepoInterface, TagRepositoryInterface $tagRepoInterface, CategoryRepositoryInterface $categoryRepoInterface)
    {
        $this->postRepoInterface = $postRepoInterface;
        $this->tagRepoInterface = $tagRepoInterface;
        $this->categoryRepoInterface = $categoryRepoInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts =  $this->postRepoInterface->all();
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
        $tags =  $this->tagRepoInterface->all();
        $categories =  $this->categoryRepoInterface->all();
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

        $attributes = [
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category,
            'image' => $image_name
        ];

        $post = $this->postRepoInterface->create($attributes);
        $post->tags()->attach($request->tags);
        // return redirect(route('posts.index'))->with('message', 'The post has been added successfully');
        // if(!$post){
        //     return response()->json(['error' => 'error']);

        // }else
        return response()->json(['success' => 'Post created successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->postRepoInterface->find($id);
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
        $tags =  $this->tagRepoInterface->all();
        $categories =  $this->categoryRepoInterface->all();

        $post = $this->postRepoInterface->find($id);
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
        $post = $this->postRepoInterface->find($id);
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

        $attributes = [
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category,
            'image' => $image_name

        ];

        $this->postRepoInterface->update($attributes, $id);
        $post->tags()->sync($request->tags);

        return redirect(route('posts.index'))->with('message', 'The post has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {dd($request->id);
        $this->postRepoInterface->delete($request->id);
        
        return back()->with('message', 'The post has been deleted successfully');
    }
}
