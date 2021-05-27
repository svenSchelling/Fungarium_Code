//	Shows or Hides the Lüftung Chart on 'Protokoll' when the component is selected in the settings 'Vorhandene Komponenten' 
$(document).ready(
	function(){
	
	var isShow = false;
	
	if($("#lueftung")[0].checked)
	{
		$("#lueftungChart").show(); 
		isShow = true;
	}else{
		$("#lueftungChart").hide();
		isShow = false;
	}
	
		$("#lueftung").click(function(){
			if(isShow == false){
				$("#lueftungChart").show(); 
				isShow = true;
			}else{
				$("#lueftungChart").hide();
				isShow = false;
			}
		})
	}
);
