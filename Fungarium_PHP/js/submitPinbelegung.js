$(document).ready(function () {
	$('.submitPin').click(function (e) {
	e.preventDefault();
	var lichtPin = $('#lichtPin').val();
	var heizungPin = $('#heizungPin').val();
	var kuehlungPin = $('#kuehlungPin').val();
	var foggerPin = $('#foggerPin').val();
	
	var lueftungPin = $('#lueftungPin').val();
	var lueftungNiedertourigPin = $('#lueftungNiedertourigPin').val();
	
	var sensorPin = $('#sensorPin').val();
	
	if (lichtPin == '') lichtPin = '--' ;
	if (heizungPin == '') heizungPin = '--' ;
	if (kuehlungPin == '') kuehlungPin = '--' ;
	if (foggerPin == '') foggerPin = '--' ;
	if (lueftungPin == '') lueftungPin = '--' ;
	if (lueftungNiedertourigPin == '') lueftungNiedertourigPin = '--' ;
	if (sensorPin == '') sensorPin = '--' ;
		
	// Alert window "swal"
	swal({title:'Übermittelte Daten:',
		 text: '\nLicht Pin: ' + lichtPin + '\nHeizung Pin: ' + heizungPin + '\nKühlung Pin: ' + kuehlungPin + '\nFogger Pin: ' + foggerPin + '\nLüftung Pin: ' + lueftungPin + '\nLüftung Niedertourig Pin: ' + lueftungNiedertourigPin +'\nSensor Pin: ' + sensorPin, 
		 icon: "success"}).then(function(){
			 location.reload();
			}
		 ); 
	if (lichtPin == '--') lichtPin = null ;
	if (heizungPin == '--') heizungPin = null;
	if (kuehlungPin == '--') kuehlungPin = null;
	if (foggerPin == '--') foggerPin = null;
	if (lueftungPin == '--') lueftungPin = null;
	if (lueftungNiedertourigPin == '--') lueftungNiedertourigPin = null;
	if (sensorPin == '--') sensorPin = null;	     
	
	$.ajax
		({
		type: "POST",
		
		// submit function 
		url: "voreinstellungen_submit.php",
		data: { "lichtPin": lichtPin, "heizungPin": heizungPin, "kuehlungPin": kuehlungPin, "foggerPin": foggerPin, "lueftungPin": lueftungPin, "lueftungNiedertourigPin": lueftungNiedertourigPin, "sensorPin": sensorPin},
		success: function (data) {
			$('.resultPin').html(data);
			$('#contactformPin')[0].reset();
		}
		});
	});
});
