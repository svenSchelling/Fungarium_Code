$(document).ready(
	function(){
	
	var isShow = false;
	
	if($("#TerraFunga")[0].checked)
	{
		$("#header").html("Fungarium");      
		$("#title").html("Steuerung Fungarium");      
		$("#homeIcon").attr('src',"favicon.ico/mushrooms_30.ico");    
		$("#IconStart").attr('href',"favicon.ico/mushrooms.ico");   
		isShow = true;
	} else{
		$("#header").html("Terrarium");  
		$("#title").html("Steuerung Terrarium");   
		$("#homeIcon").attr('src',"favicon.ico/terrarium_30.ico");       
		$("#IconStart").attr('href',"favicon.ico/terrarium.ico");      
		isShow = false;
	}
	
		$("#TerraFunga").click(function(){
			if(isShow == false){
				$("#header").html("Fungarium"); 
				$("#title").html("Steuerung Fungarium");    
				$("#homeIcon").attr('src',"favicon.ico/mushrooms_30.ico");   
				$("#IconStart").attr('href',"favicon.ico/mushrooms.ico");   
				isShow = true;
			} else{
				$("#header").html("Terrarium");   
				$("#title").html("Steuerung Terrarium");   
				$("#homeIcon").attr('src',"favicon.ico/terrarium_30.ico");     
				$("#IconStart").attr('href',"favicon.ico/terrarium.ico");   
				isShow = false;
			}
		})
	
		
	}
);
