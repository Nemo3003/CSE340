<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/large.css" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/base.css" media="screen">
    <title>Template</title>
    </head>

<body>
        <header id ="header_page">
        <?php require './snippets/header.php'; ?> 
        </header>
        <nav id ="page_nav" > 
        <?php echo $navList; ?>
        </nav>
        <main>
        <h1>CONTENT TITLE HERE</h1>
        <hr>
        </main>
    <footer id = "footer_page">
    <?php require './snippets/footer.php'; ?> 
    </footer>
    <script src = "js/app.js"></script>
</body>
</html>