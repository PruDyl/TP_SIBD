

function SuprElmnt() {
	var checkedValue = new Array();
	var checkboxes = document.getElementById("table").getElementsByTagName("input");
	var table = document.getElementById("table").getAttribute("name");
	
	for (var i = 0, iMax = checkboxes.length; i < iMax; ++i) {
	   var check = checkboxes[i];
	   if (check.type == "checkbox" && check.checked) {
		   checkedValue.push(parseInt(check.value));
	   }
	}
	
	$.ajax({
	       url : '../../app/controller/AjaxController.php',
	       type : 'POST',
	       data : 'action=ajax_supr_'+table+'&id='+checkedValue,
	       dataType : 'json',
	       success : function(data){
	           //console.log(data);
	    	   alert(data['msg']);
	    	   location.reload();
	    	   	
	       },
	       error : function(request, error) {       
	    	   console.log("Erreur : "+error);
	       }
	});
}

function ModElmnt(id) {
	var table = document.getElementById("table").getAttribute("name");
	
	$.ajax({
	       url : '../../app/controller/AjaxController.php',
	       type : 'POST',
	       data : 'action=ajax_mod_'+table+'&id='+id,
	       dataType : 'json',
	       success : function(data){
	           //console.log(data);
	    	   alert(data['msg']);
	    	   location.reload();
	    	   	
	       },
	       error : function(request, error) {       
	    	   console.log("Erreur : "+error);
	       }
	});
}