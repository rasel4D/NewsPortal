<?php
require_once '../includes/functions.php';
require_admin();

$total_categories = count_categories();
$total_news = count_published_news();
$total_users = count_users();
$recent_comments = get_recent_comments(5);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - News Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <?php include 'admin_header.php'; ?>

    <main class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Admin Dashboard</h1>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-2">Categories</h2>
                <p class="text-3xl font-bold"><?php echo $total_categories; ?></p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-2">Subcategories</h2>
                <p class="text-3xl font-bold"><?php echo $total_subcategories; ?></p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-2">Published News</h2>
                <p class="text-3xl font-bold"><?php echo $total_published_news; ?></p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-2">Trashed News</h2>
                <p class="text-3xl font-bold"><?php echo $total_trashed_news; ?></p>
            </div>
        </div>
    </main>

    <?php include 'admin_footer.php'; ?>
    <script src="admin_script.js"></script>
</body>
</html>