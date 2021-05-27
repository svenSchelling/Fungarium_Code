 $(document).ready(
	function(){
	
	var isShow = false;
	
	if($("#autoManu")[0].checked)
	{
		$("#steuerung").show();  
		 
		$("#divshow").show(); 
		$("#manuAktio").show();    

		$("#lichteinstellungen").hide(); 
		$("#temperatureinstellungen").hide();
		$("#luftfeuchtigkeitseinstellungen").hide(); 
		$("#lueftungseinstellungen").hide(); 
		isShow = true;
	}else{
		$("#steuerung").show(); 
										
		$("#divshow").hide();
		$("#manuAktio").hide();
		
		$("#lichteinstellungen").show(); 
		$("#temperatureinstellungen").show();   
		$("#luftfeuchtigkeitseinstellungen").show(); 
		$("#lueftungseinstellungen").show();  
		isShow = false;
	}
	
		$("#autoManu").click(function(){
			if(isShow == false){
				$("#steuerung").show();  
				
				$("#divshow").show(); 
				$("#manuAktio").show(); 
				
				$("#lichteinstellungen").hide(); 
				$("#temperatureinstellungen").hide();
				$("#luftfeuchtigkeitseinstellungen").hide();
				$("#lueftungseinstellungen").hide();
				isShow = true;
			}else{
				$("#steuerung").show();                 
				
				$("#divshow").hide();
				$("#manuAktio").hide(); 
				
				$("#lichteinstellungen").show(); 
				$("#temperatureinstellungen").show(); 
				$("#luftfeuchtigkeitseinstellungen").show(); 
				$("#lueftungseinstellungen").show(); 
				isShow = false;
			}
		})
	}
);
