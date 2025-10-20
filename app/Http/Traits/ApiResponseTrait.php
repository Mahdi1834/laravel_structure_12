<?php
namespace App\Http\Traits;

use Illuminate\Http\Response;

trait ApiResponseTrait {
    protected function successResponse($data = null, string $message = 'success', int $code = Response::HTTP_OK)
    {
        $response = [
            'success' => true,
            'message' => $message,
        ];

        if (!is_null($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $code);
    }

    protected function errorResponse(string $message = 'error', int $code = Response::HTTP_BAD_REQUEST, $errors = null)
    {
        $response = [
            'status' => 'error',
            'message' => $message,
        ];

        if (!is_null($errors)) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }

    protected function notFound(string $message = 'Resource not found')
    {
        return $this->errorResponse($message, 404);
    }

    protected function validationError($errors, string $message = 'The given data was invalid.')
    {
        return $this->errorResponse($message, 422, $errors);
    }

    protected function paginatedResponse($paginator, string $message = 'success')
    {
        // expects a LengthAwarePaginator or similar with items(), total(), perPage(), currentPage(), lastPage()
        $data = [
            'items' => $paginator->items(),
            'meta' => [
                'total' => $paginator->total(),
                'per_page' => $paginator->perPage(),
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
            ],
        ];

        return $this->successResponse($data, $message);
    }
}
