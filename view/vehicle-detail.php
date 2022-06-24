<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/phpmotors/css/large.css" media="screen">
  <link rel="stylesheet" href="/phpmotors/css/base.css" media="screen">
  <title><?php if(isset($invInfo['invMake'])){ echo "$invInfo[invMake] $invInfo[invModel]";} ?> | PHP Motors</title>
</head>
<body>
<header id ="header_page">
        <?php require '../snippets/header.php'; ?> 
        </header>
        <nav id ="page_nav" > 
        <?php echo $navList; ?>
        </nav>
            <main>
                <div class="main_content">
                    <h1 class="title-vehicle"><?php if(isset($invInfo['invMake'])){ echo "$invInfo[invMake] $invInfo[invModel]";} ?></h1>
                    <?php if (isset($_SESSION['message'])) { echo $_SESSION['message']; unset($_SESSION['message']); } ?>
                    <div class="vehicle-details">
                        <div class="left-veh">
                            <img class="vehicle-details-image" src="<?= $invInfo['invImage']; ?>" alt="<?= $invInfo['invMake'].' '.$invInfo['invModel']; ?> "/>

                                <span>Price: $<?= number_format($invInfo['invPrice'], 0) ?></span>

                        </div>
                        <div class="right-veh">
                            <h2><?= $invInfo['invMake']." ".$invInfo['invModel']; ?> Details</h2>
                            <ul class="vehicle-details-attributes">
                                <li>
                                    <p><?= $invInfo['invDescription']; ?></p>
                                </li>
                                <li>
                                    <p><strong>Color:</strong><?= $invInfo['invColor']; ?></p>
                                </li>
                                <li>
                                    <p><strong>In Stock:</strong><?= $invInfo['invStock']; ?></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </main>
  <footer id="footer">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
  </footer>
</body>
</html>