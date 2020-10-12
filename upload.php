<?php

session_start();

 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);

//echo $_SESSION["login"]."<br>";

include 'dbh.php';

if (!isset($_SESSION["ID"])) {
	$_SESSION["login"] = "missing";
	header("Location: ../index.php?login=missing");
}

$host = $_SERVER['HTTP_HOST'];
$partpath = "/var/www/libreria/books/";

 if (isset($_POST['upload'])){

	$file = $_FILES['file'];
	$fileName = $_FILES['file']['name'];
	$fileTmpName = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileType = $_FILES['file']['type'];


	$fileArr = explode('.', $fileName);
	$fileExt = strtolower(end($fileArr));
	$filePartName = $fileArr[0];

	$allowed = array('epub', 'mobi', 'pdf');

	if (in_array($fileExt, $allowed)){
		if ($fileError === 0) {
			if ($fileSize < 100000000) {

				$sql = "SELECT bookname FROM libri WHERE bookname = :bookname";
				$stmt = $pdo->prepare($sql);
				$stmt->bindParam(':bookname', $fileName);
				$stmt->execute();
				$row = $stmt->fetch(PDO::FETCH_ASSOC);

				if ($row) {
				    echo "Il file esiste già!";
				    echo "<a href='".$partpath."index.php'>Torna alla Home</a>";

				} else {

					$fileDestination = $partpath.$filePartName.".".$fileExt;
					move_uploaded_file($fileTmpName, $fileDestination);

					//Database entry
					$sql = "INSERT INTO libri (bookname) values (:bookname);";
					$stmt = $pdo->prepare($sql);

					$stmt->bindParam(':bookname', $fileName);

					$stmt->execute();
					$row = $stmt->fetch(PDO::FETCH_ASSOC);

					header("Location: '.$partpath.'/index.php?upload=success");
				}
			} else {
				echo "File too big <br>";
			}
		} else {
			echo "Error with file: error code ".$fileError." <br>";
		}
	} else {
		echo "You cannot upload this <br>";
	}

}
