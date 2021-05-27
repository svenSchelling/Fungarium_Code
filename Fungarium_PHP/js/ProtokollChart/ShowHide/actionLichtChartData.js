//	Shows or Hides the Licht Chart on 'Protokoll' when the component is selected in the settings 'Vorhandene Komponenten' 
$(document).ready(
	function(){
	
	var isShow = false;
	
	if($("#licht")[0].checked)
	{
		$("#lichtChart").show(); 
		isShow = true;
	}else{
		$("#lichtChart").hide();
		isShow = false;
	}
	
		$("#licht").click(function(){
			if(isShow == false){
				$("#lichtChart").show(); 
				isShow = true;
			}else{
				$("#lichtChart").hide();
				isShow = false;
			}
		})
	}
);
