<?php

class ResponseHelper
{
    /**
     * Generic response handler for any type of response.
     * 
     * @param int $statusCode HTTP status code for the response.
     * @param string $message Primary message for the response.
     * @param array|null $data Optional array for additional data or errors.
     */
    public static function respond(int $statusCode, string $message, ?array $data = null): void
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');

        // Prepare the response array with message and optional data
        $response = ['message' => $message];

        if (!is_null($data)) {
            $response['data'] = $data;
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Shortcut method for error responses with flexible status codes and data.
     * 
     * @param int $statusCode HTTP status code for the error response.
     * @param string $errorMessage Error message.
     * @param array|null $errors Optional array for additional error details.
     */
    public static function respondWithError(int $statusCode, string $errorMessage, ?array $errors = null): void
    {
        self::respond($statusCode, $errorMessage, ['errors' => $errors]);
    }
}
