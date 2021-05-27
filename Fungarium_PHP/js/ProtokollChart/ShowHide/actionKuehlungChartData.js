//	Shows or Hides the Kühlung Chart on 'Protokoll' when the component is selected in the settings 'Vorhandene Komponenten' 
$(document).ready(
	function(){
	
	var isShow = false;
	
	if($("#kuehlung")[0].checked)
	{
		$("#kuehlungChart").show(); 
		isShow = true;
	}else{
		$("#kuehlungChart").hide();
		isShow = false;
	}
	
		$("#kuehlung").click(function(){
			if(isShow == false){
				$("#kuehlungChart").show(); 
				isShow = true;
			}else{
				$("#kuehlungChart").hide();
				isShow = false;
			}
		})
	}
);
