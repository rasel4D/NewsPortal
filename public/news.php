<?php
require_once '../includes/functions.php';

$news_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$news = get_news_by_id($news_id);

if (!$news) {
    header('Location: index.php');
    exit();
}

$comments = get_approved_comments($news_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    check_csrf_token();
    check_login();
    
    $content = trim($_POST['comment']);
    if (!empty($content)) {
        add_comment($news_id, $_SESSION['user_id'], $content);
        header("Location: news.php?id=$news_id");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($news['title']); ?> - <?php echo SITE_NAME; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <?php include 'templates/header.php'; ?>

    <main class="container mx-auto px-4 py-8">
        <article class="bg-white rounded-lg shadow-md overflow-hidden">
            <?php if ($news['image_url']): ?>
                <img src="<?php echo $news['image_url']; ?>" 
                     alt="<?php echo htmlspecialchars($news['title']); ?>" 
                     class="w-full h-64 object-cover">
            <?php endif; ?>
            
            <div class="p-8">
                <h1 class="text-3xl font-bold mb-4">
                    <?php echo htmlspecialchars($news['title']); ?>
                </h1>
                <div class="text-gray-600 mb-4">
                    Published on <?php echo date('F j, Y', strtotime($news['created_at'])); ?> 
                    in <span class="text-blue-600 font-semibold">
                        <?php echo htmlspecialchars($news['category_name']); ?>
                    </span>
                    by <?php echo htmlspecialchars($news['author']); ?>
                </div>
                <div class="prose max-w-none">
                    <?php echo nl2br(htmlspecialchars($news['content'])); ?>
                </div>
            </div>
        </article>

        <!-- Comments Section -->
        <section class="mt-12">
            <h2 class="text-2xl font-bold mb-4">Comments</h2>
            
            <?php if (isset($_SESSION['user_id'])): ?>
                <form action="news.php?id=<?php echo $news_id; ?>" method="post" class="mb-8">
                    <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
                    <textarea name="comment" rows="4" 
                              class="w-full p-2 border rounded-lg" 
                              placeholder="Leave a comment" required></textarea>
                    <button type="submit" 
                            class="mt-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        Submit Comment
                    </button>
                </form>
            <?php else: ?>
                <p class="mb-8">
                    Please <a href="login.php" class="text-blue-600 hover:underline">log in</a> 
                    to leave a comment.
                </p>
            <?php endif; ?>

            <?php if ($comments): ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="bg-white rounded-lg shadow-md p-4 mb-4">
                        <p class="text-gray-600 mb-2">
                            <?php echo htmlspecialchars($comment['username']); ?> on 
                            <?php echo date('F j, Y', strtotime($comment['created_at'])); ?>
                        </p>
                        <p><?php echo nl2br(htmlspecialchars($comment['content'])); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No comments yet. Be the first to comment!</p>
            <?php endif; ?>
        </section>
    </main>

    <?php include 'templates/footer.php'; ?>
</body>
</html>
```