<?php

// If not login as Admin, redirect to home
if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] == 1){
    header('Location: /phpmotors/');
    exit;
}
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}

// Build the classifications option list
$classifList = '<select name="classificationId" id="classificationId">';
$classifList .= "<option>Choose a Car Classification</option>";
foreach ($classifications as $classification) {
 $classifList .= "<option value='$classification[classificationId]'";
 if(isset($classificationId)){
  if($classification['classificationId'] === $classificationId){
   $classifList .= ' selected ';
  }
 } elseif(isset($invInfo['classificationId'])){
 if($classification['classificationId'] === $invInfo['classificationId']){
  $classifList .= ' selected ';
 }
}
$classifList .= ">$classification[classificationName]</option>";
}
$classifList .= '</select>';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="PHP Motors Update Vehicle">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	            echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	            elseif(isset($invMake) && isset($invModel)) { 
		        echo "Modify $invMake $invModel"; }?> | PHP Motors</title>
      <link rel="stylesheet" href="/phpmotors/css/base.css" media="screen">
  <link rel="stylesheet" href="/phpmotors/css/large.css" media="screen">
</head>
<body>
    <div id="wrapper">
    <header>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
    </header>
    <nav id ="page_nav" > 
        <?php echo $navList; ?>
        </nav>
    <main>
    <h1><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	        echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
            elseif(isset($invMake) && isset($invModel)) { 
	        echo " Modify$invMake $invModel"; }?></h1>
        <?php
            if (isset($message)) {
                echo $message;
            }
        ?>
        <p class="note">*Note all fields are required</p>

  <form name="add-vehicle-form" method="POST">
  <?php echo $classifList; ?>
    <label for="invMake">Make</label>
    <input type="text" name="invMake" id="invMake" required <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>>
    <label for="invModel">Model</label>
    <input type="text" name="invModel" id="invModel" required <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>>
    <label for="invDescription">Description</label>
    <textarea name="invDescription" id="invDescription" required>
<?php if(isset($invDescription)){ echo $invDescription; } elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea>
    <label for="invImage">Choose Image Path:</label>
    <input name="invImage" id="invImage" type="text" placeholder="Image Path*" value="/phpmotors/images/no-image.png"<?php if(isset($invImage)){echo "value='$invImage'";} ?>  required>
    <label for="invThumbnail">Choose Thumbnail Path:</label>
    <input name="invThumbnail" id="invThumbnail" type="text" placeholder="Thumbnail Path*" value="/phpmotors/images/no-image.png"<?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} ?>  required>
    <label for="invPrice">Price</label>
    <input name="invPrice" id="invPrice" type="number" placeholder="Price*"<?php if(isset($invPrice)){echo "value='$invPrice'";} ?> required>
    <label for="invStock">Stock</label>
    <input name="invStock" id="invStock" type="number" placeholder="Stock*"<?php if(isset($invStock)){echo "value='$invStock'";} ?>  required>
    <label for="invColor">Color</label>
    <input name="invColor" id="invColor" type="text" placeholder="Color*"<?php if(isset($invColor)){echo "value='$invColor'";} ?> required>
    <br>
    <input type="submit" name="submit" value="Update Vehicle">
    <input type="hidden" name="action" value="updateVehicle">
    <input type="hidden" name="invId" value="
<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
elseif(isset($invId)){ echo $invId; } ?>
">
  </form>
        </div>
    </main>
    <hr>
    <footer>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
    
</body>
</html>