<?php 

$admin = "fuzz";

$sql = "SELECT id FROM users WHERE username = :username";
$stmt = $pdo->prepare($sql);

$stmt->bindParam(':username', $admin);

$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
print_r($row);



/*
if ($_SESSION["ID"]) {
	# code...
}
*/
?>