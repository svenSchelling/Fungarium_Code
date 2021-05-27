$(document).ready(
	function(){
	
	var isShow = false;
	
	if($("#TerraFunga")[0].checked)
	{
		$("#mindesttempNacht").hide();  
		$("#hoechsttempNacht").hide(); 	 
		isShow = true;
	} else{
		
		$("#mindesttempNacht").show();    
		$("#hoechsttempNacht").show(); 	   
		isShow = false;
	}
	
		$("#TerraFunga").click(function(){
			if(isShow == false){
				$("#mindesttempNacht").hide(); 
				$("#hoechsttempNacht").hide(); 	    
				isShow = true;
			} else{
				$("#mindesttempNacht").show();  
				$("#hoechsttempNacht").show(); 				
				isShow = false;
			}
		})
	
		
	}
);
