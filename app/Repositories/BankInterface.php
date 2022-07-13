<?php

namespace App\Repositories;

interface BankInterface
{
    public function all();

    public function create($data);

    public function update($data,$id);

    public function find($id);
}
