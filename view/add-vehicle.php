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
  <h1>Add a new Vehicle to the Inventory</h1>
  <form name="add-vehicle-form" method="post" action="/phpmotors/vehicles/index.php">
    <select name="classificationId" id="classificationId" <?php if(isset($classificationId)){echo "value='$classificationId'";}  ?> required>
      <option value="" selected hidden disabled>Choose Vehicle Classification:</option>
      <?php 
        foreach ($classifications as $class => $id) {
          if(isset($classificationId)) {
            if($id === $classificationId) {
              echo "<option value='$id' selected>$class</option>";
            }
          }
          echo "<option value='$id'>$class</option>";
        }
      ?>
    </select>
    <input name="invMake" id="invMake" type="text" placeholder="Make*" <?php if(isset($invMake)){echo "value='$invMake'";}  ?> required>
    <input name="invModel" id="invModel" type="text" placeholder="Model*" <?php if(isset($invModel)){echo "value='$invModel'";}  ?> required>
    <input name="invDescription" id="invDescription" type="text" placeholder="Description*" <?php if(isset($invDescription)){echo "value='$invDescription'";}  ?> required>
    <label for="invImage">Choose Image Path:</label>
    <input name="invImage" id="invImage" type="text" placeholder="Image Path*" value="/phpmotors/images/no-image.png" <?php if(isset($invImage)){echo "value='$invImage'";}  ?> required>
    <label for="invImage">Choose Thumbnail Path:</label>
    <input name="invThumbnail" id="invThumbnail" type="text" placeholder="Thumbnail Path*" value="/phpmotors/images/no-image.png" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}  ?> required>
    <input name="invPrice" id="invPrice" type="number" placeholder="Price*" <?php if(isset($invPrice)){echo "value='$invPrice'";}  ?> required>
    <input name="invStock" id="invStock" type="text" placeholder="Stock*" <?php if(isset($invStock)){echo "value='$invStock'";}  ?> required>
    <input name="invColor" id="invColor" type="text" placeholder="Color*" <?php if(isset($invColor)){echo "value='$invColor'";}  ?> required>
    <input type="submit" name="submit" value="Submit">
    <input type="hidden" name="action" value="putVehicle">
  </form>
  <footer id="footer">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
  </footer>
</body>
</html>