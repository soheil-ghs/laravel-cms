<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsersRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;

class UsersController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index() {
    $users = User::all();
    return view('admin.users.index', compact('users'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create() {
    $roles = Role::pluck('name', 'id')->toArray();
    return view('admin.users.create', compact('roles'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param UsersRequest $request
   * @return Response
   */
  public function store(UsersRequest $request) {
    $input = $request->all();

    if ($file = $request->file('photo')) {
      $name = time() . $file->getClientOriginalName();
      $file->move('images', $name);
      $photo = Photo::create([
        'file' => $name
      ]);

      $input['photo_id'] = $photo->id;
    }

    $input['password'] = bcrypt($request->password);
    User::create($input);
    return redirect('/admin/users');
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return Response
   */
  public function show($id) {
    return view('admin.users.show');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return Response
   */
  public function edit($id) {
    $user = User::findOrFail($id);
    $roles = Role::pluck('name', 'id')->toArray();

    return view('admin.users.edit',
      compact('user', 'roles'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param UsersRequest $request
   * @param int $id
   * @return void
   */
  public function update(UsersRequest $request, $id) {
    $user = User::findOrFail($id);
    $input = $request->all();

    if ($file = $request->file('photo')) {
      $name = time() . $file->getClientOriginalName();
      $file->move('images', $name);

      $photo = Photo::create([
        'file' => $name
      ]);
      $input['photo_id'] = $photo->id;
    }

    $input['password'] = bcrypt($request->password);

    $user->update($input);
    return redirect('/admin/users');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return Response
   */
  public function destroy($id) {
    $user = User::findOrFail($id);
    unlink(public_path(). $user->photo->file);
    $user->photo->delete();
    $user->delete();

    Session::flash('deleted_user', 'The User has been deleted');

    return redirect('/admin/users');
  }
}
