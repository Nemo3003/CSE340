<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/large.css" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/base.css" media="screen">
    <title>Register</title>
    </head>

<body>
        <header id ="header_page">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
        </header>
        <nav id ="page_nav" > 
        <?php echo $navList; ?>
        </nav>
        <main>
        <?php
            if (isset($message)) {
            echo $message;
            }
        ?>
        <form name="form" method="post" action="/phpmotors/accounts/index.php">
        <h1>Sign Up</h1>
            <label>First Name<br>
            <input name="clientFirstname" id="clientFirstname" type="text" placeholder="First Name*"  required></label> <br>
            <label>Last Name<br>
            <input name="clientLastname" id="clientLastname" type="text" placeholder="Last Name*"  required></label><br>
            <label>Email<br>
            <input name="clientEmail" id="clientEmail" type="email" placeholder="Email*" required></label><br>
            <label>Password<br>
            <input name="clientPassword" id="clientPassword" type="password" placeholder="Password*" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"></label><br>
            <span class="password">Passwords must be at least 8 characters long and contain at least 1 number, 1 capital letter and 1 special character</span><br>

                <input type="submit" name="submit" id="regbtn" value="Register"><br>
                <input type="hidden" name="action" value="register">
            <h6>Already have an account? <a href="/phpmotors/accounts/index.php?action=login"><span>Login</span></a></h6>
        </form>
  <div id="sign-up-button">
    
  </div>
        <hr>
        </main>
    <footer id = "footer_page">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
    <script src = "js/app.js"></script>
</body>
</html>
