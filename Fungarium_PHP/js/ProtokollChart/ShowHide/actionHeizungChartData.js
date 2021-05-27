//	Shows or Hides the Heizung Chart on 'Protokoll' when the component is selected in the settings 'Vorhandene Komponenten' 
$(document).ready(
	function(){
	
	var isShow = false;
	
	if($("#heizung")[0].checked)
	{
		$("#heizungChart").show(); 
		isShow = true;
	}else{
		$("#heizungChart").hide();
		isShow = false;
	}
	
		$("#heizung").click(function(){
			if(isShow == false){
				$("#heizungChart").show(); 
				isShow = true;
			}else{
				$("#heizungChart").hide();
				isShow = false;
			}
		})
	}
);
