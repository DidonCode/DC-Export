function openNav() {
  document.getElementById("list").style.width = "250px";
}

function closeNav() {
  document.getElementById("list").style.width = "0";
}

function resizeBar(width){
	if(width > 1120){
		document.getElementById("menu").style.marginTop = "-20px";
		document.getElementById("btnOpen").style.visibility = "hidden";
	}else{
		document.getElementById("menu").style.marginTop = "-1000px";
		document.getElementById("btnOpen").style.visibility = "visible";
	}
}

window.onresize = function(){
	resizeBar(window.innerWidth);
}

resizeBar(window.innerWidth);