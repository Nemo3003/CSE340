<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/large.css" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/base.css" media="screen">

    <title>Login</title>
</head>

<body>
        <header id ="header_page">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
        </header>
        <nav id ="page_nav" > 
        <?php echo $navList; ?>
        </nav>
        <main>
        
        <form name="login-form" method="post" action="/phpmotors/accounts/">
            <label>Email <br>
            <input name="clientEmail" id="clientEmail" type="email" placeholder="Email*" required></label>
            <label>Password<br>
            <input name="clientPassword" id="clientPassword" type="password" placeholder="Password*" required> </label><br>
            <input type="submit" class="button" value="Login">
            <p>No Account? <a href="/phpmotors/accounts/index.php?action=registration">Sign Up!</a></p>
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
  