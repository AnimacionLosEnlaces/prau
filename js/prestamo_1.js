// JavaScript Document
var myForm = document.getElementById('form1');
var usrInput = document.getElementById('usr_input');
var usrName = document.getElementById('usr_name');
var usrImg = document.getElementById('usr_img');
var usrCurso = document.getElementById('usr_curso');

var usrData = document.getElementById('usr_data');
var usrError = document.getElementById('usr_error');

usrInput.addEventListener('change',getUserData);


function initJS(){
	usrInput.focus();	
}

function getUserData(codigo){
	//Obtengo los datos introducidos
	var usrCode = usrInput.value;
	//console.log(usrCode);
	 if (usrCode.length != 0) { 
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                myObj = JSON.parse(this.responseText);
            	if(myObj.error != '')
				{
					usrError.innerHTML = myObj.error;
					usrError.style.display = "block";
					
				}
				else
				{
					usrName.innerHTML = myObj.nombre;
					usrImg.src = "img/usuarios/" + myObj.imagen;
					usrCurso.innerHTML = myObj.nombre_curso;
					usrData.style.display = "block";
					
					
					
				}
			}
        };
        xmlhttp.open("GET", "includes/get_user_data.php?u=" + usrCode, true);
        xmlhttp.send();
    }
}

