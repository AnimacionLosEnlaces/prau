// JavaScript Document
var myForm = document.getElementById('form1');
var usrInput = document.getElementById('usr_input');
var usrName = document.getElementById('usr_name');
var usrImg = document.getElementById('usr_img');
var usrCurso = document.getElementById('usr_curso');

var usrData = document.getElementById('usr_data');
var usrError = document.getElementById('usr_error');

//Div con el input de los productos
var productInputDiv = document.getElementById('product_input_div');
var productInput = document.getElementById('product_input');

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
					usrID = myObj.id_usuario;
					//Creamos un préstamo
					var id_prestamo = insertPrestamo(usrID);
					if(id_prestamo == 'error')
					{
						usrError.innerHTML = "Se ha producido un error al crear el préstamo";
						usrError.style.display = "block";
					}
					else
					{
						usrError.style.display = "none";
						productInputDiv.style.display = "block";
						productInput.focus();
					}
					
				}
			}
        };
        xmlhttp.open("GET", "includes/get_user_data.php?u=" + usrCode, true);
        xmlhttp.send();
    }
}

function insertPrestamo(id_usuario){
	//console.log(id_usuario);
	 if (id_usuario.length != 0) { 
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                return this.responseText;

			}
        };
        xmlhttp.open("GET", "includes/insert_prestamo.php?u=" + id_usuario, true);
        xmlhttp.send();
    }
	
}

