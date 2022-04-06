<?php
class Terceros extends Controller{

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
        $data['tipos'] = $this->model->getTipos();
        $this->views->getView($this, "index", $data);
    }
    
    
    public function listar()
    {
        $data = $this->model->getTerceros();

        for($i=0; $i < count($data); $i++){
            if($data[$i]['estado'] == 1){
                $data[$i]['estado'] = '<div><span class="badge badge-success">Activo</span></div>';

                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarTercero('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarTercero('.$data[$i]['id'].');"><i class="fas fa-trash-alt"></i></button>
                <div/>';
            }else{
                $data[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';

                $data[$i]['acciones'] = '<div>
               <button class="btn btn-success" type="button" onclick="btnReactivarTercero('.$data[$i]['id'].');"><i class="fa fa-check"></i></i></button>
                <div/>';
            }
            
           
            
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }


    /*public function validar()
    {
       if (empty($_POST['usuario']) || empty($_POST['clave'])){
           $msg = "Campos Vacios";
       }else{
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];
            $hash = hash("SHA256", $clave);
            $data = $this->model->getUsuario($usuario, $hash);

            if($data){
                $_SESSION['id'] = $data['id'];
                $_SESSION['usuario'] = $data['usuario'];
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['activo'] = true;
                $msg = "ok";
            }else{
                $msg = "Usuario o contraseña Incorrecta";
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }*/

    public function registrar()
    {
        $documento = $_POST['documento'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $ciudad = $_POST['ciudad'];
        $tipo = $_POST['tipo'];
        //$estado = $_POST['estado'];
        $id = $_POST['id'];
        

        
        if (empty($documento) || empty($nombre) ){
            $msg = "Los campos Documento y Nombre son Obligatorios";
        }else {
            if ($id == ""){

                
                    $data = $this->model->registrarTercero($documento, $nombre, $telefono,
                        $direccion, $ciudad, $tipo);
                    if ($data=="ok"){
                        $msg = "si";
                    }else if($data == "existe"){
                        $msg = "El Tercero ya Existe";
                    }else{
                        $msg = "Error al registrar el Tercero";   
                    }
                
            }else{
                $data = $this->model->modificarTercero($documento, $nombre, $telefono, $direccion,
                                     $ciudad, $tipo, $id);
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
       $data = $this->model->editarTercero($id);
       echo json_encode($data, JSON_UNESCAPED_UNICODE);
       die();
       
    }

    public function eliminar (int  $id){
        $data = $this->model->accionTercero(0, $id);
       if ($data == 1){
           $msg = "ok";
       }else{
            $msg = "Error al Eliminar el Tercero";
       }
       echo json_encode($msg, JSON_UNESCAPED_UNICODE);
       die();
    }

    public function reactivar (int  $id){
        $data = $this->model->accionTercero(1, $id);
       if ($data == 1){
           $msg = "ok";
       }else{
            $msg = "Error al Reactivar el Tercero";
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