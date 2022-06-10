<?php
  // Check if user is logged in and correct level. If not, send to home
  if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 3) {
    header('Location: /phpmotors/index.php');
  }
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/phpmotors/css/base.css" media="screen">
  <link rel="stylesheet" href="/phpmotors/css/large.css" media="screen">

  <title>PHP Motors</title>
</head>
<body>
<header id ="header_page">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
        </header>
        <nav id ="page_nav" > 
        <?php echo $navList; ?>
        </nav>
  <?php
    if (isset($message)) {
    echo $message;
    }
  ?>
  <main class="vehMan">
  <h1>Add a new Vehicle Classification</h1>
  <form name="add-classification-form" method="post">
    <label for="classificationName">Add a classification</label>
    <input name="classificationName" id="classificationName" type="text" placeholder="Vehicle Classification*" maxlength="30" required>
    <span class="password">Vehicle Classification can be no longer than 30 characters</span>
    <input type="submit" name="submit" value="Submit">
    <input type="hidden" name="action" value="newClassification">
  </form>
  </main>
  <footer id="footer">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
  </footer>
</body>
</html>