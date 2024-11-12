<?php
require_once '../includes/functions.php';
require_once '../includes/database.php';
// Start the session if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate the input data
    $errors = [];
    if (empty($username)) {
        $errors[] = 'Username is required.';
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email address.';
    }
    if (empty($password)) {
        $errors[] = 'Password is required.';
    } elseif ($password !== $confirm_password) {
        $errors[] = 'Passwords do not match.';
    }

    // If there are no errors, proceed with registration
    if (empty($errors)) {
        // Hash the password for secure storage
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Save the user data to the database (replace this with your actual database logic)
        $user_id = save_user($username, $email, $hashed_password);

        // Start the session and redirect the user
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        header('<Location:../admin/index.php');
        exit;
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
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
</head>
<body >
<?php include 'header.php'; ?>
    <div class="flex justify-center items-center h-screen mx-auto my-auto mt-10 ">
        <div class="bg-indigo-500 shadow-lg shadow-indigo-500/50  p-8 rounded-lg w-full max-w-md">
            <h1 class="text-2xl font-bold mb-4">Register</h1>

            <?php if (!empty($errors)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                    <strong class="font-bold">Error:</strong>
                    <ul class="list-disc pl-4">
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                <div class="mb-4">
                    <label class="block font-bold mb-2" for="username">Username:</label>
                    <input class="border rounded-lg py-2 px-3 w-full" type="text" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="mb-4">
                    <label class="block font-bold mb-2" for="email">Email:</label>
                    <input class="border rounded-lg py-2 px-3 w-full" type="email" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="mb-4">
                    <label class="block font-bold mb-2" for="password">Password:</label>
                    <input class="border rounded-lg py-2 px-3 w-full" type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="mb-4">
                    <label class="block font-bold mb-2" for="confirm_password">Confirm Password:</label>
                    <input class="border rounded-lg py-2 px-3 w-full" type="password" id="confirm_password" name="confirm_password" placeholder="Confirm-Password" required>
                </div>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full" type="submit">Register</button>
            </form>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>