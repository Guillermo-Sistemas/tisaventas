<?php
class Categorias extends Controller{

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
        
        $this->views->getView($this, "index");
    }
    
    
    public function listar()
    {
        $data = $this->model->getCategorias();

        for($i=0; $i < count($data); $i++){

            $data[$i]['imagen'] = '<img class="img-thumbnail" src="'.base_url."Assets/img/".$data[$i]['imagen'].'" width="100">';

            if($data[$i]['estado'] == 1){
                $data[$i]['estado'] = '<div><span class="badge badge-success">Activo</span></div>';

                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarCategoria('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarCategoria('.$data[$i]['id'].');"><i class="fas fa-trash-alt"></i></button>
                <div/>';
            }else{
                $data[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';

                $data[$i]['acciones'] = '<div>
               <button class="btn btn-success" type="button" onclick="btnReactivarCategoria('.$data[$i]['id'].');"><i class="fa fa-check"></i></i></button>
                <div/>';
            }
            
           
            
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }


    
    public function registrar()
    {
        
        $nombre = $_POST['nombre'];
        $id = $_POST['id'];
        
        $img = $_FILES['imagen'];
        $name = $img['name'];
        $tmpname = $img['tmp_name'];
        

       $fecha = date("YmdHis");
        

        
        if (empty($nombre) ){
            $msg = "El Campo Nombre es Obligatorio";
        }else {

            if (!empty($name)){
                $imgNombre = $fecha . ".jpg";
                $destino = "Assets/img/".$imgNombre;
            }else if (!empty($_POST['foto_actual']) && empty($name)){
                $imgNombre = $_POST['foto_actual'];
            }else{
                $imgNombre = "default.jpg";
            }
            
            if ($id == ""){

                
                    $data = $this->model->registrarCategoria($nombre, $imgNombre);
                    if ($data=="ok"){
                        if (!empty($name)){
                            move_uploaded_file($tmpname, $destino);
                        }
                        $msg = "si";
                        
                    }else if($data == "existe"){
                        $msg = "La Categoria ya Existe";
                    }else{
                        $msg = "Error al registrar la Categoria";   
                    }
                
            }else{

                $imgDelete = $this->model->editarCategoria($id);
                if($imgDelete['imagen'] != 'default.jpg' || $imgDelete['imagen'] !="" ){
                    if (file_exists("Assets/img/" .$imgDelete['imagen'])){
                        unlink("Assets/img/" . $imgDelete['imagen']);
                    }
                }
                $data = $this->model->modificarCategoria($nombre, $imgNombre, $id);
                    if ($data=="modificado"){
                        if (!empty($name)){
                            move_uploaded_file($tmpname, $destino);
                        }
                        $msg = "modificado";
                    }else {
                        $msg = "Error al modificar la Categoria";   
                    }
                
            }
            
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        
        die();
    }

    public function editar (int $id)
    {
       $data = $this->model->editarCategoria($id);
       echo json_encode($data, JSON_UNESCAPED_UNICODE);
       die();
       
    }

    public function eliminar (int  $id){
        $data = $this->model->accionCategoria(0, $id);
       if ($data == 1){
           $msg = "ok";
       }else{
            $msg = "Error al Eliminar la Categoria";
       }
       echo json_encode($msg, JSON_UNESCAPED_UNICODE);
       die();
    }

    public function reactivar (int  $id){
        $data = $this->model->accionCategoria(1, $id);
       if ($data == 1){
           $msg = "ok";
       }else{
            $msg = "Error al Reactivar la Categoria";
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