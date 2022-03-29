<?php

namespace App\Services;

use App\Repositories\PosRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use Exception;

class PostService
{
    protected $postRepository;

    public function __construct(PosRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function savePostData($data)
    {
        $validator = Validator::make($data, [
            'title' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->postRepository->save($data);

        return $result;
    }

    public function getAll()
    {
        return $this->postRepository->getAllPost();
    }

    public function updatePost($data, $id)
    {
        $validator = Validator::make($data, [
            'title' => 'min:2',
            'description' => 'max:255'
        ]);
        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        try {
//            DB::beginTransaction();
            $post = $this->postRepository->update($data, $id);
//            DB::commit();
        } catch (Exception $e) {
//            DB::rollBack();
            throw new InvalidArgumentException('Unable to update post data');
        }

        return $post;
    }

    public function deleteById($id)
    {
        try {
//            DB::beginTransaction();
            $post = $this->postRepository->delete($id);
//            DB::commit();
        } catch (Exception $e) {
//            DB::rollBack();
            throw new InvalidArgumentException('unable to delete post data');
        }

        return $post;
    }
}
