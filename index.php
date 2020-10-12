Libreria <br><br>

<a href="../">Torna alla Home</a>

<br><br>

Carica un file:
 <form action="../upload.php" method="POST" enctype="multipart/form-data">
	<input type="file" name="file">
	<button type="submit" name="upload">Upload</button>
	</form>

Cerca un file:
<form action="../search.php" method="POST">
	<input type="text" name="search" placeholder="Cerca">
	<button type="submit" name="submit-search">Cerca</button>
</form>

Cancella un file:
<form action="../delete.php" method="POST">
        <input type="text" name="delete" placeholder="Nome libro">
        <button type="submit" name="submit-earch">Cancella</button>
</form>


<?php

include '../dbh.php';
include '../var.php';


echo $_SESSION["ID"];
echo $user;

//Upload

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_GET['upload'])) {
	$upload = "";
} else {
	$upload = $_GET['upload'];
}


if ($upload == "success") {
	echo "<h3>Upload completato <br></h3>";
} else {
	echo "";
}

echo "Upload status: ".$upload;
//include '../upload.php';

if (!$login = "success") {
	$_SESSION["login"] = "failed";
	header("Location: ../index.php?login=failed");
} else {

$dir = getcwd();
$searchkey = "";
//Listing
echo "<h4> Lista dei libri: <br></h4>";
include '../list.php';
}


?>
