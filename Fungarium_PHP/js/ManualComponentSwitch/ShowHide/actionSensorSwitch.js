 $(document).ready(
	function(){
	
	var isShow = false;
	
	if($("#sensor")[0].checked)
	{
		$("#sensorManu").show(); 
		$("#sensorManuLabel").show(); 
		$("#sensorManuLabelSwitch").show(); 
		isShow = true;
	}else{
		$("#sensorManu").hide();
		$("#sensorManuLabel").hide(); 
		$("#sensorManuLabelSwitch").hide();  
		isShow = false;
	}
	
		$("#sensor").click(function(){
			if(isShow == false){
				$("#sensorManu").show(); 
				$("#sensorManuLabel").show(); 
				$("#sensorManuLabelSwitch").show(); 
				isShow = true;
			}else{
				$("#sensorManu").hide();
				$("#sensorManuLabel").hide(); 
				$("#sensorManuLabelSwitch").hide(); 
				isShow = false;
			}
		})
	}
);
