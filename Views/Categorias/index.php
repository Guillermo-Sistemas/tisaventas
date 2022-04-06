<?php include "Views/Templates/header.php" ?>

<ol class="breadcrumb mb-4">
    <h1><li class="breadcrumb-item active">Categorias</li><h1>
</ol>

<button class="btn btn-primary mb-2" type="button" onclick="frmCategoria();">Crear Categoria <i class="fas fa-plus"></i></button>

<table class="table table-light" id="tblCategorias">
    <thead class="thead-dark">
        <tr>
            <!--th>Id</th-->
            <th>Nombre</th>
            <th>Imagen</th>
            <th>Estado</th>
            <th></th>
            
            
            
        </tr>
    </thead>
    <tbody>
        
    </tbody>
</table>







<div id="nuevo_categoria" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="title">Nueva Categoria</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmCategoria">
                    <div class="form-group">

                        <input type="hidden" id="id" name="id">       

                        <label for="nombre">Nombre</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre de la Categoria">
                    </div>

                    <div class="col-md12">
                        <div class="form-group">
                            <label>Imagen</label>
                            
                            <div class="card border-success" >
                                <div class="card-body">
                                    <label for="imagen" id="icon-image" class="btn btn-success"><i class="fas fa-image"></i></label>
                                    <span id="icon-cerrar"></span>
                                    <input id="imagen" class="d-none" type="file" name="imagen" onchange="preview(event)">
                                    <input  type="hidden" id="foto_actual" name="foto_actual">
                                    <!--input  type="hidden" id="foto_delete" id="foto_delete"-->
                                    <img class="img-thumbnail" id="img-preview">
                                </div>
                            </div>
                            
                        </div>

                    </div>

                    
                    
                   
                    
                    <button class="btn btn-primary" type="button" onclick="registerCategoria(event)" id="btnAccion">Guardar</button>
                    
                    
                    
                </form>
            </div>
        </div>
    </div>
</div>





<?php include "Views/Templates/footer.php" ?>