<?php
namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Response;

trait JsonResponseTrait
{
    protected int $httpStatusCode = 200;

    protected ?int $errorCode = null;

    public function getHTTPStatusCode(): int
    {
        return $this->httpStatusCode;
    }

    public function setHTTPStatusCode(int $statusCode): self
    {
        $this->httpStatusCode = $statusCode;

        return $this;
    }

    public function getErrorCode(): ?int
    {
        return $this->errorCode;
    }

    public function setErrorCode(int $errorCode): self
    {
        $this->errorCode = $errorCode;

        return $this;
    }

    public function result($data, bool $success, array $headers = []) : JsonResponse
    {
        return response()->json([
            'status' => $success,
            'data' => $data
        ], $this->getHTTPStatusCode(), $headers);
    }


    /**
     * Sends a response not found (404) to the request.
     * Error Code = 31.
     */
    public function respondNotFound(): JsonResponse
    {
        return $this->setHTTPStatusCode(Response::HTTP_NOT_FOUND)
            ->setErrorCode(31)
            ->respondWithError();
    }

    /**
     * Sends an error when the validator failed.
     * Error Code = 32.
     */
    public function respondValidatorFailed(Validator $validator): JsonResponse
    {
        return $this->setHTTPStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->setErrorCode(32)
            ->respondWithError($validator->errors()->all());
    }

    /**
     * Sends an error when the query didn't have the right parameters for
     * creating an object.
     * Error Code = 33.
     */
    public function respondNotTheRightParameters(string $message = null): JsonResponse
    {
        return $this->setHTTPStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)
            ->setErrorCode(33)
            ->respondWithError($message);
    }

    /**
     * Sends a response invalid query (http 500) to the request.
     * Error Code = 40.
     */
    public function respondInvalidQuery(string $message = null): JsonResponse
    {
        return $this->setHTTPStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)
            ->setErrorCode(40)
            ->respondWithError($message);
    }

    /**
     * Sends an error when the query contains invalid parameters.
     * Error Code = 41.
     */
    public function respondInvalidParameters(string $message = null): JsonResponse
    {
        return $this->setHTTPStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->setErrorCode(41)
            ->respondWithError($message);
    }

    /**
     * Sends a response unauthorized (401) to the request.
     * Error Code = 42.
     */
    public function respondUnauthorized(string $message = null): JsonResponse
    {
        return $this->setHTTPStatusCode(Response::HTTP_UNAUTHORIZED)
            ->setErrorCode(42)
            ->respondWithError($message);
    }

    /**
     * Sends a response with error.
     */
    public function respondWithError(array|string $message = null): JsonResponse
    {
        return $this->result([
            'error' => [
                'message' => $message ?? config('api.error_codes.'.$this->getErrorCode()),
                'error_code' => $this->getErrorCode(),
            ],
        ], false);
    }

    /**
     * Sends a response that the object has been deleted, and also indicates
     * the id of the object that has been deleted.
     */
    public function respondObjectDeleted(string $id): JsonResponse
    {
        return $this->result([
            'deleted' => true,
            'id' => $id,
        ], true);
    }
}
