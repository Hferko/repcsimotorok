<!DOCTYPE html>
<html lang="hu">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">
	<link rel="stylesheet" href="../assets/css/style.css">
	<link rel="stylesheet" href="../assets/css/fontawesome.min.css">
	<title>Bejelentkezés</title>
</head>

<body style="background-image:url(../assets/img/Turbofan_Engine.jpg);background-size: cover;">

	<main>
		<?php		
		require('sql.php');
		$conn = nyit();
		session_start();	
		if(isset($_SESSION["nev"])){
			echo 'Már bejelentkezve, mint '.$_SESSION["nev"];
		}	

		if (isset($_POST['nev']) && isset($_POST['password'])) {

			$nev    = stripslashes($_REQUEST['nev']);
			$nev    = mysqli_real_escape_string($conn, $nev);
			$jelszo = stripslashes($_REQUEST['password']);
			$jelszo = mysqli_real_escape_string($conn, $jelszo);

			// Ellenőrzi, hogy a felhasználó létezik-e az adatbázisban vagy sem
			$sql = "SELECT * FROM `felhasznalo` WHERE neve='$nev';";
			$eredmeny = mysqli_query($conn, $sql) or die(mysqli_error($conn));

			if (!$eredmeny) {
				echo "Ez a hiba: " . mysqli_error($conn) . ' ' . mysqli_errno($conn);
				echo "<div class='form'><h3>A felhasználónév/jelszó helytelen.</h3><br/>Kattintson ide a  <a href='login.php'>Belépéshez</a></div>";
			} else {
				if (mysqli_num_rows($eredmeny) === 1) {
					$sor = mysqli_fetch_assoc($eredmeny);

					if (password_verify($jelszo, $sor['password'])) {
						$_SESSION['vevo'] = $sor['nev'];
					} else {
						print("Nem megfelelő jelszó");
					}
					$_SESSION['nev'] = $nev;
					if (isset($_SESSION["vevo"])&& $_SESSION["vevo"] == "ok" ){
						echo $_SESSION["vevo"];
						header("Location: vedve.php");
					}
					else{
					echo 'Valami gáz van';
					header("Location: ../shop.php");
					}
				} else {
					print('<h4>Nem találtam ilyen nevű felhasználót</h4>');
					echo '<button><a href="regisztral.php">KÉRJÜK ITT REGISZTRÁLJON </a></button>';
				}
			}
		} else {
		?>
			<div class="card">
				<div class="form">
					<h2>Bejelentkezés</h2>
					<form action="" method="POST" name="login">
						<div class="input-container">
							<i class="fa fa-user icon"></i>
							<input class="input-field" type="text" name="nev" placeholder="Felhasználónév" required />
						</div>
						<div class="input-container">
							<i class="fa fa-key icon"></i>
							<input class="input-field" type="password" name="password" placeholder="Jelszó" required />
						</div>
						<input name="submit" type="submit" value="Belépés" />
					</form>
					<p>Ön még nem regisztrált felhasználó? <br></p>
					<h3><a href='regisztral.php'>&nbsp; KÉRJÜK ITT REGISZTRÁLJON </a></h3>

				</div>
			<?php } ?>
			</div>
	</main>
</body>

</html>