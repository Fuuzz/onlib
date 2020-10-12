<?php

/*if (!isset($_SESSION["ID"])) {
	$_SESSION["login"] = "missing";
	header("Location: ../index.php?login=missing");
}
*/
include 'upload.php';

$coverPath = '/var/www/libreria/books/covers/';

$sql = "SELECT count(*) FROM libri;";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$bookNum= $stmt->fetchColumn();

echo "$bookNum <br>";
$bpp = 3;
$totalPage = ceil($bookNum/$bpp);
echo "Pagine = $totalPage";
echo "<br><br>";


$sql = "SELECT * FROM libri ORDER BY bookname;";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row > 0) {
  // output data of each row
    if (isset($_GET['page'])) {
      $page = $_GET['page'];
    } else {
      $page = 1;
    }

    $countStart = ($page-1)*$bpp;
    //Listing da database
    $sql = "SELECT * FROM libri ORDER BY bookname LIMIT $countStart,3";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $countStart);
    $stmt->bindParam(2, $bpp);
    $stmt->execute();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    /*$bookArray[] = $row["bookname"];
    print_r($bookArray);*/

    $book = $row["bookname"];
    $path = $host."/libreria/books/".$row["bookname"];
	  $truepath = basename($path);
    $coverName = $truepath."-cover.png";
    $fileArr = explode('.', $book);
    $fileExt = strtolower(end($fileArr));


    //echo "<a href='$truepath'>".$row["bookname"]."</a><br>";

    if ($fileExt == "pdf") {
      $im = new imagick($book.'[0]');
      $im->setImageFormat('png');
      $im->resizeImage(150,200,1,0);
      $im->writeImage($coverPath.$coverName);
    echo "<a href='$truepath'>"."<img src='covers/".$coverName."'>".$row["bookname"]."</a><br>";
    } else {
      //  echo "<a href='$truepath'>".$row["bookname"]."</a><br>";
    }

  }
} else {
  echo "0 results";
}

echo "<br>";
echo "Pagina";
echo "<br>";

/*if ($page > 1) {
  echo "<a href='index.php?page=".($page-1)."''>Previous</a>";
}*/

for ($i=1; $i < $totalPage; $i++) {
  echo "<a href='index.php?page=".$i."''>$i</a>";
}
//    $bookArray[] = $row["bookname"];   alt='".$truepath."
// print_r($bookArray);

?>
