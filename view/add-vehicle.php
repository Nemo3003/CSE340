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
  <h1>Add a new Vehicle to the Inventory</h1>
  <form name="add-vehicle-form" method="post" >
    <select name="classificationId" id="classificationId" <?php if(isset($classificationId)){echo "value='$classificationId'";}  ?> required>
      <option value="">Choose Vehicle Classification:</option>
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
    <input name="invMake" id="invMake" type="text" placeholder="Make*" required>
    <input name="invModel" id="invModel" type="text" placeholder="Model*"  required>
    <input name="invDescription" id="invDescription" type="text" placeholder="Description*"  required>
    <label for="invImage">Choose Image Path:</label>
    <input name="invImage" id="invImage" type="text" placeholder="Image Path*" value="/phpmotors/images/no-image.png"  required>
    <label for="invImage">Choose Thumbnail Path:</label>
    <input name="invThumbnail" id="invThumbnail" type="text" placeholder="Thumbnail Path*" value="/phpmotors/images/no-image.png"  required>
    <input name="invPrice" id="invPrice" type="number" placeholder="Price*" required>
    <input name="invStock" id="invStock" type="text" placeholder="Stock*"  required>
    <input name="invColor" id="invColor" type="text" placeholder="Color*" required>
    <input type="submit" name="submit" value="Submit">
    <input type="hidden" name="action" value="newVehicle">
  </form>
      </main>
  <footer id="footer">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
  </footer>
</body>
</html>