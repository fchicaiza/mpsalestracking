<?php
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
                          <h1 class="box-title">Ventas <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Fecha de envio</th>
                            <th>Total Venta</th>
                            <th>Imagen</th>
                            <th>Punto de Venta</th>
                            <th>Banco</th>
                            <th>Tipo Pago</th>
                            <th>Ciudad</th>
                            <th>Colaborador</th>
                            <th>Cliente</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>  
                            <th>Fecha de envio</th>
                            <th>Total Venta</th>
                            <th>Imagen</th>
                            <th>Punto de Venta</th>
                            <th>Banco</th>
                            <th>Tipo Pago</th>
                            <th>Ciudad</th>
                            <th>Colaborador</th>
                            <th>Cliente</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" style="height:400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Fecha de envio:</label>
                            <input type="hidden" name="idven" id="idven">
                            <input type="date" class="form-control" step="1" value="<?php echo date("Y-m-d");?>"
                            name="fechav" id="fec_cap" maxlength="256" placeholder="Fecha">
                          </div>                   
                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Total Venta:</label>
                            <input type="text" class="form-control" name="totalventa" id="totalventa" maxlength="256" placeholder="Total Venta">
                          </div>  
                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Imagen:</label>
                            <input type="file" class="form-control" name="imagen" id="imagen" maxlength="256">
                          </div> 
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Punto de Venta:</label>
                            <select  id="idpuntoventa"  name="idpuntoventa" class="form-control selectpicker" data-live-search="true" maxlength="256"></select>   
                          </div> 
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Banco:</label>
                            <select id="idbanco" name="idbanco" class="form-control selectpicker" data-live-search="true" maxlength="256"></select>
                          </div>  
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Tipo Pago:</label>
                            <select id="idtipopago" name="idtipopago" class="form-control selectpicker"  data-live-search="true"   maxlength="256" ></select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Ciudad:</label>
                            <select class="form-control selectpicker" name="id_ciu_ven" data-live-search="true" id="id_ciu_ven" maxlength="256"></select>
                          </div>
                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Colaborador:</label>
                            <select class="form-control selectpicker" name="id_col_ven" data-live-search="true" id="id_col_ven" maxlength="256"></select>
                          </div>
                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Cliente:</label>
                            <select class="form-control selectpicker" name="id_cli_ven" data-live-search="true" d="id_cli_ven" maxlength="256"></select>
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
  <script type="text/javascript" src="../scripts/ventas.js"></script>