<?php include "Views/Templates/header.php" ?>

<ol class="breadcrumb mb-4">
    <h1><li class="breadcrumb-item active">Usuarios</li><h1>
</ol>

<button class="btn btn-primary mb-2" type="button" onclick="frmUsuario();">Nuevo Usuario <i class="fas fa-plus"></i></button>

<table class="table table-light" id="tblUsuarios">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Tipo de Usuario</th>
            <th>Estado</th>
            <th></th>
            
            
            
        </tr>
    </thead>
    <tbody>
        
    </tbody>
</table>



<div id="nuevo_usuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="title">Nuevo Usuario</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmUsuario">
                    <div class="form-group">

                        <input type="hidden" id="id" name="id">       

                        <label for="usuario">Usuario</label>
                        <input id="usuario" class="form-control" type="text" name="usuario" placeholder="Usuario">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre de Usuario">
                    </div>
                    
                    <div class="row" id="claves">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="clave">Contraseña</label>
                                <input id="clave" class="form-control" type="password" name="clave" placeholder="Ingrese la Contraseña">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="confirmar">Confirmar Contraseña</label>
                                <input id="confirmar" class="form-control" type="password" name="confirmar" placeholder="Confirmar la Contraseña">
                            </div> 
                        </div>
                    
                   
                    </div>


                    
                    <div class="form-group">
                        <label for="rol">Tipo de Usuario</label>
                        <select id="rol" class="form-control" name="rol">
                        <?php foreach ($data['roles'] as $row) { ?>
                            <option value="<?php echo $row['id'];?>"><?php echo $row['nombre_rol'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <button class="btn btn-primary" type="button" onclick="registerUser(event)" id="btnAccion">Registrar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                    
                    
                </form>
            </div>
        </div>
    </div>
</div>





<?php include "Views/Templates/footer.php" ?>
