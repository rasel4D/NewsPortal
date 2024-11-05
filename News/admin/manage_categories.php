<?php
session_start();
require_once '../config.php';
require_once '../functions.php';

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || !is_admin($conn, $_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$categories = get_all_categories($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_category'])) {
        $name = trim($_POST['category_name']);
        if (!empty($name)) {
            add_category($conn, $name);
        }
    } elseif (isset($_POST['edit_category'])) {
        $id = intval($_POST['category_id']);
        $name = trim($_POST['category_name']);
        if (!empty($name)) {
            update_category($conn, $id, $name);
        }
    } elseif (isset($_POST['delete_category'])) {
        $id = intval($_POST['category_id']);
        delete_category($conn, $id);
    } elseif (isset($_POST['restore_category'])) {
        $id = intval($_POST['category_id']);
        restore_category($conn, $id);
    }
    
    header("Location: manage_categories.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories - News Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <?php include 'admin_header.php'; ?>

    <main class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Manage Categories</h1>
        
        <form action="manage_categories.php" method="post" class="mb-8">
            <div class="flex gap-4">
                <input type="text" name="category_name" placeholder="New category name" required class="flex-grow p-2 border rounded-lg">
                <button type="submit" name="add_category" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Add Category</button>
            </div>
        </form>

        <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Name</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td class="p-3"><?php echo $category['id']; ?></td>
                        <td class="p-3"><?php echo $category['name']; ?></td>
                        <td class="p-3"><?php echo $category['is_deleted'] ? 'Deleted' : 'Active'; ?></td>
                        <td class="p-3">
                            <?php if (!$category['is_deleted']): ?>
                                <form action="manage_categories.php" method="post" class="inline-block">
                                    <input type="hidden" name="category_id" value="<?php echo $category['id']; ?>">
                                    <input type="text" name="category_name" value="<?php echo $category['name']; ?>" required class="p-1 border rounded">
                                    <button type="submit" name="edit_category" class="bg-green-600 text-white px-2 py-1 rounded hover:bg-green-700">Edit</button>
                                    <button type="submit" name="delete_category" class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700">Delete</button>
                                </form>
                            <?php else: ?>
                                <form action="manage_categories.php" method="post" class="inline-block">
                                    <input type="hidden" name="category_id" value="<?php echo $category['id']; ?>">
                                    <button type="submit" name="restore_category" class="bg-yellow-600 text-white px-2 py-1 rounded hover:bg-yellow-700">Restore</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <?php include 'admin_footer.php'; ?>
    <script src="admin_script.js"></script>
</body>
</html>