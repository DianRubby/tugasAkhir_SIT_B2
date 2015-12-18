<html>
   <head>
      	<title>NuSOAP Web Service </title>
      	<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<meta name="description" content="Sticky Table Headers Revisited: Creating functional and flexible sticky table headers" />
		<meta name="keywords" content="Sticky Table Headers Revisited" />
		<meta name="author" content="Codrops" />
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<!--[if IE]>
  		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link rel="stylesheet" type="text/css" href="css/default-button.css" />
		<link rel="stylesheet" type="text/css" href="css/component-button.css" />
		<script src="js/modernizr.custom.js"></script>
   </head>
   <body>
   <div class="container">
			<!-- Top Navigation -->
			
			<header>
				<a href="client.php"><img src="./img/kementerian-perdagangan.jpg" width="250"></a>
				<h1>Kementerian Perdagangan RI<span>Data Harga Bahan Pokok</span></h1>	
				<nav class="codrops-demos">
				<section class="color-3">
						<form method="post" action="client.php?op=getTb">
	        				<button class="btn btn-3 btn-3e icon-arrow-right">Tampilkan Data</button>
	     				</form>
	     			<form method="post" action="client.php?op=search">
	     				Masukkan Kata Pencarian <input class="form-control" type="text" name="key">
	     				<div>
						<button class="btn btn-3 btn-3e icon-arrow-left">Cari</button> 
						</div>
      				</form>
      			</section>
				</nav>
			</header>
			
		<div class="component">
		      <?php
		          require_once('nusoap/lib/nusoap.php');
		          $client = new nusoap_client('http://localhost/ta/server.php?wsdl');
		        if (isset($_GET['op'])) {
		                if ($_GET['op'] == 'getTb') {
		                  $result = $client->call('getTb');
		                  if (is_array($result))
		                   {
		                        echo "<table border='1'>";
			                        echo "<thead>";
			                        echo "<tr>
			                        		<th>ID</th>
			                        		<th>NAMA BAHAN POKOK</th>
			                        		<th>HARGA</th>
			                        		<th>TANGGAL</th>
			                        	  </tr>";
			                       	echo "</thead>";
		                        foreach ($result as $data)
		                        {
		                        	echo "<tbody>";
		                            echo "<tr>
		                            		<td>".$data['id']."</td>
		                            		<td>".$data['name']."</td>
		                            		<td>".$data['price']."</td>
		                            		<td>".$data['date']."</td>
		                            	</tr>";
		                            echo "</tbody>";
		                        }
		                        echo "</table>";
		                   }

		                 } elseif($_GET['op'] == 'search') {
		                  $key = $_POST['key'];
		                  $result = $client->call('search', array('key' => $key));

		                    if (is_array($result))
		                    {
		                        echo "<table border='1'>";
			                        echo "<thead>";
			                        echo "<tr>
			                        		<th>ID</th>
			                        		<th>NAMA BAHAN</th>
			                        		<th>HARGA</th>
			                        		<th>TANGGAL</th>
			                        	</tr>";
			                        echo "</thead>";
		                        foreach($result as $data)
		                        {
		                        	echo "<tbody>";
		                            echo "<tr>
		                            	<td>".$data['id']."</td>
		                            	<td>".$data['name']."</td>
		                            	<td>".$data['price']."</td>
		                            	<td>".$data['date']."</td>
		                            </tr>";
		                            echo "</tbody>";
		                        }
		                        echo "</table>";
		                        echo "<p>Ditemukan ".count($result)." data terkait kata kunci '".$key."'</p>";
		                    }
		                    else echo "<p>Data tidak ditemukan</p>";
		                    }
		                 }
		        ?>
        	</div>
    </div>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>
		<script src="js/jquery.stickyheader.js"></script>
		<script src="js/classie.js"></script>
		<script>
			var buttons7Click = Array.prototype.slice.call( document.querySelectorAll( '#btn-click button' ) ),
				buttons9Click = Array.prototype.slice.call( document.querySelectorAll( 'button.btn-8g' ) ),
				totalButtons7Click = buttons7Click.length,
				totalButtons9Click = buttons9Click.length;

			buttons7Click.forEach( function( el, i ) { el.addEventListener( 'click', activate, false ); } );
			buttons9Click.forEach( function( el, i ) { el.addEventListener( 'click', activate, false ); } );

			function activate() {
				var self = this, activatedClass = 'btn-activated';

				if( classie.has( this, 'btn-7h' ) ) {
					// if it is the first of the two btn-7h then activatedClass = 'btn-error';
					// if it is the second then activatedClass = 'btn-success'
					activatedClass = buttons7Click.indexOf( this ) === totalButtons7Click-2 ? 'btn-error' : 'btn-success';
				}
				else if( classie.has( this, 'btn-8g' ) ) {
					// if it is the first of the two btn-8g then activatedClass = 'btn-success3d';
					// if it is the second then activatedClass = 'btn-error3d'
					activatedClass = buttons9Click.indexOf( this ) === totalButtons9Click-2 ? 'btn-success3d' : 'btn-error3d';
				}

				if( !classie.has( this, activatedClass ) ) {
					classie.add( this, activatedClass );
					setTimeout( function() { classie.remove( self, activatedClass ) }, 1000 );
				}
			}

			document.querySelector( '.btn-7i' ).addEventListener( 'click', function() {
				classie.add( document.querySelector( '#trash-effect' ), 'trash-effect-active' );
			}, false );
		</script>

		<section class="related">
			<div>
				<a><h4> Sistem Informasi Terdistribusi </h4></a>
				<h6>D - III Komputer dan Sistem Informasi</h6>
				<h6>Universitas Gadjah Mada</h6>
			</div>
		</section>
    </body>
</html>