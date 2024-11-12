<?php 
require_once __DIR__ . '/../config/config.php'; 

function getConnection() {     
    static $conn = null;     
    
    if ($conn === null) {         
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);         
        if ($conn->connect_error) {             
            die("Connection failed: " . $conn->connect_error);         
        }         
        $conn->set_charset("utf8mb4");     
    }          
    return $conn; 
}  

function executeQuery($sql, $params = [], $types = '') {     
    $conn = getConnection();     
    $stmt = $conn->prepare($sql);          
    if ($params) {         
        $stmt->bind_param($types, ...$params);     
    }          
    $stmt->execute();     
    return $stmt; 
} 

function save_user($username, $email, $hashed_password) {     
    $conn = getConnection();
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");     
    $stmt->bind_param("sss", $username, $email, $hashed_password);     
    if ($stmt->execute()) {         
        $user_id = $stmt->insert_id;
        $stmt->close();         
        return $user_id;     
    } else {         
        $stmt->close();         
        return false;     
    } 
} 

// Add this new function for user authentication
function authenticate_user($username) {
    $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = executeQuery($sql, [$username, $username], 'ss');
    return $stmt->get_result()->fetch_assoc();
}
?>