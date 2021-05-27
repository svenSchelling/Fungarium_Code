$(document).ready(function () {
	$('.submit').click(function (e) {
	e.preventDefault();
	var lichtende = $('#lichtende').val();
	var lichtstart = $('#lichtstart').val();
	var mindesttemp = $('#mindesttemp').val();
	var hoechsttemp = $('#hoechsttemp').val();
	
	var mindesttempNacht = $('#mindesttempNacht').val();
	var hoechsttempNacht = $('#hoechsttempNacht').val();
	
	var mindestfeuchte = $('#mindestfeuchte').val();
	var befeuchtungsdauer = $('#befeuchtungsdauer').val();
	var lueftungsdauer = $('#lueftungsdauer').val();
	var lueftungsintervall = $('#lueftungsintervall').val();   
	
	// Alert window "swal"
	swal({title:'Übermittelte Daten:',
		 text: '\nLichtstart: ' + lichtstart + ' Uhr\nLichtende: ' + lichtende + ' Uhr\nMindesttemperatur: ' + mindesttemp + ' °C\nHöchsttemperatur: ' + hoechsttemp + ' °C\nMindesttemperatur nachts: ' + mindesttempNacht + ' °C\nHöchsttemperatur nachts: ' + hoechsttempNacht +' °C\nMindestfeuchtigkeit: ' + mindestfeuchte + ' %\nBefeuchtungsdauer: ' + befeuchtungsdauer + ' min\nLüftungsdauer: ' + lueftungsdauer + ' min\nLüftungsintervall: ' + lueftungsintervall + ' min', 
		 icon: "success"}).then(function(){
			 location.reload();
			}
		 );      
	$.ajax
		({
		type: "POST",
		
		// submit function 
		url: "form_submit_test.php",
		data: { "lichtende": lichtende, "lichtstart": lichtstart, "mindesttemp": mindesttemp, "hoechsttemp": hoechsttemp, "mindesttempNacht": mindesttempNacht, "hoechsttempNacht": hoechsttempNacht, "mindestfeuchte": mindestfeuchte, "befeuchtungsdauer": befeuchtungsdauer, "lueftungsdauer": lueftungsdauer, "lueftungsintervall": lueftungsintervall},
		success: function (data) {
			$('.result').html(data);
			$('#contactform')[0].reset();
		}
		});
	});
});
