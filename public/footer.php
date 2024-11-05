<footer class="bg-green shadow-md mt-8">
    <div class="container mx-auto px-4 py-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-lg font-bold mb-4">About Us</h3>
                <p class="text-gray-600">Your trusted source for the latest news and updates from around the world.</p>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-4">Categories</h3>
                <ul class="space-y-2">
                    <?php foreach ($categories as $category): ?>
                        <li>
                            <a href="category.php?id=<?php echo $category['id']; ?>" 
                               class="text-gray-600 hover:text-blue-600">
                                <?php echo $category['name']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-4">Contact</h3>
                <p class="text-gray-600">Email: rasel@gmail.com</p>
                <p class="text-gray-600">Phone: 01866315753</p>
            </div>
        </div>
        <div class="border-t mt-8 pt-6 text-center text-gray-600">
            <p>&copy; <?php echo date('Y'); ?> News Portal. All rights reserved.</p>
        </div>
    </div>
</footer>