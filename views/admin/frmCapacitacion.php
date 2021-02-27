<?php
ob_start();
session_start();

if(!isset($_SESSION["usu_col"]))
{
header("Location:../login.php"); 
}
 else 
{
    
require '../admin/frmHeader.php';
?>

<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Capacitaciones <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                          
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Descripcion</th>
                            <th>Nombre</th>
                            <th>Enlace</th>
                            <th>Materia</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Descripcion</th>
                            <th>Nombre</th>
                            <th>Enlace</th>
                            <th>Materia</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" style="height:400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Descripcion:</label>
                            <input type="hidden" name="id_cap" id="id_cap">
                            <input type="text" class="form-control" name="des_cap"  id="des_cap" maxlength="50" placeholder="Descripcion" required>
                          </div>                     
                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombre:</label>
                            <input type="text" class="form-control" name="nom_cap" id="nom_cap" maxlength="256" placeholder="Nombre">
                          </div>  
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Enlace:</label>
                            <input type="text" class="form-control" name="enl_cap" id="enl_cap" maxlength="256" placeholder="Enlace">
                          </div> 
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Materia:</label>
                            <input type="text" class="form-control" name="mat_cap" id="mat_cap" maxlength="256" placeholder="Materia">
                          </div>   
                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Fecha:</label>
                            <input type="date" class="form-control" step="1" value="<?php echo date("Y-m-d");?>"
                            name="fec_cap" id="fec_cap" maxlength="256" placeholder="Fecha">
                          </div> 
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                            
                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
                            
                         
                            
                        </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
  
<?php
require '../admin/frmFooter.php';
?>
  <script type="text/javascript" src="../scripts/capacitacion.js"></script>
  <script src="../scripts/login.js" type="text/javascript"></script>
  <?php 

}

ob_end_flush();
?>

  