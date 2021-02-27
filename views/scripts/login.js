$("#frmAcceso").on('submit',function(e)
{
	e.preventDefault();
    logina=$("#usuarioa").val();
    clavea=$("#clavea").val();

    $.post("../ajax/colaboradores.php?op=verificar",
        {"usuarioa":logina,"clavea":clavea},
        function(data)
    {
        if (data!="null")
        {
            $(location).attr("href","admin/frmCapacitacion.php");            
        }
        else
        {
            bootbox.alert("Usuario y/o Password incorrectos");
        }
    });
})