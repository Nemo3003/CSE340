<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/base.css" media="screen">
    <link rel="stylesheet" href="../css/large.css" media="screen">
    <title>Template</title>
</head>

<body>
        <header id ="header_page">
        <?php require '../snippets/header.php'; ?> 
        </header>
        <nav id ="page_nav" > 
        <?php echo $navlist ?>
        </nav>
        <main>
        <main>
        <form name="login-form" method="post" action="/phpmotors/accounts/">
            <label>Login Page</label>
        <input name="clientEmail" id="clientEmail" type="email" placeholder="Email*" required>
        <label>Email</label>
        <input name="clientPassword" id="clientPassword" type="password" placeholder="Password*" required>
        <label>Password</label>
        <span class="password">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
        <input type="submit" value="Login">
        <input type="hidden" name="action" value="Login">
    </form>
        <hr>
        </main>
    <footer id = "footer_page">
    <?php require '../snippets/footer.php'; ?> 
    </footer>
    <script src = "js/app.js"></script>
</body>
</html>
  <!---->
  