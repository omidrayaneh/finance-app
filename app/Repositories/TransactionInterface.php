<?php

namespace App\Repositories;

interface TransactionInterface
{
    public function create($data);

    public function find($id);
}
