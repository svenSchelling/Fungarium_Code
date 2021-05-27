// js to draw LineChart 'Kühlung'
// configuration of the LineChart
   var configKuehlung = {
   type: "line",
   data: {
	  labels: [],
	  datasets: [{
		 label: "Kühlung",
		 lineTension: 0,
		 backgroundColor: "blue",
		 borderColor: "blue",
		 data: [],
		 fill: false,
	  }]
   },
   options: {
		plugins: {
		  zoom: {
			pan: {
				enabled: true,
				mode: 'x',
				rangeMin: {
					x: null,
					y: null
				},
				rangeMax: {
					x: null,
					y: null
				},
				speed: 20,
				threshold: 10,
				onPan: function({chart}) { console.log(`I'm panning!!!`); },
				onPanComplete: function({chart}) { console.log(`I was panned!!!`); }
			},

			zoom: {
				enabled: true,
				drag: true,
				mode: 'x',
				rangeMin: {
					x: null,
					y: null
				},
				rangeMax: {
					x: null,
					y: null
				},
				speed: 0.1,
				threshold: 2,
				sensitivity: 3,
				onZoom: function({chart}) { console.log(`I'm zooming!!!`); },
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
			ticks: {
				max: 1,
				min: 0,
				stepSize: 1
			},
			scaleLabel: {
			   display: true,
			   labelString: "Aus/An"
			}
		 }]
	  }
   }
} ;
// get JSON-Data
fetch( "kuehlung_data.php" )
	 .then( response => response.json() )
	 .then( json => {
		  configKuehlung.data.labels = json.map( row => moment(row.Zugriff).toDate() ) ;
		  var rangeXMin = json.map( row => moment(row.Zugriff).toDate() )[0];
		  var rangeXMax = json.map( row => moment(row.Zugriff).toDate() )[(json.map( row => moment(row.Zugriff).toDate())).length-1];
		  configKuehlung.options.plugins.zoom.zoom.rangeMin.x = rangeXMin;
		  configKuehlung.options.plugins.zoom.pan.rangeMin.x = rangeXMin;
		  configKuehlung.options.plugins.zoom.zoom.rangeMax.x = rangeXMax;
		  configKuehlung.options.plugins.zoom.pan.rangeMax.x = rangeXMax;
		  configKuehlung.data.datasets[0].data = json.map( row => row.An );
		  // create Chart
		  var ctx   = document.getElementById( "lineChartKuehlung" ).getContext( "2d" ) ;
		  var chart = new Chart( ctx, configKuehlung ) ;
	 } )
	 .catch( error => alert("Error: "+error) ) ;
