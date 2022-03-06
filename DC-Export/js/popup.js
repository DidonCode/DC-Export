var header = document.getElementById("header");
var text = document.getElementById("text");

function openPopup(headerT, textT) {
	document.getElementById("overlay").style.display = "block";

	header.innerHTML = headerT;
	text.innerHTML = textT;

	console.log("oui");

	setTimeout(function(){
		closePopup()
	}, 5000);
}

function closePopup(){
	document.getElementById("overlay").style.display = "none";
	console.log("close");
}