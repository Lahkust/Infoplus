<?php/**************************************************************************************************/
/* Fichier ...................... : index.php */
/* Type ......................... : Document PHP */
/* Titre ........................ : index*/
/* Auteur ....................... : Guillaume Bergs */
/* Date de création ............. : 2017-08-23 */
/* Date de mise en ligne ........ : 2017-08-23 */
/* Date de mise à jour .......... : 2017-10-11 */
/*******************************************************************************************************/
/* index */
/*******************************************************************************************************/
?>

<!doctype HTML>
<html lang="fr">
	<?php	 session_start();

	//array qui contient les id des services sélectionnes
    $array= array();
    $_SESSION["panier"] = $array;

    $_SESSION["promoAdditionnelle"] = 0;
	?>
	
	<head>
		<meta charset="utf-8">
		<title>Index</title>

		<link rel="stylesheet" href="styles/style.css">
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	</head>
	
	<body>

    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '1890245087970829',
                cookie     : true,
                xfbml      : true,
                version    : 'v2.10'
            });
            FB.AppEvents.logPageView();
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.10&appId=1890245087970829";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

		<header>
			<?php include_once 'pages/Entete.php' ?>
		</header>
	
        <?php
           define('DB_SERVER', 'localhost');
           define('DB_USERNAME', 'root');
           define('DB_PASSWORD', '');
           define('DB_DATABASE', 'infoplus');
           $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

           if($_SERVER["REQUEST_METHOD"] == "POST") {
              $dbh = new PDO('mysql:host=localhost;dbname=infoplus', 'root', '');
              $is_admin=0;
              $is_in_db = false;
              foreach($dbh->query('SELECT * from utilisateur') as $row)
              {
                  if(($row["courriel"]==$_POST["mail"])&&($row["mot_de_passe"])==$_POST["password"])
                {
                    $is_in_db = true;
                    $is_admin = $row["administrateur"];
                    $pk_utilisateur = $row["pk_utilisateur"];
                }
              }

              if($is_in_db) {
                 $_SESSION['pk_utilisateur'] = $pk_utilisateur;
                 $_SESSION['administrateur'] = $is_admin;
                  exit(header("location: pages/communes/Catalogue.php"));
              }else {
                 echo "<script type='text/javascript'>alert('Courriel ou mot de passe invalide!')</script>";
              }
           }
        ?>
		<main>
			<form method="post"  action = "" enctype="multipart/form-data">
				<!-- Intitulé -->
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						Veuillez-vous identifier pour avoir la possibilité d'acheter des formations.
					</div>
					<div class="col-md-3"></div>
				</div>
				
				<!-- Courriel -->
				<div class="row">
					<div class="col-md-4"></div>
					<input type = "text" name = "mail" class = "box col-md-4" required/>
					<div class="col-md-4"></div>
				</div>
				
				<!-- Mot de passe -->
				<div class="row">
					<div class="col-md-4"></div>
					<input type = "password" name = "password" class = "box col-md-4" required/>
					<div class="col-md-4"></div>
				</div>
				
				<!-- Mot de passe oublié -->
				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4">
						<a href="pages/communes/Erreur404.php">Mot de passe oublié</a>
					</div>
					<div class="col-md-4"></div>
				</div>
				
				<!-- Connexion -->
				<div class="row">
					<div class="col-md-5"></div>
					<div class="col-md-1">
						<input type="image" src="images/icones/boutonConnexion.png" class="imgButton" alt="Connexion" />
					</div>
					<!-- S'inscrire -->
					<div class="col-md-1">
						<a href="pages/communes/Profil.php">
							<img src="images/icones/boutonInscription.png" class="imgButton" alt="Inscription"/>
						</a>
					</div>
					<div class="col-md-5"></div>
				</div>
				
				<!-- Connexion avec Facebook -->
				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4">
						<!--a href="pages/communes/Erreur404.php">
							<img src="images/icones/facebook.png" class="imgButton" title="Facebook" alt="Facebook"/>
						</a-->

                        <div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false"></div>
					</div>
					<div class="col-md-4"></div>
				</div>
			</form>
		</main>
	
		<footer>
		</footer>
	</body>
</html>
<script src="https://www.gstatic.com/firebasejs/4.5.0/firebase.js"></script>
<script>
    // Initialize Firebase
    var config = {
        apiKey: "AIzaSyApjuXfKrP3TaaWFQfVuORFJev9CEagFvI",
        authDomain: "infoplus-31c9e.firebaseapp.com",
        databaseURL: "https://infoplus-31c9e.firebaseio.com",
        projectId: "infoplus-31c9e",
        storageBucket: "infoplus-31c9e.appspot.com",
        messagingSenderId: "352374497968"
    };
    firebase.initializeApp(config);
</script>