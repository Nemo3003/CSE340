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
        <form name="form" method="post">
            <label>Sign Up!</label> <br>
            <label>First Name</label>
            <input name="clientFirstname" id="clientFirstname" type="text" placeholder="First Name*"  required> <br>
            <label>Last Name</label>
            <input name="clientLastname" id="clientLastname" type="text" placeholder="Last Name*"  required><br>
            <label>Email</label>
            <input name="clientEmail" id="clientEmail" type="email" placeholder="Email*" required><br>
            <label>Password</label>
            <input name="clientPassword" id="clientPassword" type="password" placeholder="Password*" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
            <span class="password">Passwords must be at least 8 characters long and contain at least 1 number, 1 capital letter and 1 special character</span><br>
            <input type="submit" name="submit" value="Sign up"><br>
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