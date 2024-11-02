<?php

use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;

class AuthMiddleware
{
    private string $secretKey;
    private ?object $decodedToken = null;

    public function __construct(string $secretKey)
    {
        $this->secretKey = $secretKey;
    }

    public function handle(): void
    {
        $headers = $this->getAuthorizationHeader();

        if ($headers) {
            $jwt = $this->extractTokenFromHeader($headers);

            if ($jwt && $this->validateToken($jwt)) {
                return;
            } else {
                ResponseHelper::respondWithError(401, 'Invalid or missing token');
            }
        } else {
            ResponseHelper::respondWithError(401, 'Authorization header missing or improperly formatted');
        }
    }

    private function validateToken(string $jwt): bool
    {
        try {
            $this->decodedToken = JWT::decode($jwt, new \Firebase\JWT\Key($this->secretKey, 'HS256'));
            if ($this->decodedToken === null) {
                ResponseHelper::respondWithError(401, 'Invalid token');
                return false;
            }
            return true;
        } catch (ExpiredException $e) {
            ResponseHelper::respondWithError(401, 'Token expired');
        } catch (\Exception $e) {
            ResponseHelper::respondWithError(401, 'Invalid token');
        }
        return false;
    }

    public function getUserIdFromToken(): ?int
    {
        return $this->decodedToken->user_id ?? null;
    }

    private function getAuthorizationHeader(): ?string
    {
        return $_SERVER['HTTP_AUTHORIZATION'] ?? null;
    }

    private function extractTokenFromHeader(string $header): ?string
    {
        if (preg_match('/Bearer\s(\S+)/', $header, $matches)) {
            return $matches[1];
        }
        return null;
    }
}
