<?php
require_once '../includes/functions.php';
require_once __DIR__ . '/../config/config.php';

// Start the session if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the user's credentials (replace this with your actual authentication logic)
    if ($username === 'admin' && $password === 'password') {
        // If the credentials are valid, start the session and redirect the user
        $_SESSION['user_id'] = 1; // Replace with the actual user ID
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit;
    } else {
        // If the credentials are invalid, display an error message
        $error_message = 'Invalid username or password.';
    }
}
?>
<?php
require_once '../includes/functions.php';
$latest_news = get_latest_news(10);
$categories = get_categories();
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
        <div class="bg-white shadow-md p-8 rounded-lg w-full max-w-md">
            <h1 class="text-2xl font-bold mb-4">Login</h1>

            <?php if (isset($error_message)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                    <strong class="font-bold">Error:</strong>
                    <span class="block sm:inline"><?php echo $error_message; ?></span>
                </div>
            <?php endif; ?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                <div class="mb-4">
                    <label class="block font-bold mb-2" for="username">Username:</label>
                    <input class="border rounded-lg py-2 px-3 w-full" type="text" id="username" name="username" required>
                </div>
                <div class="mb-4">
                    <label class="block font-bold mb-2" for="password">Password:</label>
                    <input class="border rounded-lg py-2 px-3 w-full" type="password" id="password" name="password" required>
                </div>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full" type="submit">Login</button>
            </form>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    
</body>
</html>