Accesso alla libreria <br><br>
Login



<form name="login" action="login.php" method="POST">
	<input type="text" name="user">
	<input type="password" name="passwd">
<button type="submit" name="submit">Accedi</button>
</form>

<br>

<?php 

//session_start();
if (isset($_SESSION["login"])) {
	$logstat = $_SESSION["login"];
} else {
	$logstat = "";
}


echo "Login status ".$logstat."<br>";

switch ($logstat) {

	case "":
		echo "Effettua il login ".$logstat;
		unset($logstat);
		break;

	case "unset":
		echo "Effettua il login ".$logstat;
		unset($logstat);
		break;

	case "missing":
		echo "Login non effettuato: ".$logstat;
		unset($logstat);
		break;
	
	case "failed":
		echo "Login fallito, riprova ".$logstat;
		unset($logstat);
		break;

	default:
		echo "";
		break;
}

/*
if ($login = "failed") {
	unset($login);
	echo "Login fallito, riprova";
} elseif ($login = "missing") {
	echo "Login non effettuato";
}
*/


?>