<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" media="screen">
    <title>Template</title>
    </head>

<body>
        <header id ="header_page">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header/header.php'; ?> 
        </header>
        <nav id ="page_nav" > 
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav/nav.php'; ?> 
        </nav>
        <main>
        <h1>Welcome to PHP Motors!</h1> 
        <hr>
        </main>
    <footer id = "footer_page">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer/footer.php'; ?> 
    </footer>
    <script src = "js/app.js"></script>
</body>
</html>