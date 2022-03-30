<?php

namespace App\Services;

use App\Repositories\PostRepositoryInterface;

class PostService implements PostServiceInterface
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function save($data)
    {
        return $this->postRepository->save($data);
    }

    public function all()
    {
        return $this->postRepository->all();
    }

    public function update($data, $id)
    {
        return $this->postRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->postRepository->delete($id);
    }
}
