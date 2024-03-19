<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCommentRequest;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    use JsonResponseTrait;


    private $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepositoryInterface) {
        $this->commentRepository = $commentRepositoryInterface;
    }

    public function store(CreateCommentRequest $request)
    {
        return $this->commentRepository->create($request->all());

    }

}
