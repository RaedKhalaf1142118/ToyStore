var currentActive,previouseActive;

function changeNavBarState(current,old){
	document.getElementById(current).className = "main-nav-item selected";
	document.getElementById(old).className = "main-nav-item";
	showSubNavBar(current,old);
}

function showSubNavBar(current,old){
	hide(old);
	show(current);
}

function hide(elementId){
	document.getElementById(elementId+"SubNavBar").style.display = "none";
}

function show(elementId){
	document.getElementById(elementId+"SubNavBar").style.display = "block";
}

function select(elementId,originalClass){
	document.getElementById(elementId).className = originalClass+" selected";
}

function unselect(elementId,originalClass){
	document.getElementById(elementId).className = originalClass;
}

function activate(elementId){
	previouseActive = currentActive;
	currentActive = elementId;
	select(currentActive,"sub-nav-item");
	unselect(previouseActive,"sub-nav-item");
}