 $(document).ready(
	function(){
	
	var isShow = false;
	
	if($("#kuehlung")[0].checked)
	{
		$("#kuehlungManu").show(); 
		$("#kuehlungManuLabel").show(); 
		$("#kuehlungManuLabelSwitch").show(); 
		isShow = true;
	}else{
		$("#kuehlungManu").hide();
		$("#kuehlungManuLabel").hide();  
		$("#kuehlungManuLabelSwitch").hide(); 
		isShow = false;
	}
	
		$("#kuehlung").click(function(){
			if(isShow == false){
				$("#kuehlungManu").show(); 
				$("#kuehlungManuLabel").show();
				$("#kuehlungManuLabelSwitch").show();  
				isShow = true;
			}else{
				$("#kuehlungManu").hide();
				$("#kuehlungManuLabel").hide(); 
				$("#kuehlungManuLabelSwitch").hide(); 
				isShow = false;
			}
		})
	}
);
