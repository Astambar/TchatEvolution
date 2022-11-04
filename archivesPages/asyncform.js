document.getElementById("message").addEventListener("submit", function(e) {
	e.preventDefault();
	var data = new FormData(this);
var xhr = new XMLHttpRequest();
xhr.onreadystatechange = function() {
	if(this.readyState == 4 && this.status == 200)
	{
		console.log(this.response);
	} else if (this.readyState == 4)
	{
		alert("Une erreur est survenue...");
	}
	console.log(this);
};
xhr.open("POST", "async/formMessage.php", true);
// (donné dans URL)
//xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
xhr.send(data);
return false;
});