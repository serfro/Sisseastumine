<?php
require ("../../config.php");
$signupFirstName = "";
$signupFamilyName = "";

$mathEksam = "";
$siseEksam = "";
$ekeelEksam = "";


$signupFirstNameError = "";
$signupFamilyNameError = "";
$mathEksamError = "";
$siseEksamError = "";
$ekeelEksamError = "";


//kontrollime, kas kirjutati eesnimi
	if (isset ($_POST["signupFirstName"])){
		if (empty($_POST["signupFirstName"])){
			$signupFirstNameError ="Väli on kohustuslik!";
		} else {
			$signupFirstName = $_POST["signupFirstName"];
		}
	}
	
	//kontrollime, kas kirjutati perekonnanimi
	if (isset ($_POST["signupFamilyName"])){
		if (empty($_POST["signupFamilyName"])){
			$signupFamilyNameError ="Väli on kohustuslik!";
		} else {
			$signupFamilyName = $_POST["signupFamilyName"];
		}
	}
	if (isset ($_POST["mathEksam"])){
		if (empty($_POST["mathEksam"])){
			$mathEksamError ="Väli on kohustuslik!";
		} else {
			$mathEksam = $_POST["mathEksam"];
		}
	}
	if (isset ($_POST["ekeelEksam"])){
		if (empty($_POST["ekeelEksam"])){
			$ekeelEksamError ="Väli on kohustuslik!";
		} else {
			$ekeelEksam = $_POST["ekeelEksam"];
		}
	}
	if (isset ($_POST["siseEksam"])){
		if (empty($_POST["siseEksam"])){
			$siseEksamError ="Väli on kohustuslik!";
		} else {
			$siseEksam = $_POST["siseEksam"];
		}
	}
	if (empty($signupFirstNameError) and empty($signupFamilyNameError) and empty($mathEksamError) and empty($ekeelEksamError) and empty($siseEksamError)){
		echo "Hakkan salvestama!";
		//krüpteerin parooli
		//$signupPassword = hash("sha512", $_POST["signupPassword"]);
		//echo "\n Parooli " .$_POST["signupPassword"] ." räsi on: " .$signupPassword;
		//loome andmebaasiühenduse
		$database = "if17_frolov";
		$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
		//valmistame ette käsu andmebaasiserverile
		$stmt = $mysqli->prepare("INSERT INTO vastuvotueksam (nimi, perekonnanimi, matemaatika, emakeel, siseeksam) VALUES (?, ?, ?, ?, ?)");
		echo $mysqli->error;
		//s - string
		//i - integer
		//d - decimal
		$stmt->bind_param("ssiii", $signupFirstName, $signupFamilyName, $mathEksam, $ekeelEksam, $siseEksam);
		//$stmt->execute();
		if ($stmt->execute()){
			echo "\n Õnnestus!";
		} else {
			echo "\n Tekkis viga : " .$stmt->error;
		}
		$stmt->close();
		$mysqli->close();
	}
?>

<!DOCTYPE html>
<html>
<title> Sisseastumine</title>



<head>
	<meta charset="utf-8">


</head>



<body>

<form method="POST">
		<label>Eesnimi </label>
		<br><br>
		<input name="signupFirstName" type="text" value="<?php echo $signupFirstName; ?>">
		<span><?php echo $signupFirstNameError; ?></span>
		<br>
		<br>
		<label>Perekonnanimi </label>
		<br>
		<br>
		<input name="signupFamilyName" type="text" value="<?php echo $signupFamilyName; ?>">
		<span><?php echo $signupFamilyNameError; ?></span>
		<br>
		<br>
		<label>Sisesta oma matemaatikaeksami tulemus</label>
		<br>
		<br>
		<input name="mathEksam" type="text" value="<?php echo $mathEksam; ?>">
		<span><?php echo $mathEksamError; ?></span>
		<br>
		<br>
		<label>Sisesta oma emakeeleeksami tulemus</label>
		<br>
		<br>
		<input name="ekeelEksam" type="text" value="<?php echo $ekeelEksam; ?>">
		<span><?php echo $ekeelEksamError; ?></span>
		<br>
		<br>
		
		<label><h2>Sisesta oma TLU's sooritatud eksami tulemus</h2></label>
		<br><br>
		<input name="siseEksam" type="text" value="<?php echo $siseEksam; ?>">
		<span><?php echo $siseEksamError; ?></span>
		<br>
		<br>
		<br>
		
		<input type="submit" value="Salvesta eksamitulemused">
	</form>



</body>
</html>