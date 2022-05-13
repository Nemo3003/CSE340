<?php
/*
 * Proxy connection to the phpmotors database
 */
    function phpmotorsConnect(){
    $server='mysql';
    $dbname='phpmotors';
    $username='root';
    $password='rootPASS';
    $dsn="mysql:host=$server;dbname=$dbname";
    $options=array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);

    try {
        #This redirects to a succesful connection page
        $link = new PDO($dsn, $username, $password, $options);
         return $link;
    } catch (PDOException $e) {
        //this will redirect to an error page
        $host=$_SERVER['HTTP_HOST'];
        $extra='/phpmotors/view/500.php';
        header("Location: http://$host/$extra");

        exit;
    }
    }
    phpmotorsConnect()
   
?>
