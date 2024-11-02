<?php


require_once './config.php';

class Blog
{
    public function fetchAllPosts()
    {
        $db = getDB();
        $stmt = $db->query("SELECT * FROM posts");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchPostById($id)
    {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM posts WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createPost($title, $content, $userId)
    {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO posts (title, content, user_id) VALUES (:title, :content, :user_id)");
        $stmt->execute(['title' => $title, 'content' => $content, 'user_id' => $userId]);
    }

    public function updatePost($id, $title, $content)
    {
        $db = getDB();
        $stmt = $db->prepare("UPDATE posts SET title = :title, content = :content WHERE id = :id");
        $stmt->execute(['title' => $title, 'content' => $content, 'id' => $id]);
    }

    public function deletePost($id)
    {
        $db = getDB();
        $stmt = $db->prepare("DELETE FROM posts WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}

