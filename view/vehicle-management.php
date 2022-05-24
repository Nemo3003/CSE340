
 <!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/phpmotors/css/large.css" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/base.css" media="screen">
  <title>Vehicle Management | PHP Motors</title>

</head>
<body >
    
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?> 
    
    <nav id ="page_nav" > 
        <?php echo $navList; ?>
        </nav>
    <main class="vehMan">
        <h1>Vehicle Management</h1>
        <div class="vehicleManagementView">
            <ul>
                <li><a class="largeLink" href="/phpmotors/vehicles/index.php?action=Addclassification">Add Classification</a></li>
                <li><a class="largeLink" href="/phpmotors/vehicles/index.php?action=vehicle">Add Vehicle</a></li>
            </ul>
            <?php
                if (isset($message)) { 
                echo $message; 
                } 
                if (isset($classificationList)) { 
                echo '<h2>Vehicles By Classification</h2>'; 
                echo '<p class="subHeading">Choose a classification to see those vehicles</p>'; 
                echo $classificationList; 
                }
            ?>
        </div>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>

</body>
</html>
<?php unset($_SESSION['message']); ?>