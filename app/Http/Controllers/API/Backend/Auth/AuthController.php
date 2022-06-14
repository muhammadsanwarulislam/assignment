<?php

namespace App\Http\Controllers\API\Backend\Auth;


use Illuminate\Http\Request;
use Repository\User\UserRepository;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\JsonResponseTrait;

class AuthController extends Controller
{
    use JsonResponseTrait;

    protected $authRepo;

    function __construct(UserRepository $authRepo)
    {
        $this->authRepo   =  $authRepo;
    }

    public function register(Request $request)
    {   
        $data = $request->validate([
            'name'      => 'required|max:255',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:6'
        ]);

        $data['password'] = bcrypt($request->password);
        $user = $this->authRepo->create($data);

        return $this->json('User registered successfully',[
            'user' => $user
        ]);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email'     => 'email|required',
            'password'  => 'required'
        ]);

        if (!auth()->attempt($data)) {
            return $this->bad('Invalid Credentials');
        }
    
        return $this->json('Login successfully', [
            'access_token'  => $this->authRepo->generateAccessToken($user = auth()->user()),
            'access_type'   => 'Bearer',
            'user'          => auth()->user()
        ]);

    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return $this->json('User logged out.',['type' => 'logout_success']);
    }

}
