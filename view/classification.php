<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/phpmotors/css/large.css" media="screen">
  <link rel="stylesheet" href="/phpmotors/css/base.css" media="screen">
  <title><?php echo $classificationName; ?> vehicles | PHP Motors, Inc.</title>
</head>
<body>
    <header id="header">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
    </header>
    <nav id ="page_nav" > 
    <?php echo $navList; ?>
    </nav>
    <h1><?php echo $classificationName; ?> vehicles</h1>
    <?php if(isset($message)){
    echo $message; }
    ?>
    <?php if(isset($vehicleDisplay)){
    echo $vehicleDisplay;
    } ?>
  <footer id="footer">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
  </footer>
</body>
</html>