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
			
			public function insertImg() {
				$s = "<img src='../../images/promotions/".$this->rabais.".png' class=";
				
			  if($this->isPast())
			  {
				print_r($s."'promo_past' alt='[promo passée]' />");
			  }
			  else if($this->isPresent())
			  {
				print_r($s."'promo_current' alt='[promo actuelle]/>");
			  }
			  else
			  {
				print_r($s."'promo_future' alt='[promo future]/>");
			  }
			}
          }
        ?>