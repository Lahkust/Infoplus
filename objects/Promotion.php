 <?php
        
        class Promotion {
			
            public $date_debut;
			public $date_fin;
			public $code;
			public $titre;
			public $rabais;
			public $service_titre;
            
            public function __construct($row) {
              $this->date_debut  	= $row["date_debut"];
              $this->date_fin 		= $row["date_fin"];
              $this->code 		 	= $row["code"];
              $this->titre 		 	= $row["promotion_titre"];
              $this->rabais 	 	= $row["rabais"];
            }
			
            public function isPast() {
              return (time() - strtotime($this->date_fin)) > 0;
            }
			
			public function isFuture() {
              return (time() - strtotime($this->date_debut)) < 0;
            }
			
			public function isCurrent() {
              return !($this->isPast() || $this->isFuture());
            }
			
			function getPercent () {
				return $this->rabais * 100;
			}
			
			function getTitre () {
				return $this->titre;
			}
			
          }
        ?>