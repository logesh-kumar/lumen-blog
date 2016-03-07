<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Config;
use Validator;
use App\User;


class AuthenticateController extends Controller{
    public function index(){
	    $users = User::all();
	    return $users;
    }
    
    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');
        $user = User::where('email', '=', $email)->first();
        if (!$user)
        {
            return response()->json(['message' => 'Wrong email and/or password'], 401);
        }
        if (Hash::check($password, $user->password))
        {
            unset($user->password);
            $token = Auth::attempt(['email' => $email, 'password' => '123456']);
            
            //return response()->json(['token' => $this->createToken($user)]);
        }
        else
        {
            return response()->json(['message' => 'Wrong email and/or password'], 401);
        }
    }
    
    public function signup(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 400);
        }
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return response()->json(['token' => $this->createToken($user)]);
    }
}