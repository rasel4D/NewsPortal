<?php
require_once '../includes/functions.php';

$latest_news = get_latest_news(10);
$categories = get_categories();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <?php include 'header.php'; ?>

    <main class="container mx-auto px-4 py-8">
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <?php foreach ($latest_news as $news): ?>
                <article class="bg-white rounded-lg shadow-md overflow-hidden">
                    <?php if ($news['image_url']): ?>
                        <img src="<?php echo $news['image_url']; ?>" 
                             alt="<?php echo htmlspecialchars($news['title']); ?>" 
                             class="w-full h-48 object-cover">
                    <?php endif; ?>
                    
                    <div class="p-4">
                        <span class="text-sm text-blue-600 font-semibold">
                            <?php echo htmlspecialchars($news['category_name']); ?>
                        </span>
                        <h2 class="text-xl font-bold mt-2 mb-2">
                            <?php echo htmlspecialchars($news['title']); ?>
                        </h2>
                        <p class="text-gray-600">
                            <?php echo substr(htmlspecialchars($news['content']), 0, 150) . '...'; ?>
                        </p>
                        <div class="mt-4 flex justify-between items-center">
                            <a href="news.php?id=<?php echo $news['id']; ?>" 
                               class="text-blue-600 hover:underline">
                                Read more
                            </a>
                            <span class="text-sm text-gray-500">
                                By <?php echo htmlspecialchars($news['author']); ?>
                            </span>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>