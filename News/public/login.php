<?php
require_once '../includes/functions.php';
require_once '../includes/auth.php';

// Initialize variables
$error_message = '';
$latest_news = get_latest_news(10);
$categories = get_categories();

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    // Basic validation
    if (empty($username) || empty($password)) {
        $error_message = "Please fill in all fields.";
    } else {
        // Check if input is email or username
        $is_email = filter_var($username, FILTER_VALIDATE_EMAIL);
        
        // Get user from database
        $sql = $is_email 
            ? "SELECT * FROM users WHERE email = ? AND is_deleted = 0"
            : "SELECT * FROM users WHERE username = ? AND is_deleted = 0";
            
        $stmt = executeQuery($sql, [$username], 's');
        $user = $stmt->get_result()->fetch_assoc();
        
        if ($user && password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['is_admin'] = $user['is_admin'];
            
            // Regenerate session ID for security
            session_regenerate_id(true);
            
            // Redirect based on user role
            if ($user['is_admin'] == 1) {
                header('Location: ' . SITE_URL . '/admin/admin_profile.php');
                exit();
            } else {
                header('Location: ' . SITE_URL . '/public/index.php');
                exit();
            }
        } else {
            $error_message = "Invalid username/email or password.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="flex justify-center items-center h-screen">  
        <div class="bg-indigo-500 shadow-2xl shadow-indigo-500/50  p-8 rounded-lg w-full max-w-md">
            <h1 class="text-gray-100 text-2xl font-bold mb-4">Login</h1>

            <?php if (isset($error_message) && !empty($error_message)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                    <strong class="font-bold">Error:</strong>
                    <span class="block sm:inline"><?php echo htmlspecialchars($error_message); ?></span>
                </div>
            <?php endif; ?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <?php $csrf_token = generate_csrf_token(); ?>
                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                
                <div class="mb-4">
                    <label class="text-gray-100 block font-bold mb-2" for="username">Username or Email:</label>
                    <input class="border rounded-lg py-2 px-3 w-full" type="text" id="username" name="username" 
                           placeholder="Username or Email" required>
                </div>
                <div class="mb-4">
                    <label class="text-gray-100 block font-bold mb-2" for="password">Password:</label>
                    <input class="border rounded-lg py-2 px-3 w-full" type="password" id="password" name="password" 
                           placeholder="Password" required>
                </div>
                <button class="bg-blue-500 hover:bg-green-700 text-back font-bold py-2 px-4 rounded w-full" 
                        type="submit">Login</button>
            </form>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>