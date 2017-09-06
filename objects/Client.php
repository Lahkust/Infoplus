 <?php
        
        class Client {
			
            public $nom;
			public $prenom;
			public $noCivic;
			public $rue;
			public $ville;
			public $codePostal;
			public $noTelephone;
            public $courriel;
			public $motDePasse;
			public $infolettre;
			
            public function __construct($row) {
              $this->nom  			= $row["nom"];
              $this->prenom 		= $row["prenom"];
              $this->noCivic 		= $row["noCivic"];
              $this->ville 		 	= $row["ville"];
              $this->codePostal 	= $row["codePostal"];
			  $this->noTelephone 	= $row["noTelephone"];
			  $this->courriel 		= $row["courriel"];
			  $this->motDePasse 	= $row["motDePasse"];
			  $this->infolettre 	= $row["infolettre"];
            }
			
            public function getUserInformation($email) {
              
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "infoplus";

				// Create connection
				$conn = mysqli_connect($servername, $username, $password, $dbname);
				// Check connection
				if (!$conn) {
					die("Connection failed: " . mysqli_connect_error());
				}
			  
				$sql = "SELECT pk_utilisateur FROM utilisateur where courriel="$email" ";
				$result = mysqli_query($conn, $sql);

				if (mysqli_num_rows($result) > 0) {
					// output data of each row
					while($row = mysqli_fetch_assoc($result)) {
						print_r("<option value='". $row["ville"] . "'>" . $row["ville"]. "</option>");
					}
				} else {
					echo "0 results";
				}

				mysqli_close($conn);
            }
			
          }
        ?>