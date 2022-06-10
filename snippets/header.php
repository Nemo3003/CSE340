<a href="/phpmotors"><img src="/phpmotors/images/site/logo.png" alt="my logo"></a>
<div id='login'>
<?php 
  if($_SESSION['loggedin']) {
    echo "<a href='/phpmotors/accounts/index.php?action=admin'><span>Welcome, " . 
    $_SESSION['clientData']['clientFirstname'] . "</span></a>  |";
    echo "<a href='/phpmotors/accounts/index.php?action=logout'>Logout</a>";
  } 
  else {
    echo "<a href='/phpmotors/accounts/index.php?action=Login' >My Account</a>&nbsp;";
  }
?></div>