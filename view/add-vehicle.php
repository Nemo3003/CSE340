?>
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
  <?php
$classificationList = '<select name="classificationId">';
foreach ($classifications as $classification){
    $classificationList .= "<option value='$classification[classificationId]'";
    if (isset($classificationId)){
        if ($classification['classificationId'] === $classificationId) {
            $clasifiList .= ' selected ';
        }
    }
    $classificationList .= ">$classification[classificationName]</option>";
}
$classificationList .= '</select>';
?>
  <h1>Add a new Vehicle to the Inventory</h1>
  <form name="add-vehicle-form" method="POST">
  <?php echo $classificationList; ?>
    <input name="invMake" id="invMake" type="text" placeholder="Make*"<?php if(isset($invMake)){echo "value='$invMake'";} ?> required><br>
    <input name="invModel" id="invModel" type="text" placeholder="Model*"<?php if(isset($invModel)){echo "value='$invModel'";} ?>  required><br>
    <textarea name="invDescription" id="invDescription" type="text" placeholder="Description*"<?php if(isset($invDescription)){echo "value='$invDescription'";} ?> required></textarea>
    <label>Choose Image Path:</label>
    <input name="invImage" id="invImage" type="text" placeholder="Image Path*" value="/phpmotors/images/no-image.png"<?php if(isset($invImage)){echo "value='$invImage'";} ?>  required>
    <label >Choose Thumbnail Path:</label>
    <input name="invThumbnail" id="invThumbnail" type="text" placeholder="Thumbnail Path*" value="/phpmotors/images/no-image.png"<?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} ?>  required>
    <input name="invPrice" id="invPrice" type="number" placeholder="Price*"<?php if(isset($invPrice)){echo "value='$invPrice'";} ?> required>
    <input name="invStock" id="invStock" type="text" placeholder="Stock*"<?php if(isset($invStock)){echo "value='$invStock'";} ?>  required>
    <input name="invColor" id="invColor" type="text" placeholder="Color*"<?php if(isset($invColor)){echo "value='$invColor'";} ?> required>
    <input type="submit" name="submit" value="Submit">
    <input type="hidden" name="action" value="newVehicle">
  </form>
      </main>
      <script src="../js/app.js"></script>
  <footer id="footer">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
  </footer>
</body>
</html>