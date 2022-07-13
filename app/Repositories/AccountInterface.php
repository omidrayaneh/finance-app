<?php

namespace App\Repositories;

interface AccountInterface
{
    public function all();

    public function create($data);

    public function update($data,$id);

    public function find($id);

    public function disabled($id);

    public function enabled($id);
}
