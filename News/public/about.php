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
    <div class="bg-white rounded-lg shadow-md p-8">
        <h1 class="text-3xl font-bold mb-4">About Our News Portal</h1>
        <p class="mb-4">Welcome to our news portal! We are dedicated to providing you with the latest and most relevant news from around the world.</p>

        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-2">Our Mission</h2>
            <p>Our mission is to be your go-to source for news and information. We strive to deliver accurate, unbiased, and timely news to our readers, helping them stay informed and up-to-date on the events that shape our world.</p>
        </div>

        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-2">Who We Are</h2>
            <p>Our team is made up of experienced journalists, editors, and researchers who are passionate about journalism and committed to upholding the highest standards of journalistic integrity. We come from diverse backgrounds and bring a wealth of knowledge and expertise to the table.</p>
        </div>

        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-2">Our Values</h2>
            <ul class="list-disc pl-6">
                <li>Accuracy: We are dedicated to providing factual and reliable information. We fact-check our stories and sources to ensure the highest level of accuracy.</li>
                <li>Objectivity: We strive to report the news without bias, presenting the facts in a balanced and impartial manner.</li>
                <li>Transparency: We are committed to being transparent about our processes and sources, so our readers can trust the information we provide.</li>
                <li>Responsibility: We understand the power of information and the impact it can have on our readers. We take our responsibility to the public seriously and always strive to do what is best for our community.</li>
            </ul>
        </div>

        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-2">Our Content</h2>
            <p>Our news portal covers a wide range of topics, including:</p>
            <ul class="list-disc pl-6">
                <li>Local and national news</li>
                <li>International news</li>
                <li>Business and finance</li>
                <li>Technology</li>
                <li>Sports</li>
                <li>Arts and entertainment</li>
                <li>Lifestyle and wellness</li>
            </ul>
            <p>We update our content regularly, ensuring that our readers always have access to the latest news and information.</p>
        </div>

        <div>
            <h2 class="text-2xl font-bold mb-2">Get in Touch</h2>
            <p>If you have any questions, comments, or feedback, please don't hesitate to contact us. We welcome your input and are always looking for ways to improve our services and better serve our community.</p>
            <p>Thank you for visiting our news portal. We look forward to providing you with the news and information you need to stay informed and engaged.</p>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>
</body>
</html>