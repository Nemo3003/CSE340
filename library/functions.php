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

 function NavBar(){
  global $navList;
  global $classificationList;
   $classifications = getClassifications();


    $navList = "<ul id='navigation'>";
    $navList .= "<li><a href='/phpmotors/accounts/index.php' title='View the PHP Motors home page'>Home</a></li>";
    $classificationList = "<select name='classificationId' id='carClassification'>";
    foreach ($classifications as $classification) {$name = $classification['classificationName']; $id = $classification['classificationId']; $navList .="<li><a href='/phpmotors/index.php?action=".urlencode($name)."' title='View our $name product line'>$name</a></li>"; $classificationList .= "<option value='$id'>$name</option>";
    }
    $navList .='</ul>';
    $classificationList .="</select><br>";
   
 }
 