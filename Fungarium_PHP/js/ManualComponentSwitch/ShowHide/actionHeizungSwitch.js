 $(document).ready(
	function(){
	
	var isShow = false;
	
	if($("#heizung")[0].checked)
	{
		$("#heizungManu").show(); 
		$("#heizungManuLabel").show(); 
		$("#heizungManuSw").show(); 
		isShow = true;
	}else{
		$("#heizungManu").hide();
		$("#heizungManuLabel").hide();  
		$("#heizungManuSw").hide(); 
		isShow = false;
	}
	
		$("#heizung").click(function(){
			if(isShow == false){
				$("#heizungManu").show(); 
				$("#heizungManuLabel").show();
				$("#heizungManuSw").show();  
				isShow = true;
			}else{
				$("#heizungManu").hide();
				$("#heizungManuLabel").hide(); 
				$("#heizungManuSw").hide(); 
				isShow = false;
			}
		})
	}
);
