<?php

require_once './model/Blog.php';
require_once './middleware/AuthMiddleware.php';
require_once './utils/ResponseHelpers.php';
require_once './utils/RequestHelper.php';

class BlogController
{
    private Blog $blogModel;
    private AuthMiddleware $authMiddleware;

    public function __construct(AuthMiddleware $authMiddleware)
    {
        $this->blogModel = new Blog();
        $this->authMiddleware = $authMiddleware;
    }

    public function getPosts(): void
    {
        $posts = $this->blogModel->fetchAllPosts();
        ResponseHelper::respond(200, 'Posts fetched successfully', $posts);
    }

    public function getPost(int $id): void
    {
        $post = $this->blogModel->fetchPostById($id);

        if (!$post) {
            ResponseHelper::respondWithError(404, 'Post not found');
        }

        ResponseHelper::respond(200, 'Post fetched successfully', $post);
    }

    public function createPost(): void
    {
        $data = RequestHelper::getJsonInput();
        $userId = $this->authMiddleware->getUserIdFromToken();

        if (!$userId) {
            ResponseHelper::respondWithError(401, 'Unauthorized');
        }

        $validationErrors = $this->validatePostData($data);
        if ($validationErrors) {
            ResponseHelper::respondWithError(400, 'Validation errors', $validationErrors);
        }

        $this->blogModel->createPost($data['title'], $data['content'], $userId);
        ResponseHelper::respond(201, 'Post created successfully');
    }

    public function updatePost(int $id): void
    {
        $data = RequestHelper::getJsonInput();
        $userId = $this->authMiddleware->getUserIdFromToken();

        if (!$userId) {
            ResponseHelper::respondWithError(401, 'Unauthorized');
        }

        $post = $this->blogModel->fetchPostById($id);
        if (!$post || $post['user_id'] != $userId) {

            ResponseHelper::respondWithError(403, 'You do not have permission to update this post');
        }

        $validationErrors = $this->validatePostData($data);
        if ($validationErrors) {
            ResponseHelper::respondWithError(400, 'Validation errors', $validationErrors);
        }

        $this->blogModel->updatePost($id, $data['title'], $data['content']);
        ResponseHelper::respond(200, 'Post updated successfully');
    }

    public function deletePost(int $id): void
    {
        $userId = $this->authMiddleware->getUserIdFromToken();

        if (!$userId) {
            ResponseHelper::respondWithError(401, 'Unauthorized');
        }

        $post = $this->blogModel->fetchPostById($id);
        if (!$post || $post['user_id'] != $userId) {
            ResponseHelper::respondWithError(403, 'You do not have permission to delete this post');
        }

        $this->blogModel->deletePost($id);
        ResponseHelper::respond(200, 'Post deleted successfully');
    }

    private function validatePostData(array $data): array
    {
        $errors = [];

        if (empty($data['title'])) {
            $errors['title'] = 'Title is required';
        } elseif (strlen($data['title']) < 3) {
            $errors['title'] = 'Title must be at least 3 characters';
        }

        if (empty($data['content'])) {
            $errors['content'] = 'Content is required';
        } elseif (strlen($data['content']) < 10) {
            $errors['content'] = 'Content must be at least 10 characters';
        }

        return $errors;
    }
}
