<?php
class Productos extends Controller{

    public function __construct()
    {
        session_start();
        
        parent::__construct();
    }

    
    public function index()
    {
        if (empty($_SESSION['activo'])){
            header("location: ".base_url);
        }
        $data['categorias'] = $this->model->getCategorias();
        $this->views->getView($this, "index", $data);
    }
    
    
    public function listar()
    {
        $data = $this->model->getProductos();

        for($i=0; $i < count($data); $i++){
            if($data[$i]['estado'] == 1){
                $data[$i]['estado'] = '<div><span class="badge badge-success">Activo</span></div>';

                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarProducto('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarProducto('.$data[$i]['id'].');"><i class="fas fa-trash-alt"></i></button>
                <div/>';
            }else{
                $data[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';

                $data[$i]['acciones'] = '<div>
               <button class="btn btn-success" type="button" onclick="btnReactivarProducto('.$data[$i]['id'].');"><i class="fa fa-check"></i></i></button>
                <div/>';
            }
            
           
            
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }


   

    public function registrar()
    {
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $valor_compra = $_POST['valor_compra'];
        $valor_venta = $_POST['valor_venta'];
        $cantidad = $_POST['cantidad'];
        $categoria = $_POST['categoria'];
        //$estado = $_POST['estado'];
        $id = $_POST['id'];

       
               
        if (empty($nombre) ){
            $msg = "El Nombre es Obligatorio";
        }else {
            if ($id == ""){

                
                    $data = $this->model->registrarProducto($codigo, $nombre, $valor_compra,
                        $valor_venta, $cantidad, $categoria);
                    if ($data=="ok"){
                        $msg = "si";
                    }else if($data == "existe"){
                        $msg = "El Producto ya Existe";
                    }else{
                        $msg = "Error al registrar el Producto";   
                    }
                
            }else{
                
                $data = $this->model->modificarProducto($codigo, $nombre, $valor_compra,
                        $valor_venta, $cantidad, $categoria, $id);
                if ($data=="modificado"){
                    $msg = "modificado";
                }else {
                    $msg = "Error al modificar el Tercero";   
                }
            }
            
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        
        die();
    }

    public function editar (int $id)
    {
       
       $data = $this->model->editarProducto($id);
       echo json_encode($data, JSON_UNESCAPED_UNICODE);
       die();
       
    }

    public function eliminar (int  $id){
        $data = $this->model->accionProducto(0, $id);
       if ($data == 1){
           $msg = "ok";
       }else{
            $msg = "Error al Eliminar el Producto";
       }
       echo json_encode($msg, JSON_UNESCAPED_UNICODE);
       die();
    }

    public function reactivar (int  $id){
        $data = $this->model->accionProducto(1, $id);
       if ($data == 1){
           $msg = "ok";
       }else{
            $msg = "Error al Reactivar el Producto";
       }
       echo json_encode($msg, JSON_UNESCAPED_UNICODE);
       die();
    }


    public function salir(){
        session_destroy();
        header("location: ".base_url);
    }



}//fin de la clase Terceros


?>