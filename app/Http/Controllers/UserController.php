<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Excel;
use Hash;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');

        $this->middleware('activeUser');

    }


    public function  accountShow()
    {
        return view('account');
    }

    public function accountWrite(UserRequest $request)
    {

        $image = request()->file("image");

        $user = User::find(auth()->user()->id);
        $user->username = $request['username'];
        $user->email = $request['email'];

        $request->password != 'no-password' ? $user->password = Hash::make($request['password']) : 1 == 1;

        $data = array(
            "record" => $user,
            "image" => $image,
            "imagePath" => "/images/users/user.webp",
            "dirPath" => "/images/users/",
            "width" => 400,
            "height" => 400,

        );

         Helper::uploadImage($data);

        Session::flush();

        Auth::logout();

        return redirect('login');

    }

    public function write(UserRequest $request)
    {

        $authArray = array('user', 'write');

        Helper::authorizeModel($authArray);

        $image = request()->file("image");

        $id = $request->id;

        $user = $id ? User::find($id) : new User;

        $user->email = $request->email;

        $user->username = $request->username;

        $request->password != "nopassword" ? $user->password = Hash::make($request['password']) : $nullExist = null;

        $data = array(
            "record" => $user,
            "image" => $image,
            // "imagePath" => "/images/users/user.webp",
            "dirPath" => "/images/users/",
            "width" => 400,
            "height" => 400,

        );

        Helper::uploadImage($data);

    }

    public function index()
    {

        $authArray = array('user', 'show');

        Helper::authorizeModel($authArray);

        return view('users');

    }

    public function getData()
    {

        $authArray = array('user', 'show');

        Helper::authorizeModel($authArray);

        $users = User::orderBy('created_at', 'DESC')->get();

        $response = [
            'users' => $users,
        ];

        return response( $response , 201);

    }

    public function delete($id)
    {

        $authArray = array('user', 'delete');

        Helper::authorizeModel($authArray);

        $user = User::find($id);

        $imageFileExist = file_exists(public_path() . $user->image);

        $imageFileExist ? $imageFileDeleted = unlink(substr($user->image, 1)) : $imageFileDeleted = false;

        $imageFileExist ? ($imageFileDeleted ? $user->delete() : 1 == 1) : $user->delete();

    }

    public function updateStatus($id)
    {

        $authArray = array('user', 'write');

        Helper::authorizeModel($authArray);

        $user = User::find($id);

        $user->status ? $user->status = 0 : $user->status = 1;

        $user->save();

    }

    public function updatePermissions(Request $request, $id)
    {

        $authArray = array('user', 'write');

        Helper::authorizeModel($authArray);

        $user = User::find($id);
        $user->permissions()->sync(Helper::getArrayFromString($request->permissions_ids));
        $response = [
            "permissions" => $user->permissions,
        ];

        return response($response, 201);
    }

    public function getPermissions($id)
    {
        return User::with('permissions')->where('id', $id)->first();
    }

    public function exportExcel()
    {

        $authArray = array('user', 'show');

        Helper::authorizeModel($authArray);

        return Excel::download(new UserExport, 'users.xlsx');

    }

}
