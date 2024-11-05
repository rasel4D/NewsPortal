<?php if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<header class="bg-white shadow-md">
    <nav class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
            <a href="index.php" class="text-2xl font-bold text-blue-600">
                <?php echo SITE_NAME; ?>
            </a>
            
            <div class="space-x-4">
                <a href="index.php" class="text-gray-600 hover:text-blue-600">Home</a>
                <?php foreach (get_categories() as $category): ?>
                    <a href="category.php?id=<?php echo $category['id']; ?>" 
                       class="text-gray-600 hover:text-blue-600">
                        <?php echo htmlspecialchars($category['name']); ?>
                    </a>
                <?php endforeach; ?>
                
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="profile.php" class="text-gray-600 hover:text-blue-600">Profile</a>
                    <a href="logout.php" class="text-gray-600 hover:text-blue-600">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="text-gray-600 hover:text-blue-600">Login</a>
                    <a href="register.php" class="text-gray-600 hover:text-blue-600">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>