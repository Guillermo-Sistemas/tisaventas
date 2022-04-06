<?php include "Views/Templates/header.php" ?>

<ol class="breadcrumb mb-4">
    <h1><li class="breadcrumb-item active">Productos</li><h1>
</ol>

<button class="btn btn-primary mb-2" type="button" onclick="frmProducto();">Crear Producto <i class="fas fa-plus"></i></button>

<table class="table table-light" id="tblProductos">
    <thead class="thead-dark">
        <tr>
            <!--th>Id</th>
            <th>Codigo</th-->
            <th>Nombre</th>
            <th>Valor Compra</th>
            <th>Valor Venta</th>
            <th>Stock</th>
            <th>Categoria</th>
            <th>Estado</th>
            <th></th>
            
            
            
        </tr>
    </thead>
    <tbody>
        
    </tbody>
</table>



<div id="nuevo_producto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="title">Nuevo Producto</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmProducto">
                    <div class="form-group">

                        <input type="hidden" id="id" name="id">       

                        <!--label for="codigo" type="hidden">Código</label-->
                        <input id="codigo" class="form-control" type="hidden" name="codigo" placeholder="Código">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre del Producto">
                    </div>
                    
                    <div class="row" id="valores">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="compra">Valor Compra</label>
                                <input id="valor_compra" class="form-control" type="number" name="valor_compra" value="0" placeholder="Valor Compra">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="valor_venta">Valor Venta</label>
                                <input id="valor_venta" class="form-control" type="number" name="valor_venta" value="0" placeholder="Valor venta">
                            </div>
                        </div>
                        
                    </div>
                    

                    <div class="row" id="cancate">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cantidad">Cantidad</label>
                                <input id="cantidad" class="form-control" type="number" name="cantidad" value="0" placeholder="Cantidad">
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                <label for="categoria">Categoria</label>
                                <select id="categoria" class="form-control" name="categoria">
                                <?php foreach ($data['categorias'] as $row) { ?>
                                    <option value="<?php echo $row['id'];?>"><?php echo $row['nombre'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    
                    


                    
                    
                    <button class="btn btn-primary" type="button" onclick="registerProducto(event)" id="btnAccion">Registrar</button>
                    
                    
                    
                </form>
            </div>
        </div>
    </div>
</div>





<?php include "Views/Templates/footer.php" ?>