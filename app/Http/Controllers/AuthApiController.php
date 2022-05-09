<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Controllers\BaseApiController;
use App\Http\Requests\AuthLoginRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthApiController extends BaseApiController
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(AuthLoginRequest $request)
    {
        try {
            return $this->sendDataSuccess(
                $this->authService->login($request),
                200,
                "Login success"
            );
        } catch (HttpException $ex) {
            return $this->sendError(
                422,
                'Validation Fail !',
                $ex->getMessage()
            );
        } catch (ModelNotFoundException $ex) {
            return $this->sendError(
                404,
                'Not found !',
                $ex->getMessage()
            );
        } catch (\Exception $ex) {
            return $this->sendError(
                500,
                'Login Fail !',
                $ex->getMessage()
            );
        }
    }
}
