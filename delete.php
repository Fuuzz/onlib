<a href="./lib-folder">Torna alla Home</a>

<h3> Risultato della cancellazione </h3>

<?php

 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);

 error_reporting(0);

include 'dbh.php';
$bookpath = "/var/www/libreria/lib-folder/";

if (isset($_POST['delete'])) {

$deleteKey = $_POST['delete'];
echo $deleteKey;

try {
$sql = "SELECT bookname FROM libri WHERE bookname LIKE :deleteTerm;";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':deleteTerm', $deleteKey);
$stmt->execute();

echo "$sql";
echo $_POST['delete'];

$stmt->setFetchMode(PDO::FETCH_ASSOC);

if($stmt->rowCount() == 0){
    echo "Nessun risultato <br>";
} else {
	try {
	$sql = "DELETE FROM libri WHERE bookname LIKE :deleteTerm;";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':deleteTerm', $_POST['delete']);
	$count = $stmt->execute();

	/* Return number of rows that were deleted */
	print("Deleted $count rows.\n");

		if ($count == 1) {
			$book = $_POST['delete'];
			$path = $bookpath.$book;
			if (!unlink($path)) {
			echo "Error";
				exit();
				}
			}
		} catch(PDOException $e) {
    		echo $e->getMessage();
    		}
    	}
} catch(PDOException $e) {
    echo $e->getMessage();
    }
 } else {
  $_POST['delete'] = "";
  header("Location: /index.php");
 }
