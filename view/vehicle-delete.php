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
    <title><title><?php if(isset($invInfo['invMake'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?> | PHP Motors</title> | PHP Motors</title>
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
    <h1><?php if(isset($invInfo['invMake'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?></h1>
        <?php
            if (isset($message)) {
                echo $message;
            }
        ?>
        <p class="note">*Note all fields are required</p>
        <p>Confirm Vehicle Deletion. The delete is permanent.</p>
        <form method="post" action="/phpmotors/vehicles/">
<fieldset>
	<label for="invMake">Vehicle Make</label>
	<input type="text" readonly name="invMake" id="invMake" <?php
if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>>

	<label for="invModel">Vehicle Model</label>
	<input type="text" readonly name="invModel" id="invModel" <?php
if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>>

	<label for="invDescription">Vehicle Description</label>
	<textarea name="invDescription" readonly id="invDescription"><?php
if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }
?></textarea>

<input type="submit" class="regbtn" name="submit" value="Delete Vehicle">

	<input type="hidden" name="action" value="deleteVehicle">
	<input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){
echo $invInfo['invId'];} ?>">

</fieldset>
</form>
        </div>
    </main>
    <hr>
    <footer>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
    
</body>
</html>