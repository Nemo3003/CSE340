<?php
function checkEmail($clientEmail){
  //The filter_var() function filters a variable with the specified filter.
 $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
 return $valEmail;
}

function checkPass($clientPassword){
  $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
  //The preg_match() function returns whether a match was found in a string.
  return preg_match($pattern, $clientPassword);
 }

 function NavBar($classifications) {
  $navList = '<ul>';
  $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
  foreach ($classifications as $classification) {
     $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=".urlencode($classification['classificationName']). "' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
  }
  $navList .= '</ul>';
  return $navList;
}
// Build the classifications select list 
function buildClassificationList($classifications){ 
  $classificationList = '<select name="classificationId" id="classificationList">'; 
  $classificationList .= "<option>Choose a Classification</option>"; 
  foreach ($classifications as $classification) { 
   $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
  } 
  $classificationList .= '</select>'; 
  return $classificationList; 
 }
 // Get vehicles by classificationId 
function getInventoryByClassification($classificationId){ 
  $db = phpmotorsConnect(); 
  $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId'; 
  $stmt = $db->prepare($sql); 
  $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
  $stmt->execute(); 
  $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
  $stmt->closeCursor(); 
  return $inventory; 
 }
 // Get vehicle information by invId
function getInvItemInfo($invId){
  $db = phpmotorsConnect();
  $sql = 'SELECT * FROM inventory WHERE invId = :invId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->execute();
  $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $invInfo;
 }