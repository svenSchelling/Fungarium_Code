<!DOCTYPE html>
<html lang="de">
    
<!-- Site: 'Temperatur' -->

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
                
                <!-- 1. white block, includes LineChart 'Temperatur'-->
                <div class="row tm-content-row tm-mt-big">
                    <div class="tm-col tm-col-big">
                        <div class="bg-white tm-block h-100">
                        <h2 class="tm-block-title">Temperatur Diagramm</h2>
                            <!-- LineChart 'Temperatur' -->
                            <canvas id="lineChartTemp" height="300" ></canvas>
                        </div>
                    </div>
                    
                <!-- 2. white block, includes DataTable 'Temperatur'-->
                <div class="tm-col tm-col-big">
                    <div class="bg-white tm-block h-100">
                    <h2 class="tm-block-title">Temperatur Tabelle</h2>
                    <!-- DataTable 'Temperatur' -->
                    <table id="dataTableTemp">
                        <thead>
                        <tr>
                            <th>Zeit</th>
                            <th>Temperatur °C</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>Zeit</th>
                            <th>Temperatur °C</th>
                        </tr>
                        </tbody>
                    </table>
                    </div>
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
      ?>  
            
        <!-- java scripts -->  
        <script src="js/cdn_jsdelivr.js"></script>
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/cdn_datatables.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/tooplate-scripts.js"></script>
	
        <!-- chartjs adapter and plugins -->  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment@0.1.1"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns@1.0.0/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/hammerjs@2.0.8"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@0.7.7"></script>
	
	<!-- Changes title and Icon of the Navigationbar, depends on 'Terrarium/Fungarium' switch on 'Menü' -->   
	<script src="js/actionTerraFungaTitle.js"></script>
        
        <!-- js to draw LineChart 'Temperatur' -->
        <script>
           // configuration of the LineChart
           var config = {
		   type: "line",
		   data: {
			  labels: [],
			  datasets: [{
				 label: "Temperatur",
				 backgroundColor: '#49e2ff',
				 borderColor: '#46d5f1',
				 hoverBackgroundColor: '#CCCCCC',
				 hoverBorderColor: '#666666',
				 data: [],
				 fill: false,
				 pointRadius: 1.5
			  },
			  {
				 label: "Mindesttemperatur",
				 backgroundColor: '#FF0000',
				 borderColor: '#FF0000',
				 hoverBackgroundColor: '#FF0000',
				 hoverBorderColor: '#FF0000',
				 data: [],
				 fill: false,
				 pointRadius: 0
			  },
			  {
				 label: "Höchsttemperatur",
				 backgroundColor: '#FF0000',
				 borderColor: '#FF0000',
				 hoverBackgroundColor: '#FF0000',
				 hoverBorderColor: '#FF0000',
				 data: [],
				 fill: false,
				 pointRadius: 0
			  },
			  {
				 label: "Mindesttemperatur nachts",
				 backgroundColor: '#FFA500',
				 borderColor: '#FFA500',
				 hoverBackgroundColor: '#FFA500',
				 hoverBorderColor: '#FFA500',
				 data: [],
				 fill: false,
				 pointRadius: 0
			  },
			  {
				 label: "Höchsttemperatur nachts",
				 backgroundColor: '#FFA500',
				 borderColor: '#FFA500',
				 hoverBackgroundColor: '#FFA500',
				 hoverBorderColor: '#FFA500',
				 data: [],
				 fill: false,
				pointRadius: 0
			  }
              ]
		   },
		   options: {
              plugins: {
                  zoom: {
                    pan: {
                        enabled: true,
                        mode: 'x',
                        rangeMin: {
                            x: [],
                            y: null
                        },
                        rangeMax: {
                            x: [],
                            y: null
                        },
                        speed: 20,
                        threshold: 10,
                        onPan: function({chart}) { console.log('panning!!!'); },
                        onPanComplete: function({chart}) { console.log(`I was panned!!!`); }
                    },

                    zoom: {
                        enabled: true,
                        drag: true,
                        mode: 'x',
                        rangeMin: {
                            x: [],
                            y: null
                        },
                        rangeMax: {
                            x: [],
                            y: null
                        },
                        speed: 0.1,
                        threshold: 2,
                        sensitivity: 3,
                        onZoom: function({chart}) { console.log('zooming!!!'); },
                        onZoomComplete: function({chart}) { console.log(`I was zoomed!!!`); }
                    }
                }
              },
			  responsive: true,
			  legend: {
				 display: false
			  },
			  tooltips: {
				 mode: "index",
				 intersect: false,
			  },
			  hover: {
				 mode: "nearest",
				 intersect: true
			  },
			  scales: {
				 xAxes: [{
					type: "time",
					time: { displayFormats: { minute: "HH:mm" } },
					display: true,
					scaleLabel: {
					   display: true,
					   labelString: "Uhrzeit"
					}
				 }],
				 yAxes: [{
					display: true,
					scaleLabel: {
					   display: true,
					   labelString: "Temperatur in °C"
					}
				 }]
			  }
		   }
		} ;
		// get JSON-Data
		fetch( "dht_data.php" )
			 .then( response => response.json() )
			 .then( json => {
				  config.data.labels = json.map( row => moment(row.ZugriffDefault).toDate() ) ;
				  var rangeXMin = json.map( row => moment(row.ZugriffDefault).toDate() )[0];
				  var rangeXMax = json.map( row => moment(row.ZugriffDefault).toDate() )[(json.map( row => moment(row.ZugriffDefault).toDate())).length-1];
				  config.options.plugins.zoom.zoom.rangeMin.x = rangeXMin;
				  config.options.plugins.zoom.pan.rangeMin.x = rangeXMin;
				  config.options.plugins.zoom.zoom.rangeMax.x = rangeXMax;
				  config.options.plugins.zoom.pan.rangeMax.x = rangeXMax;
				  config.data.datasets[0].data = json.map( row => row.Temperatur ) ;
				  config.data.datasets[1].data = json.map( row => row.Mindesttemperatur ) ;
				  config.data.datasets[2].data = json.map( row => row.Hoechsttemperatur ) ;	
				  config.data.datasets[3].data = json.map( row => row.MindesttemperaturNacht ) ;
				  config.data.datasets[4].data = json.map( row => row.HoechsttemperaturNacht ) ;
				  console.table( config.data.datasets[0].data ) ;
				  // create Chart
				  var ctx   = document.getElementById( "lineChartTemp" ).getContext( "2d" ) ;
				  var chart = new Chart( ctx, config ) ;
			 } )
			 .catch( error => alert("Error: "+error) ) ;
		</script>
        
        <!-- js to draw DataTable 'Temperatur' -->
        <script>
            $('#dataTableTemp').DataTable( {
            "searching": false,
            "bLengthChange": false,
            "pageLength": 20,
            "scrollY": "300px",
            "scrollCollapse": true,
	    "order": [[ 0, "desc"]],
            "language": {
                "url": "js/dataTables.german.json"
            },
            ajax: {
                url: 'dht_data.php',
                dataSrc: ''
            },
            columns: [
                { data: "Zugriff" },
                { data: "Temperatur" }
            ]
            } );
        </script>
    </body>
</html>
