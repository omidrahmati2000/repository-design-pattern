<?php

namespace App\Repositories;

use App\Models\Post;
use InvalidArgumentException;

class PosRepository implements PostRepositoryInterface
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function save($data)
    {
        $post = new $this->post;
        $post->title = $data['title'];
        $post->description = $data['description'];

        $post->save();

        return $post->fresh();
    }

    public function all()
    {
        return $this->post->get();
    }

    public function update($data, $id)
    {
        $post = $this->post->find($id);

        if (!isset($post)){
            throw new InvalidArgumentException('Unable to update post data');
        }

        $post->title = $data['title'];
        $post->description = $data['description'];
        $post->update();

        return $post;
    }

    public function delete($id){
        $post = $this->post->find($id);

        if (!isset($post)){
            throw new InvalidArgumentException('unable to delete post data');
        }

        $post->delete();

        return $post;
    }
}
