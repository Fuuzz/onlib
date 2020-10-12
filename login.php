<?php
/*
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 */
 error_reporting(0);


include "dbh.php";
session_start();
	$user = "";
	$passwd = "";
$path = '/var/www/libreria/books';

if (isset($_POST['submit'])){
	$user = $_POST["user"];
	$passwd = $_POST["passwd"];
//	echo "Connesso <br>";
//	echo "$user"." $passwd";
} elseif (empty($_POST['submit'])) {
	$_SESSION["login"] = "missing";
	header("Location: index.php?login=missing");
}

$sql = "SELECT * FROM users WHERE username = :username AND password = :password;";
$stmt = $pdo->prepare($sql);

$stmt->bindParam(':username', $user);
$stmt->bindParam(':password', $passwd);

$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if($row['username'] == $user and $row['password'] == $passwd){
  $_SESSION["ID"]=$row['id'];
  echo $_SESSION["ID"]."<br>";
  $_SESSION["login"] = "success";
  header("Location: ".$path."/index.php?login=success");
  session_write_close();
 } else {
  $_SESSION["login"] = "failed";
  header("Location: index.php?login=failed");
 }


 ?>
