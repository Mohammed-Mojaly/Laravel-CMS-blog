<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class RegisterController extends Controller
{


    use RegistersUsers;


    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('frontend.auth.register');
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'mobile' => ['required', 'numeric' , 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'userimage' => ['nullable', 'image', 'max:20000', 'mimes:jpeg,jpg,png'],
        ]);
    }


    protected function create(array $data)
    {
        $user= User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']),
        ]);
        if(isset($data['userimage'])){
            if($image = $data['userimage']){
                $filename = Str::slug($data['username']) .'.' . $image->getClientOriginalExtension();
                $path = public_path('/assets/users/' .$filename);
                Image::make($image->getRealPath())->resize(300 , 300 , function($constraint) {
                    $constraint->aspectRatio();
                })->save($path,100);
                $user->update(['userimage' => $filename]);
            }
        }
        $user->attachRole(Role::whereName('user')->first()->id);
        return $user;
    }
    protected function registered(Request $request, $user)
    {
        if($request->wantsJson())
        {
            return response()->json([
                'errors' => false,
                'message' => 'Your account registred successfully, Please check your email to activate your account.',
            ]);

        }
        return redirect()->route('frontend.index')->with([
            'message' => 'Your account registred successfully, Please check your email to activate your account.',
            'alert-type' => 'success',
        ]);
    }
}
