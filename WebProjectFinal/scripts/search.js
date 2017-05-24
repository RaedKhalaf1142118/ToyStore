var selected_search_tool_sub_Name = "-search-tool";
var selected_search_dispaly_sub_name = "-search-display";

function switchSearchToolState(newSelect,old){
	document.getElementById(newSelect+selected_search_tool_sub_Name).className = "selected-search-tool";
	document.getElementById(old+selected_search_tool_sub_Name).className = "";
	show_search_display(newSelect);
	hide_search_display(old);
}

function show_search_display(newSelect){
	document.getElementById(newSelect+selected_search_dispaly_sub_name).className = "";
}

function hide_search_display(old){
	document.getElementById(old+selected_search_dispaly_sub_name).className = "unselected_search_display";
}

function validatePriceSearchForm(){
	var from = document.getElementById('from-price');
	var to = document.getElementById('to-price');
	var searchbutton = document.getElementById('price-search-button');
	var errorMessage = document.getElementById('price-search-form-error');
	var isValid = false;
	var tempErrorMessage = "from must be less than to";


	if(from.value == ''){
		tempErrorMessage = "from field is required *";
	}else{
		if(to.value == ''){
			tempErrorMessage = "'To' field is required *";
		}else{
			if(parseInt(from.value) > parseInt(to.value)){
				tempErrorMessage = "from must be less than to";
			}else{
				isValid = true;
			}
		}
	}
	errorMessage.innerHTML = tempErrorMessage;
	if(isValid){
		errorMessage.className = "price-search-error-hide";
		searchbutton.disabled = false;
	}else{
		errorMessage.className = "price-search-error-show";
		searchbutton.disabled = true;
	}
}