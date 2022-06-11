<?php
  // Check if user is logged in. If not, send to home
  if(!$_SESSION['loggedin'] ) {
    header('Location: /phpmotors/index.php');
  }
  /**Email: admin@cse340.net
Password: Sup3rU$er */
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/large.css" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/base.css" media="screen">
    <title>Admin</title>
    </head>

<body>
        <header id ="header_page">
        <?php require '../snippets/header.php'; ?> 
        </header>
        <nav id ="page_nav" > 
        <?php echo $navList; ?>
        </nav>
        <main>
        <div id="data-admin">
            <!--Say hi to the user logged in-->
            <h1>Welcome! <?php echo $_SESSION['clientData']['clientFirstname']?></h1>
            <ul>
                <li>First Name: <?php echo $_SESSION['clientData']['clientFirstname']?></li>
                <li>Last Name: <?php echo $_SESSION['clientData']['clientLastname']?></li>
                <li>Email: <?php echo $_SESSION['clientData']['clientEmail']?></li>
            </ul>
            <!--Check if the user has the level required-->
            <?php if($_SESSION['clientData']['clientLevel'] > 1){
                 echo "<a class='button' href='/phpmotors/vehicles/index.php'>Vehicle Management</a> <br> <br>";
            }?>
                            
            
        <?php
            
        ?>
		</div>
        </main>
    <footer id = "footer_page">
    <?php require '../snippets/footer.php'; ?> 
    </footer>
    <script src = "js/app.js"></script>
</body>
</html>