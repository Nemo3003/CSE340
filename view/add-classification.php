
<!DOCTYPE html>
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
<header id="header">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
  </header>
  <nav id="navigation">
    <?php echo $navList; ?>
  </nav>
  <?php
    if (isset($message)) {
    echo $message;
    }
  ?>
  <h1>Add a new Vehicle Classification</h1>
  <form name="add-classification-form" method="post">
    <input name="classificationName" id="classificationName" type="text" placeholder="Vehicle Classification*" maxlength="30" required>
    <span class="password">Vehicle Classification can be no longer than 30 characters</span>
    <input type="submit" name="submit" value="Submit">
    <input type="hidden" name="action" value="putClass">
  </form>
  <footer id="footer">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
  </footer>
</body>
</html>