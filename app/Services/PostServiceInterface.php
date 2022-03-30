<?php

namespace App\Services;

interface PostServiceInterface
{
    public function save($data);

    public function all();

    public function update($data, $id);

    public function delete($id);
}
