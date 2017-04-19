// JavaScript Document
var myForm = document.getElementById('form1');
var usrInput = document.getElementById('usr_input');

usrInput.addEventListener('change',getUserData);

function getUserData(codigo){
	//Obtengo los datos introducidos
	var usrCode = usrInput.value;
	console.log(usrCode);
	 if (usrCode.length != 0) { 
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "includes/get_user_data.php?u=" + usrCode, true);
        xmlhttp.send();
    }
}

