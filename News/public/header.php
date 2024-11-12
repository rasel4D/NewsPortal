<?php if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<?php
require_once '../includes/functions.php';
?>
<!DOCTYPE html>
<header class="bg-black shadow-md">
    <nav class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
            <a href="index.php" class="text-2xl font-bold text-white capitalize">
                <?php echo SITE_NAME; ?>
            </a>
            
            <div class="space-x-4 ">
                <a href="index.php" class="text-white  capitalize hover:text-blue-600">Home</a>
                <a href="about.php" class="text-white capitalize  hover:text-blue-600">About</a>
                
                
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="admin.php" class="text-white capitalize hover:text-blue-600">Profile</a>
                    <a href="logout.php" class="text-white capitalize hover:text-blue-600">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="text-white capitalize  hover:text-blue-600">Login</a>
                    <a href="register.php" class="text-white capitalize hover:text-blue-600">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>