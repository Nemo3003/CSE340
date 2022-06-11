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
 
 