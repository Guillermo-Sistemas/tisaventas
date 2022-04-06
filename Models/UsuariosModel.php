<?php
    class UsuariosModel extends Query{

        private $usuario, $nombre, $clave, $rol, $id, $estado;
        



        public function __construct()
        {
            parent::__construct();   
        }
        public function getUsuario(string $usuario, string $clave)
        {
            $sql="SELECT * FROM usuarios WHERE usuario='$usuario' AND clave='$clave' ";
            $data=$this->select($sql);
            return $data;
        }

        public function getUsuarios()
        {
            $sql="SELECT u.id, u.usuario, u.nombre,
                  u.id_rol, u.estado, r.id as id_rol, r.nombre_rol 
                  FROM usuarios u INNER JOIN roles r 
                  WHERE u.id_rol=r.id ";
            $data=$this->selectAll($sql);
            return $data;
        }

        public function getRoles()
        {
            $sql="SELECT * FROM roles ";
            $data=$this->selectAll($sql);
            return $data;
        }

        public function registrarUsuario(string $usuario, string $nombre, string $clave, int $rol)
        {
            $this->usuario = $usuario;
            $this->nombre = $nombre;
            $this->clave = $clave;
            $this->rol = $rol;  
            $verificar = "SELECT * FROM usuarios WHERE usuario= '$this->usuario'";
            $existe = $this->select($verificar);
            if (empty($existe)){
                $sql = "INSERT INTO usuarios(usuario, nombre, clave, id_rol) VALUES (?,?,?,?)";
                $datos = array($this->usuario, $this->nombre, $this->clave, $this->rol);
                $data = $this->save($sql, $datos);
                if ($data==1){
                    $res = "ok";
                }else{
                    $res = "error";
                }
            }else{
                $res = "existe";
            }
            
            return $res;
        }



        public function modificarUsuario(string $usuario, string $nombre, int $rol, int $id)
        {
            $this->usuario = $usuario;
            $this->nombre = $nombre;
            $this->id = $id;
            $this->rol = $rol;  
            
            
                $sql = "UPDATE usuarios SET usuario=?, nombre=?, id_rol=? WHERE id=?";
                $datos = array($this->usuario, $this->nombre, $this->rol, $this->id);
                $data = $this->save($sql, $datos);
                if ($data==1){
                    $res = "modificado";
                }else{
                    $res = "error";
                }
            
            return $res;
        }

        public function editarUser(int $id)
        {
            $sql = "SELECT * FROM usuarios WHERE id = $id";
            $data = $this->select($sql);
            return $data;
        }

        public function accionUser(int $estado, int $id)
        {
            $this->id = $id;
            $this->estado = $estado;
            $sql = "UPDATE usuarios SET estado = ? WHERE id = ?";
            $datos = array($this->estado, $this->id);
            $data = $this->save($sql, $datos);
            return $data;
        }

        
}
?>