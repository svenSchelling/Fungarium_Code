 $(document).ready(
	function(){
	
	var isShow = false;
	
	if($("#licht")[0].checked)
	{
		$("#lichtManu").show(); 
		$("#lichtManuLabel").show(); 
		$("#lichtManuSw").show(); 
		isShow = true;
	}else{
		$("#lichtManu").hide();
		$("#lichtManuLabel").hide();  
		$("#lichtManuSw").hide(); 
		isShow = false;
	}
	
		$("#licht").click(function(){
			if(isShow == false){
				$("#lichtManu").show(); 
				$("#lichtManuLabel").show(); 
				$("#lichtManuSw").show(); 
				isShow = true;
			}else{
				$("#lichtManu").hide();
				$("#lichtManuLabel").hide(); 
				$("#lichtManuSw").hide(); 
				isShow = false;
			}
		})
	}
);
