<?php

namespace App\Repositories\Auth;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\Auth\AuthRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthRepository extends BaseRepository implements AuthRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }

    public function getUserByEmail($email)
    {
        $result = $this->model->where('email', $email)->first();
        if (!$result)
        throw new ModelNotFoundException(404, 'User not found !');
        return $result;
    }
}