
<a href="./lib-folder">Torna alla Home</a>

<h3> Risultati della ricerca </h3>

<?php

 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);

 error_reporting(0);

include 'dbh.php';
include 'upload.php';
$searchArray = array();

if (isset($_POST['search'])) {

$term = $_POST['search'];

try {
$sql = "SELECT * FROM libri WHERE bookname LIKE :searchTerm ORDER BY bookname;";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':searchTerm', '%' . $_POST['search'] . '%');
$stmt->execute();

$stmt->setFetchMode(PDO::FETCH_ASSOC);

if($stmt->rowCount() == 0){
    echo "Nessun risultato: <br>";
} else {

	//header("Location: lib-folder/index.php?searchkey=$term");
	while($row = $stmt->fetch()) {
   			   	$path = "books/".$row["bookname"];
				//$truepath = basename($path);
				//echo $truepath. " ";
    			echo "<a href='$path'>".$row["bookname"]."</a><br>";

    			$searchArray[] = $row["bookname"];
    		}
	}
}
catch(PDOException $e) {
            echo $e->getMessage();
        }
 } else {
  $_POST['search'] = "";
 }

?>
