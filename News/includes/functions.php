<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/database.php';

// News Functions
function get_latest_news($limit = 10) {
    $sql = "SELECT n.*, c.name as category_name, u.username as author 
            FROM news_posts n 
            JOIN categories c ON n.category_id = c.id 
            JOIN users u ON n.author_id = u.id 
            WHERE n.is_published = 1 AND n.is_deleted = 0 
            ORDER BY n.created_at DESC LIMIT ?";
    
    $stmt = executeQuery($sql, [$limit], 'i');
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function get_news_by_id($id) {
    $sql = "SELECT n.*, c.name as category_name, u.username as author 
            FROM news_posts n 
            JOIN categories c ON n.category_id = c.id 
            JOIN users u ON n.author_id = u.id 
            WHERE n.id = ? AND n.is_published = 1 AND n.is_deleted = 0";
    
    $stmt = executeQuery($sql, [$id], 'i');
    return $stmt->get_result()->fetch_assoc();
}

// Category Functions
function get_categories() {
    $sql = "SELECT * FROM categories WHERE is_deleted = 0 ORDER BY name";
    $result = executeQuery($sql)->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function add_category($name) {
    $sql = "INSERT INTO categories (name) VALUES (?)";
    return executeQuery($sql, [$name], 's');
}

// Comment Functions
function get_approved_comments($news_id) {
    $sql = "SELECT c.*, u.username 
            FROM comments c 
            JOIN users u ON c.user_id = u.id 
            WHERE c.post_id = ? AND c.is_approved = 1 
            ORDER BY c.created_at DESC";
    
    $stmt = executeQuery($sql, [$news_id], 'i');
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function add_comment($news_id, $user_id, $content) {
    $sql = "INSERT INTO comments (post_id, user_id, content) VALUES (?, ?, ?)";
    return executeQuery($sql, [$news_id, $user_id, $content], 'iis');
}

// User Functions
function register_user($username, $email, $password) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    return executeQuery($sql, [$username, $email, $hashed_password], 'sss');
}

function login_user($email, $password) {
    $sql = "SELECT * FROM users WHERE email = ? AND is_deleted = 0";
    $stmt = executeQuery($sql, [$email], 's');
    $user = $stmt->get_result()->fetch_assoc();
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['is_admin'] = $user['is_admin'];
        return true;
    }
    
    return false;
}

// Admin Functions
function is_admin() {
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
}

function require_admin() {
    if (!is_admin()) {
        header('Location: ' . SITE_URL . 'public\login.php');
        exit();
    }
}
