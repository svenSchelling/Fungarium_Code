 $(document).ready(
	function(){
	
	var isShow = false;
	
	if($("#lueftung")[0].checked)
	{
		$("#lueftungManu").show(); 
		$("#lueftungManuLabel").show(); 
		$("#lueftungManuLabelSwitch").show(); 
		isShow = true;
	}else{
		$("#lueftungManu").hide();
		$("#lueftungManuLabel").hide(); 
		$("#lueftungManuLabelSwitch").hide();  
		isShow = false;
	}
	
		$("#lueftung").click(function(){
			if(isShow == false){
				$("#lueftungManu").show(); 
				$("#lueftungManuLabel").show(); 
				$("#lueftungManuLabelSwitch").show(); 
				isShow = true;
			}else{
				$("#lueftungManu").hide();
				$("#lueftungManuLabel").hide(); 
				$("#lueftungManuLabelSwitch").hide(); 
				isShow = false;
			}
		})
	}
);
