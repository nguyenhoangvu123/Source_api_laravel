<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Repositories\Auth\AuthRepositoryInterface;

class AuthService extends BaseSevice
{
    protected $authRepo;
    public function __construct(AuthRepositoryInterface $authRepo)
    {
        $this->authRepo = $authRepo;        
    }
    public function login($request)
    {
        $datas = $request->all();
        if (!Auth::attempt($datas)) 
        abort (422,'Tài khoản hay mật khẩu không chính xác !');
        $user = $this->authRepo->getUserByEmail($datas['email']);
        $token = $user->createToken('authToken')->plainTextToken;
        return [
            'token' => "Bear {$token}" 
        ];
    }
}
