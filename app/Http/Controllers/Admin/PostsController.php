<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostCreateRequest;
use App\Photo;
use App\Post;
use Auth;
use Illuminate\Http\Request;

class PostsController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $posts = Post::all();
    return view('admin.posts.index', compact('posts'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    $categories = Category::pluck('name', 'id')->toArray();
    return view('admin.posts.create', compact('categories'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param PostCreateRequest $request
   * @return void
   */
  public function store(PostCreateRequest $request) {
    $user = Auth::user();
    $input = $request->all();

    if ($file = $request->file('photo')) {
      $name = time() . $file->getClientOriginalName();
      $file->move('images', $name);
      $photo = Photo::create([
        'file' => $name
      ]);
      $input['photo_id'] = $photo->id;
    }

    $user->posts()->create($input);
    return redirect('/admin/posts');
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function show($id) {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
    //
  }
}
