<?php

namespace App\Services;

use App\Repositories\PostRepository;
use Dotenv\Validator;
use InvalidArgumentException;

class PostService{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function savePostData($data)
    {
        $validator = Validator::make($data, [
           'title' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->postRepository->save($data);

        return $result;
    }
}
