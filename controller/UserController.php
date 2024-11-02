<?php


require_once './model/User.php';
require_once './utils/ResponseHelpers.php';
require_once './utils/RequestHelper.php';
require_once './vendor/autoload.php';

use Firebase\JWT\JWT;

class UserController
{
    private User $userModel;
    private string $secretKey = 'secret';

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function registerUser(): void
    {
        $data = RequestHelper::getJsonInput();
        $username = $data['username'] ?? '';
        $password = $data['password'] ?? '';

        if ($this->userModel->findUserByUsername($username)) {
            ResponseHelper::respondWithError(409, 'Username already exists');
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $this->userModel->createUser($username, $hashedPassword);

        ResponseHelper::respond(201, 'User registered successfully');
    }

    public function login(): void
    {
        $data = RequestHelper::getJsonInput();
        $username = $data['username'] ?? '';
        $password = $data['password'] ?? '';

        $user = $this->validateUser($username, $password);

        if ($user) {
            $token = $this->generateToken($user['username'], $user['id']);
            ResponseHelper::respond(200, 'Login successful', ['token' => $token]);
        } else {
            ResponseHelper::respondWithError(401, 'Invalid username or password');
        }
    }

    private function validateUser(string $username, string $password): ?array
    {
        $user = $this->userModel->findUserByUsername($username);
        return $user && $this->userModel->verifyPassword($password, $user['password']) ? $user : null;
    }

    private function generateToken(string $username, int $id): string
    {
        $payload = [
            'iat' => time(),
            'exp' => time() + 3600, // 1-hour expiration
            'username' => $username,
            'user_id' => $id
        ];
        return JWT::encode($payload, $this->secretKey, 'HS256');
    }
}
