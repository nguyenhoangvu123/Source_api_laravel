<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function gettAlls();
    
    public function find(int $id);

    public function created(array $attributes);

    public function updated(int $id, array $attributes);

    public function delete(int $id);
}