// js to draw LineChart 'Lüftung'
// configuration of the LineChart
   var configLueftung = {
   type: "line",
   data: {
	  labels: [],
	  datasets: [{
		 label: "Lüftung",
		 lineTension: 0,
		 backgroundColor: "grey",
		 borderColor: "grey",
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
fetch( "lueftung_data.php" )
	 .then( response => response.json() )
	 .then( json => {
		  configLueftung.data.labels = json.map( row => moment(row.Zugriff).toDate() ) ;
		  var rangeXMin = json.map( row => moment(row.Zugriff).toDate() )[0];
		  var rangeXMax = json.map( row => moment(row.Zugriff).toDate() )[(json.map( row => moment(row.Zugriff).toDate())).length-1];
		  configLueftung.options.plugins.zoom.zoom.rangeMin.x = rangeXMin;
		  configLueftung.options.plugins.zoom.pan.rangeMin.x = rangeXMin;
		  configLueftung.options.plugins.zoom.zoom.rangeMax.x = rangeXMax;
		  configLueftung.options.plugins.zoom.pan.rangeMax.x = rangeXMax;
		  configLueftung.data.datasets[0].data = json.map( row => row.An );
		  // create Chart
		  var ctx   = document.getElementById( "lineChartLueftung" ).getContext( "2d" ) ;
		  var chart = new Chart( ctx, configLueftung ) ;
	 } )
	 .catch( error => alert("Error: "+error) ) ;
