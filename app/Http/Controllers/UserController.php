<?php
namespace App\Http\Controllers;

use App\Models\User;
use Cache;
use Hash;
use Helper;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show user online status.
     */
    public function userOnlineStatus()
    {
        $users = User::all();
        foreach ($users as $user) {
            if (Cache::has('user-is-online-' . $user->id)) {
                echo $user->name . " is online. Last seen: " . Carbon::parse($user->last_seen)->diffForHumans() . " <br>";
            } else {
                echo $user->name . " is offline. Last seen: " . Carbon::parse($user->last_seen)->diffForHumans() . " <br>";
            }

        }
    }

    public function accountUpdate(Request $request)
    {

        $request->validate([
            'username' => 'required|string|min:3|max:255',
            'email' => 'required|string|email| max:255|unique:users,email,' . auth()->user()->id,
            'password' => 'nullable|string|min:8',
            'image' => 'nullable|image',
        ]);

        $image = request()->file("image");

        $user = User::find(auth()->user()->id);
        $user->username = $request['username'];
        $user->email = $request['email'];
        if ($request->password != "nopassword") {
            $user->password = Hash::make($request['password']);
        }

        $data = array(
            "record" => $user,
            "image" => $image,
            "imagePath" => "/images/users/user.webp",
            "dirPath" => "/images/users/",
            "width" => 448,
            "height" => 600,

        );
        Helper::uploadImage($data);
    }

}
