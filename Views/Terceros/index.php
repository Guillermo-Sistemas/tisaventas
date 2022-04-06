<?php include "Views/Templates/header.php" ?>

<ol class="breadcrumb mb-4">
    <h1><li class="breadcrumb-item active">Terceros</li><h1>
</ol>

<button class="btn btn-primary mb-2" type="button" onclick="frmTercero();">Crear Tercero <i class="fas fa-plus"></i></button>

<table class="table table-light" id="tblTerceros">
    <thead class="thead-dark">
        <tr>
            <!--th>Id</th-->
            <th>Documento</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>Ciudad</th>
            <th>Tipo</th>
            <th>Estado</th>
            <th></th>
            
            
            
        </tr>
    </thead>
    <tbody>
        
    </tbody>
</table>



<div id="nuevo_tercero" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="title">Nuevo Tercero</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmTercero">
                    <div class="form-group">

                        <input type="hidden" id="id" name="id">       

                        <label for="documento">Documento</label>
                        <input id="documento" class="form-control" type="text" name="documento" placeholder="Documento">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre de Tercero">
                    </div>
                    
                    <div class="row" id="teltipo">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input id="telefono" class="form-control" type="text" name="telefono" placeholder="Teléfono">
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                <label for="rol">Tipo de Tercero</label>
                                <select id="tipo" class="form-control" name="tipo">
                                <?php foreach ($data['tipos'] as $row) { ?>
                                    <option value="<?php echo $row['id'];?>"><?php echo $row['nombre_tipos'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    

                    <div class="row" id="dirciu">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion">Direccón</label>
                                <input id="direccion" class="form-control" type="text" name="direccion" placeholder="Direccón">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ciudad">Ciudad</label>
                                <input id="ciudad" class="form-control" type="text" name="ciudad" placeholder="Ciudad">
                            </div>
                        </div>
                    </div>
                    
                    


                    
                    
                    <button class="btn btn-primary" type="button" onclick="registerTercero(event)" id="btnAccion">Registrar</button>
                    
                    
                    
                </form>
            </div>
        </div>
    </div>
</div>





<?php include "Views/Templates/footer.php" ?>
