<?php
$host = "localhost";
$db = "carpooling";
if (isset($_POST["pwd"]) && isset($_POST["usr"])) {
    $usr = $_POST["usr"];
    $pwd = $_POST["pwd"];
    if($usr != "root" | $pwd != ""){
        
        echo "Access Denied";
        $connection = null;

        } else {
        try {
            $connection = new PDO("mysql:host=$host;dbname=$db", "root", "");
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo "". $e->getMessage() ."";
        }
    }
} else {
    try {
        $connection = new PDO("mysql:host=$host;dbname=$db", "root", "");
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        echo "". $e->getMessage() ."";
    }
}
?>
