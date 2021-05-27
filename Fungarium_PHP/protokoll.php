<!DOCTYPE html>
<html lang="de">
	
<!-- Site: 'Protokoll' -->

        <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title id="title" ></title>
        
        <!-- homescreen icon -->
        <link rel="icon" type="image/ico" id="IconStart">
        
        <!-- css stylesheets -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/tooplate.css">
        <link rel="stylesheet" href="css/time.css">
        <!-- css datatables -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
    </head>

       <body id="reportsPage">
        <div class="" id="home">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- navigationbar with dropdown menu -->
                        <nav class="navbar navbar-expand-xl navbar-light bg-light">
                            <a class="navbar-brand" href="#">
                                <!-- navigationbar icon -->
                                <img id="homeIcon" >
                                <h1 class="tm-site-title mb-0" id="header"></h1>
                            </a>
                            <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav mx-auto">
                                    
                                    <!-- pages in navigationbar -->
                                    <li class="nav-item">
                                        <a class="nav-link" href="index.php">Menü</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="temperature.php">Temperatur</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="feuchtigkeit.php">Feuchtigkeit</a>
                                    </li>                               
                                    <li class="nav-item">
                                        <a class="nav-link" href="protokoll.php">Protokoll</a>
                                    </li>                                                    
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            
		<!-- 1. white block, includes Datatable 'Protokoll'-->
		<div class="row tm-content-row tm-mt-big">
			<div class="tm-col tm-col-big">
				<div class="bg-white tm-block h-100">
				<h2 class="tm-block-title">Protokoll</h2>
				<!-- Datatable 'Protokoll' -->
				<table id="tableProtokoll">  					  
					<thead>
					<tr>
						<th>Zeit</th>
						<th>Eintrag</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<th>Zeit</th>
						<th>Eintrag</th>
					</tr>
					</tbody>
				</table>
				</div>
			</div>

			<div class="tm-col tm-col-big" id="lichtChart" style="display:none;">
				<div class="bg-white tm-block h-100">
				<h2 class="tm-block-title">Licht Zustand</h2>
					<!-- LineChart 'Licht' -->
					<canvas id="lineChartLicht" height="300" ></canvas>
				</div>
			</div>
			
			<div class="tm-col tm-col-big" id="heizungChart" style="display:none;">
				<div class="bg-white tm-block h-100">
				<h2 class="tm-block-title">Heizung Zustand</h2>
					<!-- LineChart 'Heizung' -->
					<canvas id="lineChartHeizung" height="300" ></canvas>
				</div>
			</div>
			
			<div class="tm-col tm-col-big" id="kuehlungChart" style="display:none;">
				<div class="bg-white tm-block h-100">
				<h2 class="tm-block-title">Kühlung Zustand</h2>
					<!-- LineChart 'Kühlung' -->
					<canvas id="lineChartKuehlung" height="300" ></canvas>
				</div>
			</div>
			
			<div class="tm-col tm-col-big" id="foggerChart" style="display:none;">
				<div class="bg-white tm-block h-100">
				<h2 class="tm-block-title">Fogger Zustand</h2>
					<!-- LineChart 'Fogger' -->
					<canvas id="lineChartFogger" height="300" ></canvas>
				</div>
			</div>
			
			<div class="tm-col tm-col-big" id="lueftungChart" style="display:none;">
				<div class="bg-white tm-block h-100">
				<h2 class="tm-block-title">Lüftung Zustand</h2>
					<!-- LineChart 'Lüftung' -->
					<canvas id="lineChartLueftung" height="300" ></canvas>
				</div>
			</div>
			
		  <div class="tm-col tm-col-big" style="display:none;">
			<div class="bg-white tm-block h-100">
			    <h2 class="tm-block-title">Steuerungsauswahl</h2>
							    
				<label for="appt1" method>Terrarium/Fungarium</label>
				<!-- Rounded switch -->
				<label class="switch">
				  <input type="checkbox" id="TerraFunga" name="TerraFunga" <?php echo terraFunga("terraFunga");?>>
				  <span class="slider round"></span>
				</label>
			    </div>
			</div>	
			 <!-- 5. white block, includes 'Vorhandene Komponenten'-->                    
                    <div class="tm-col tm-col-big" id="komponenten" style="display:none;">
                        <div class="bg-white tm-block h-100">
                            <h2 class="tm-block-title">Vorhandene Komponenten</h2>
                                <label for="appt1" method>Licht:</label>
                                <!-- Rounded switch -->
                                <label class="switch">
                                  <input type="checkbox" id="licht" name="licht" <?php echo komponenten("licht");?>>
                                  <span class="slider round"></span>
                                </label>
                                
                                <label for="appt1" method>Heizung:</label>
                                <!-- Rounded switch -->
                                <label class="switch">
                                  <input type="checkbox" id="heizung" name="heizung" <?php echo komponenten("heizung");?>>
                                  <span class="slider round"></span>
                                </label>     

                                <label for="appt1" method>Kühlung:</label>
                                <!-- Rounded switch -->
                                <label class="switch">
                                  <input type="checkbox" id="kuehlung" name="kuehlung" <?php echo komponenten("kuehlung");?>>
                                  <span class="slider round"></span>
                                </label>   

                                <label for="appt1" method>Fogger:</label>
                                <!-- Rounded switch -->
                                <label class="switch">
                                  <input type="checkbox" id="fogger" name="fogger" <?php echo komponenten("fogger");?>>
                                  <span class="slider round"></span>
                                </label>     
                                
                                <label for="appt1" method>Lüftung:</label>
                                <!-- Rounded switch -->
                                <label class="switch">
                                  <input type="checkbox" id="lueftung" name="lueftung" <?php echo komponenten("lueftung");?>>
                                  <span class="slider round"></span>
                                </label>  
                            </div>                                
                        </div>
                    </div>
                </div>
		
    <?php
	function terraFunga(String $Bezeichnung)
	      {         
		  // Database Login
		  include "databaseLogin.php";
		  
		  // create table "einstellungen" when the data is submitted for the first time
		  $sql = "CREATE TABLE IF NOT EXISTS voreinstellungen (
		  ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		  Bezeichnung VARCHAR(30) NOT NULL,
		  Wert VARCHAR(4) NOT NULL,
		  Zugriff TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		  )";
		  $db->exec($sql);
		  
		  // execute query
		  $result = $db->query("SELECT * FROM voreinstellungen WHERE Bezeichnung='$Bezeichnung'");

		  foreach ($result as $row)
		  
		  $einstellungen = $row["Wert"];
		  
		  if ($einstellungen) {
			  $returnWert = 'checked';
		      }
		      else {
			  $returnWert = 'unchecked';
		      }
		      return $returnWert;
	      }
	      
	function komponenten(String $Bezeichnung)
                {         
                    // Database Login
                    include "databaseLogin.php";
                    
                    // create table "einstellungen" when the data is submitted for the first time
		    $sql = "CREATE TABLE IF NOT EXISTS voreinstellungen (
		    ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		    Bezeichnung VARCHAR(30) NOT NULL,
		    Wert VARCHAR(4) NOT NULL,
		    Zugriff TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		    )";
                    $db->exec($sql);
                    
                    // execute query
                    $result = $db->query("SELECT * FROM voreinstellungen WHERE Bezeichnung='$Bezeichnung'");

                    foreach ($result as $row)
                    
                    $einstellungen = $row["Wert"];
                    
                    if ($einstellungen) {
                            $returnWert = 'checked';
                        }
                        else {
                            $returnWert = 'unchecked';
                        }
                        return $returnWert;
                }
      ?>  
	<!-- datatable and jquery module -->    
	<script src="js/cdn_jsdelivr.js"></script>
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/cdn_datatables.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/tooplate-scripts.js"></script>
        <script src="js/moment.min.js"></script>
	
        <!-- chartjs adapter and plugins -->            
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment@0.1.1"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns@1.0.0/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/hammerjs@2.0.8"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@0.7.7"></script>
	
	<!-- Changes title and Icon of the Navigationbar, depends on 'Terrarium/Fungarium' switch on 'Menü' -->   
	<script src="js/actionTerraFungaTitle.js"></script>

	<!-- Draws the Charts using the module chart.js -->   	
	<script src="js/ProtokollChart/lichtChart.js"></script>		
	<script src="js/ProtokollChart/heizungChart.js"></script>		
	<script src="js/ProtokollChart/kuehlungChart.js"></script>		
	<script src="js/ProtokollChart/foggerChart.js"></script>			
	<script src="js/ProtokollChart/lueftungChart.js"></script>		
	
	<!-- Shows or Hides the Chart when the component is selected in the settings 'Vorhandene Komponenten' on 'Menü' -->   
	<script src="js/ProtokollChart/ShowHide/actionLichtChartData.js"></script>	
	<script src="js/ProtokollChart/ShowHide/actionHeizungChartData.js"></script>	
	<script src="js/ProtokollChart/ShowHide/actionKuehlungChartData.js"></script>	
	<script src="js/ProtokollChart/ShowHide/actionFoggerChartData.js"></script>	
	<script src="js/ProtokollChart/ShowHide/actionLueftungChartData.js"></script>	
	
        <!-- js to draw DataTable 'Protokoll' -->
        <script>
			$('#tableProtokoll').DataTable( {
			"searching": true,
			"pageLength": 20,
			"scrollY": "300px",
			"scrollCollapse": true,
			"lengthChange": false,
			"order": [[ 0, "desc"]],
			"language": {
				"url": "js/dataTables.german.json"
			},
			ajax: {
				url: "data_protokoll.php",
				dataSrc: ''
			},
			columns: [
				{ data: "Zugriff" },
				{ data: "Eintrag" }
			]
			} );
	</script>
    </body>
</html>
