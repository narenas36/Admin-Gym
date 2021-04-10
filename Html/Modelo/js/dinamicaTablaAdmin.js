window.onload = function() {
    actualizar();
    $("#contentTabla").LoadingOverlay("show", {
        backgroundClass: "false",
        imageColor: "white",
        maxSize: 70
    });
    esperandoElemento("contentTabla", function() {
        $("#contentTabla").LoadingOverlay("hide");
    });
    // Funcion para crear tabla de dialogo de informacion de clientes
    $("#infoClient").dialog({
        autoOpen: false,
        height: 230,
        width: 370,
        resizable: false,
        modal: true,
        buttons: {
            "Actualizar": actualizarFormularioInfo,
            "Eliminar": eliminarFormularioInfo,
            "Cerrar": cerrarFormularioInfo
        }
    });
    // Funcion para crear tabla de dialogo para agregar clientes
    $("#agregarClient").dialog({
        autoOpen: false,
        height: 230,
        width: 340,
        resizable: false,
        modal: true,
        buttons: {
            "Agregar": agregarFormularioAgregar,
            "Cerrar": cerrarFormularioAgregar
        }
    });
    // Funcion para crear tabla de dialogo para buscar clientes
    $("#buscarClient").dialog({
        autoOpen: false,
        height: 170,
        width: 340,
        resizable: false,
        modal: true,
        buttons: {
            "Buscar": cerrarFormularioBuscar
        }
    });
    $("#buscarClient").find("#buscarDato").keyup(buscarFormularioBuscar);
}

function esperandoElemento(id, callback) {
    var tiempo = setInterval(function() {
        if (document.getElementById(id)) {
            clearInterval(tiempo);
            callback();
        }
    }, 2000);
}
// Funcion para cerrar dialogo
function cerrarFormularioInfo() {
    $("#infoNumero").val("");
    $("#infoNombre").val("");
    $("#infoFecha").val("");
    $("#infoClient").dialog("close");
}
// Funcion para actualizar datos del cliente
function actualizarFormularioInfo() {
    var numero = $("#infoNumero").val();
    var nombre = $("#infoNombre").val();
    var fecha = $("#infoFecha").val();
    if (confirm("Seguro que quieres actualizar la siguiente informacion?")) {
        $.post("http://localhost/Admin-Gym/index.php?accion=actualizarInfo", {
            numActu: numero,
            nomActu: nombre,
            fechActu: fecha
        }, function(event) {
            $("#infoClient").dialog("close");
            $("#infoNombre").attr("value", "");
            $("#infoFecha").attr("value", "");
            cerrarFormularioInfo();
            if (event != 0) {
                if (event != 1) {
                    actualizar();
                    alert("El cliente fue actualizado exitosamente!");
                } else {
                    actualizar();
                    alert("Datos no encontrados, intente de nuevo.");
                }
            } else {
                actualizar();
                alert("Error en conexion, intente mas tarde.");
            }
        });
    }
}
// Funcion para eliminar datos del cliente
function eliminarFormularioInfo() {
    var numero = $("#infoNumero").val();
    if (confirm("Seguro que quieres eliminar la siguiente informacion?")) {
        $.post("http://localhost/Admin-Gym/index.php?accion=eliminarInfo", {
            numEli: numero
        }, function(event) {
            $("#infoClient").dialog("close");
            $("#infoNombre").attr("value", "");
            $("#infoFecha").attr("value", "");
            cerrarFormularioInfo();
            if (event != 0) {
                if (event != 1) {
                    actualizar();
                    alert("El cliente fue eliminado exitosamente!");
                } else {
                    actualizar();
                    alert("Datos no encontrados, intente de nuevo.");
                }
            } else {
                actualizar();
                alert("Error en conexion, intente mas tarde.");
            }
        });
    }
}
// Funcion para abrir dialogo
function abrirFormularioAgregar() {
    $("#agregarClient").dialog("open");
}
// Funcion para cerrar dialogo
function cerrarFormularioAgregar() {
    $("#agregarNumero").val("");
    $("#agregarNombre").val("");
    $("#agregarFecha").val("");
    $("#agregarClient").dialog("close");
}
// Funcion para agregar datos del cliente
function agregarFormularioAgregar() {
    var numero = $("#agregarNumero").val();
    var nombre = $("#agregarNombre").val();
    var fecha = $("#agregarFecha").val();
    $.post("http://localhost/Admin-Gym/index.php?accion=agregarInfo", {
        numAgr: numero,
        nomAgr: nombre,
        fechAgr: fecha
    }, function(event) {
        $("#agregarClient").dialog("close");
        $("#agregarNombre").attr("value", "");
        $("#agregarFecha").attr("value", "");
        cerrarFormularioAgregar();
        if (event != 0) {
            if (event != 1) {
                actualizar();
                alert("El cliente fue agregado exitosamente!");
            } else {
                actualizar();
                alert("Datos no encontrados, intente de nuevo.");
            }
        } else {
            actualizar();
            alert("Error en conexion, intente mas tarde.");
        }
    });
}
// Funcion para abrir dialogo
function abrirFormularioBuscar() {
    $("#buscarClient").dialog("open");
}
// Funcion para cerrar dialogo
function cerrarFormularioBuscar() {
    $("#buscarDato").val("");
    $("#buscarClient").dialog("close");
}
// Funcion para buscar cliente
function buscarFormularioBuscar() {
    var tipo = $("#buscarTipo").val();
    var dato = $("#buscarDato").val();
    const letras = dato.length;
    $.get("http://localhost/Admin-Gym/index.php", {
        accion: "buscarInfo"
    }, function(event) {
        if (event != 0) {
            if (event != 1) {
                if (event != 2) {
                    var filas = 0;
                    const datos = JSON.parse(event);
                    var tbody = "";
                    for (let i = 0; i < datos.length; i++) {
                        let persona = datos[i];
                        if (tipo == "ident") {
                            if (dato == persona[0].substring(0, letras)) {
                                tbody += "<tr class='fila" + filas + " table-success'>";
                                tbody += "<td scope='row' style='font-weight: bold'>" + persona[0] + "</td>";
                                for (let j = 1; j < persona.length; j++) {
                                    tbody += "<td>" + persona[j] + "</td>";
                                }
                                tbody += "</tr>";
                                filas += 1;
                            }
                        } else {
                            if (dato.toLowerCase() == persona[1].substring(0, letras).toLowerCase()) {
                                tbody += "<tr class='fila" + filas + " table-success'>";
                                tbody += "<td scope='row' style='font-weight: bold'>" + persona[0] + "</td>";
                                for (let j = 1; j < persona.length; j++) {
                                    tbody += "<td>" + persona[j] + "</td>";
                                }
                                tbody += "</tr>";
                                filas += 1;
                            }
                        }
                    }
                    $("#cuerpoTabla").empty();
                    $("#cuerpoTabla").append(tbody);
                    // Funcion para agregar evento 'click' a todas las etiquetas con clase '.fila'
                    var cont = 0;
                    while (cont < filas) {
                        $("#cuerpoTabla > .fila" + cont).click(function() {
                            var valores = new Array; // Creacion de arreglo
                            $(this).children("td").each(function() {
                                valores.push($(this).text());
                            });
                            $("#infoNumero").val(valores[0]); // Numero
                            $("#infoNombre").val(valores[1]); // Nombre
                            $("#infoFecha").val(valores[2]); // Fecha
                            $("#infoClient").dialog("open"); // Metodo para abrir dialogo
                        });
                        cont += 1;
                    }
                } else {
                    alert("Tabla vacia.");
                }
            } else {
                alert("Datos no encontrados, intente de nuevo.");
            }
        } else {
            alert("Error en conexion, intente mas tarde.");
        }
    }, "text");
}
// Funcion para actualizar la lista
function actualizar() {
    $.get("http://localhost/Admin-Gym/index.php", {
        accion: "buscarInfo"
    }, function(event) {
        if (event != 0) {
            if (event != 1) {
                if (event != 2) {
                    var filas = 0;
                    const datos = JSON.parse(event);
                    var tbody = "";
                    for (let i = 0; i < datos.length; i++) {
                        let persona = datos[i];
                        tbody += "<tr class='fila" + i + " table-success'>";
                        tbody += "<td scope='row' style='font-weight: bold'>" + persona[0] + "</td>";
                        for (let j = 1; j < persona.length; j++) {
                            tbody += "<td>" + persona[j] + "</td>";
                        }
                        tbody += "</tr>";
                        filas += 1;
                    }
                    $("#cuerpoTabla").empty();
                    $("#cuerpoTabla").append(tbody);
                    // Funcion para agregar evento 'click' a todas las etiquetas con clase '.fila'
                    var cont = 0;
                    while (cont < filas) {
                        $("#cuerpoTabla > .fila" + cont).click(function() {
                            var valores = new Array; // Creacion de arreglo
                            $(this).children("td").each(function() {
                                valores.push($(this).text());
                            });
                            $("#infoNumero").val(valores[0]); // Numero
                            $("#infoNombre").val(valores[1]); // Nombre
                            $("#infoFecha").val(valores[2]); // Fecha
                            $("#infoClient").dialog("open"); // Metodo para abrir dialogo
                        });
                        cont += 1;
                    }
                } else {
                    alert("Tabla vacia.");
                }
            } else {
                alert("Datos no encontrados, intente de nuevo.");
            }
        } else {
            alert("Error en conexion, intente mas tarde.");
        }
    }, "text");
}