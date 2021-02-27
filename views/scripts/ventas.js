var tabla;

//Funcion que se ejecute al inicio

function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function (e)
    {
        guardaryeditar(e);
    });
    $("#imagenmuestra").hide();
    
    
    $.post("../../ajax/ventas.php?op=selectPuntoVenta", function (r) {
        $("#idpuntoventa").html(r);
        $("#idpuntoventa").selectpicker('refresh');
    })
    $.post("../../ajax/ventas.php?op=selectBanco", function (r) {
        $("#idbanco").html(r);
        $("#idbanco").selectpicker('refresh');
    })
    $.post("../../ajax/ventas.php?op=selectTipoPago", function (r) {
        $("#idtipopago").html(r);
        $("#idtipopago").selectpicker('refresh');
    })
    $.post("../../ajax/ventas.php?op=selectCiudad", function (r) {
        $("#id_ciu_ven").html(r);
        $("#id_ciu_ven").selectpicker('refresh');
    })
    $.post("../../ajax/ventas.php?op=selectColaborador", function (r) {
        $("#id_col_ven").html(r);
        $("#id_col_ven").selectpicker('refresh');
    })
    $.post("../../ajax/ventas.php?op=selectCliente", function (r) {
        $("#id_cli_ven").html(r);
        $("#id_cli_ven").selectpicker('refresh');
    })
}

//funcion limpiar

function  limpiar() {
    $("#fec_ven").val(" ");
    $("#totalventa").val(" ");
    $("#int_pvn_ven").val(" ");
    $("#id_tpa_ven").val(" ");
    $("#id_ciu_ven").val(" ");
    $("#id_col_ven").val(" ");
    $("#id_cli_ven").val(" ");
    $("#imagenmuestra").attr("src","");
    $("#imagenactual").val("");


}

// funcion mostrar formulario

function mostrarform(flag)

{
    limpiar();
    if (flag) {

        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();

    } else {

        $("#listadoregistros").show();
        $("#formularioregistros").hide();
    }

}

function cancelarform() {

    limpiar();
    mostrarform(false);
}

// funcion listar

//Función Listar
function listar()
{
    tabla = $('#tbllistado').dataTable(
            {
                "aProcessing": true, //Activamos el procesamiento del datatables
                "aServerSide": true, //Paginación y filtrado realizados por el servidor
                dom: 'Bfrtip', //Definimos los elementos del control de tabla
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdf'
                ],
                "ajax":
                        {
                            url: '../../ajax/ventas.php?op=listar',
                            type: "get",
                            dataType: "json",
                            error: function (e) {
                                console.log(e.responseText);
                            }
                        },
                "bDestroy": true,
                "iDisplayLength": 5, //Paginación
                "order": [[0, "desc"]]//Ordenar (columna,orden)
            }).DataTable();
}
function guardaryeditar(e)
{
    e.preventDefault(); //No se activarÃ¡ la acciÃ³n predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../../ajax/ventas.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos)
        {
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        }

    });
    limpiar();
}

function mostrar(id_ven) {
    $.post("../../ajax/ventas.php?op=mostrar", {id_ven: id_ven}, function (data, status)
    {
        data = JSON.parse(data);
        mostrarform(true);
        $("#id_ven").val(data.id_ven);
        $("#fec_ven").val(data.fec_env_ven);
        $("#totalventa").val(data.tot_ven);
        $("#imagenmuestra").show();
        $("#imagenmuestra").attr("src","../files/ventas/"+data.imagen);
	$("#imagenactual").val(data.imagen);
        $("#idpuntoventa").val(data.int_pvn_ven);
        $("#idpuntoventa").selectpicker('refresh');
        $("#idbanco").val(data.id_ban_ven);
        $("#idbanco").selectpicker('refresh');
        $("#idtipopago").val(data.id_tpa_ven);
        $("#idtipopago").selectpicker('refresh');
        $("#id_ciu_ven").val(data.id_ciu_ven);
        $("#id_col_ven").val(data.id_col_ven);
        $("#id_cli_ven").val(data.id_cli_ven);
    });
}
//funcion para desactivar articulo
function desactivar(id_ven) {
    bootbox.confirm("¿Esta seguro de querer desactivar la venta?", function (result) {
        if (result) {
            $.post("../../ajax/ventas.php?op=desactivar", {id_ven: id_ven}, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}
//funcion para activar articulo
function activar(id_ven) {
    bootbox.confirm("¿Esta seguro de querer activar la venta?", function (result) {
        if (result) {
            $.post("../../ajax/ventas.php?op=activar", {id_ven: id_ven}, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });

        }
    });
}
function eliminar(id_ven){
    bootbox.confirm("¿Está seguro que desea eliminar de manera definitiva esta Capacitacion?", function(result){
     
        if(result){
            $.post("../../ajax/capacitacion.php?op=eliminar", {id_ven:id_ven},function(e){
             bootbox.alert(e);
             tabla.ajax.reload();
            });
        }
    });
}

init();

