<?php
class Usuarios extends Controller{

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
        $data['roles'] = $this->model->getRoles();
        $this->views->getView($this, "index", $data);
    }
    
    
    public function listar()
    {
        $data = $this->model->getUsuarios();

        for($i=0; $i < count($data); $i++){
            if($data[$i]['estado'] == 1){
                $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';

                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarUser('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarUser('.$data[$i]['id'].');"><i class="fas fa-trash-alt"></i></button>
                <div/>';
            }else{
                $data[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';

                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReactivarUser('.$data[$i]['id'].');"><i class="fa fa-check"></i></i></button>
                <div/>';
            }
            
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function validar()
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
    }

    public function registrar()
    {
        $usuario = $_POST['usuario'];
        $nombre = $_POST['nombre'];
        $clave = $_POST['clave'];
        $confirmar = $_POST['confirmar'];
        $rol = $_POST['rol'];
        $id = $_POST['id'];

        $hash = hash("SHA256", $clave);
        
        if (empty($usuario) || empty($nombre) || empty($rol) ){
            $msg = "Todos los campos son Obligatorios";
        }else {
            if ($id == ""){

                if($clave != $confirmar){
                    $msg = "Las contraseñas no coinciden";   
                }else{
                    $data = $this->model->registrarUsuario($usuario, $nombre, $hash, $rol);
                    if ($data=="ok"){
                        $msg = "si";
                    }else if($data == "existe"){
                        $msg = "El Usuario ya Existe";
                    }else{
                        $msg = "Error al registrar el Usuario";   
                    }
                }
            }else{
                $data = $this->model->modificarUsuario($usuario, $nombre, $rol, $id);
                if ($data=="modificado"){
                    $msg = "modificado";
                }else {
                    $msg = "Error al modificar el Usuario";   
                }
            }
            
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        
        die();
    }

    public function editar (int $id)
    {
       $data = $this->model->editarUser($id);
       echo json_encode($data, JSON_UNESCAPED_UNICODE);
       die();
       
    }

    public function eliminar (int  $id){
        $data = $this->model->accionUser(0, $id);
       if ($data == 1){
           $msg = "ok";
       }else{
            $msg = "Error al Eliminar el usuario";
       }
       echo json_encode($msg, JSON_UNESCAPED_UNICODE);
       die();
    }

    public function reactivar (int  $id){
        $data = $this->model->accionUser(1, $id);
       if ($data == 1){
           $msg = "ok";
       }else{
            $msg = "Error al Reingresar el usuario";
       }
       echo json_encode($msg, JSON_UNESCAPED_UNICODE);
       die();
    }


    public function salir(){
        session_destroy();
        header("location: ".base_url);
    }

}


?>