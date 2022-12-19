<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
        
    // Google callback
    public function handleGoogleCallback()
    {
        $data = Socialite::driver('google')->stateless()->user();

        $user = User::where('email', '=', $data->email)->first();

        // $this->_registerOrLoginUser($user);

        // // Return home after login
        // return redirect()->route('home');

        
         Auth::login($user);

         return redirect()->route('home');
    }

    protected function _registerOrLoginUser($data)
    {
        // $user = User::where('email', '=', $data->email)->first();
        // if (!$user) {
        //     $user = new User();
        //     $user->username = $data->name;
        //     $user->email = $data->email;
        //     $user->google_id = $data->id;
        //     $user->password = Hash::make('bka!@123');
        //     $user->save();
        // }

        // Auth::login($user);
    }
}
