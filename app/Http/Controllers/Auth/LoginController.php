<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function redirect($name)
    {
        return Socialite::driver($name)->redirect();
    }
    public function callback($name)
    {
        try {
            $userResponse = Socialite::driver($name)->user();
            if($name=='telegram'){
                $user = User::where('social_id', $userResponse->getId())->first();
                if($user){
                    $user->remember_token = hash('sha256', Str::random(60));
                    $user->created_token = Carbon::now();
                    if($user->save()){
                        Auth::login($user);
                        return redirect('/');
                    }else{
                        return redirect()->back();
                    }
                }else{
                    $newUser = new User();
                    $newUser->name =  $userResponse->getName() ? $userResponse->getName(): $userResponse->getNickname();
                    $newUser->social_id = $userResponse->getId();
                    $newUser->social_name = $name;
                    $newUser->avatar = Str::limit($userResponse->getAvatar(),200);
                    $newUser->remember_token = hash('sha256', Str::random(60));
                    $newUser->created_token = Carbon::now();
                    if($newUser->save()){
                        Auth::login($newUser);
                        return redirect('/');
                    }else{
                        return '';
                    }
                }
                
            }else{
                $user = User::where('email', $userResponse->getEmail())->first();
                if($user){
                    if(Carbon::parse($user->created_token)->diffInMinutes(Carbon::now()) < 5){
                        return redirect('/?user='.$user->remember_token);
                    }else{
                        $user->remember_token = hash('sha256', Str::random(60));
                        $user->created_token = Carbon::now();
                        if($user->save()){
                            Auth::login($user);
                            return redirect('/');
                        }else{
                            return '';
                        }
                    }

                }else{
                    $newUser = new User();
                    $newUser->name =  $userResponse->getName() ? $userResponse->getName(): $userResponse->getNickname();
                    $newUser->email = $userResponse->getEmail();
                    $newUser->social_id = $userResponse->getId();
                    $newUser->social_name = $name;
                    $newUser->avatar = Str::limit($userResponse->getAvatar(),200);
                    $newUser->remember_token = hash('sha256', Str::random(60));
                    $newUser->created_token = Carbon::now();
                    if($newUser->save()){
                        Auth::login($newUser);
                        return redirect('/');
                    }else{
                        return '';
                    }
                }
                
            }
            
        } catch (Exception $e) {
            dd($e->getMessage());
        }
        

        return $name;
    }
    public function login()
    {
        return view('auth/login');
    }
    public function register()
    {
        return view('auth/register');
    }
    public function authlogin(Request $request)
    {
        $request->validate([
            'email' => 'required|max:180',
            'password' => 'required',
            
        ]);
        
        if($request->isMethod('post')){
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
            {
                return redirect('/');
            }
        }
    }
    public function authregister(Request $request)
    {
        $request->validate([
            'name'=> 'required|max:150',
            'email' => 'required|unique:users|max:180',
            'password' => 'required',
            
        ]);
        if($request->isMethod('post')){
            $user = new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password = Hash::make($request->password);
            if($user->save()){
                Auth::login($user);

               
                return redirect('/');
            }
        }
    }
    public function getAU()
    {
        
        return response()->json([
            'status'=>true,
            'user'=>Auth()->user()
        ]);
    }
    public function logout()
    {
        if(Auth::logout()){
            return response()->json([
                'status'=>true,
                'user'=>[]
            ]);
        }else{
            return response()->json([
                'status'=>true,
                'user'=>[]
            ]);
        }
    }
}
