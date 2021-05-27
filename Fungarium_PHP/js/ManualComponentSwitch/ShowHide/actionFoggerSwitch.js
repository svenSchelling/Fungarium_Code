 $(document).ready(
	function(){
	
	var isShow = false;
	
	if($("#fogger")[0].checked)
	{
		$("#foggerManu").show(); 
		$("#foggerManuLabel").show(); 
		$("#foggerManuLabelSwitch").show(); 
		isShow = true;
	}else{
		$("#foggerManu").hide();
		$("#foggerManuLabel").hide();  
		$("#foggerManuLabelSwitch").hide(); 
		isShow = false;
	}
	
		$("#fogger").click(function(){
			if(isShow == false){
				$("#foggerManu").show(); 
				$("#foggerManuLabel").show(); 
				$("#foggerManuLabelSwitch").show(); 
				isShow = true;
			}else{
				$("#foggerManu").hide();
				$("#foggerManuLabel").hide(); 
				$("#foggerManuLabelSwitch").hide(); 
				isShow = false;
			}
		})
	}
);
