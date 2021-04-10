/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//window.onresize = mostrarDimension; // Redimension de documento
window.onload = function() {
    //mostrarDimension;
    $("#formLogin").validate({
        rules: {
            loginCorreo: {
                required: true
            },
            loginContra: {
                required: true,
                maxlength: 20
            }
        },
        messages: {
            loginCorreo: {
                required: "Debes ingresar tu correo!",
                email: "Debes ingresar un correo valido!"
            },
        	loginContra: {
        		required: "Debes ingresar tu contraseña!",
            maxlength: "Maximo 20 carecteres!"
        	}
        }
    });
    $("#formReg").validate({
        rules: {
            regCorreo: {
                required: true
            },
            regContra: {
                required: true,
                maxlength: 20
            },
            regReContra: {
                required: true,
                equalTo: "#regContra"
            }
        },
        messages: {
            regCorreo: {
                required: "Debes ingresar tu correo!",
                email: "Debes ingresar un correo valido!"
            },
            regContra: {
                required: "Debes ingresar tu contraseña!",
                maxlength: "Maximo 20 carecteres!"
            },
            regReContra: {
                required: "Debes confirmar tu contraseña!",
                equalTo: "La contraseña debe ser igual a la primera!"
            }
        }
    });
    $("#botonRegistrar").click(function() {
        $("#exampleModal").modal({
            backdrop: true,
            focus: true
        }, function() {});
    });

    $("#botonCerrarModel").click(function(){
        $("#regCorreo").val("");
        $("#regContra").val("");
        $("#regReContra").val("");
    });
}
//Para saber alto y ancho
/*function mostrarDimension() {
    var ancho = window.innerWidth;
    var alto = window.innerHeight;
    $("#Documento").html("<label>" + ancho + " x " + alto + "</label>");
}*/