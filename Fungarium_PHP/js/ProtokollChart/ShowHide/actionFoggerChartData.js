//	Shows or Hides the Fogger Chart on 'Protokoll' when the component is selected in the settings 'Vorhandene Komponenten' 
$(document).ready(
	function(){
	
	var isShow = false;
	
	if($("#fogger")[0].checked)
	{
		$("#foggerChart").show(); 
		isShow = true;
	}else{
		$("#foggerChart").hide();
		isShow = false;
	}
	
		$("#fogger").click(function(){
			if(isShow == false){
				$("#foggerChart").show(); 
				isShow = true;
			}else{
				$("#foggerChart").hide();
				isShow = false;
			}
		})
	}
);
