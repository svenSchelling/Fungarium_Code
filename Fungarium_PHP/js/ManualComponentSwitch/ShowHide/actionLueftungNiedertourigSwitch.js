 $(document).ready(
	function(){
	
	var isShow = false;
	
	if($("#lueftungNiedertourig")[0].checked)
	{
		$("#lueftungNiedertourigManu").show(); 
		$("#lueftungNiedertourigManuLabel").show();
		$("#lueftungNiedertourigManuLabelSwitch").show();
		isShow = true;
	}else{
		$("#lueftungNiedertourigManu").hide();
		$("#lueftungNiedertourigManuLabel").hide();  
		$("#lueftungNiedertourigManuLabelSwitch").hide();
		isShow = false;
	}
	
		$("#lueftungNiedertourig").click(function(){
			if(isShow == false){
				$("#lueftungNiedertourigManu").show(); 
				$("#lueftungNiedertourigManuLabel").show(); 
				$("#lueftungNiedertourigManuLabelSwitch").show();
				isShow = true;
			}else{
				$("#lueftungNiedertourigManu").hide();
				$("#lueftungNiedertourigManuLabel").hide(); 
				$("#lueftungNiedertourigManuLabelSwitch").hide();
				isShow = false;
			}
		})
	}
);
