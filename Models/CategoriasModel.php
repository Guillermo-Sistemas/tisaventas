<?php
    class CategoriasModel extends Query{

        private $nombre, $imagen, $id, $estado;
        



        public function __construct()
        {
            parent::__construct();   
        }
        public function getCategoria(int $id)
        {
            $sql="SELECT * FROM categorias WHERE id='$id' ";
            $data=$this->select($sql);
            return $data;
        }

        public function getCategorias()
        {
            $sql="SELECT * FROM categorias ";
            $data=$this->selectAll($sql);
            return $data;
        }

        

        public function registrarCategoria(string $nombre, string $imagen)
        {
            $this->nombre = $nombre;
            $this->imagen = $imagen;
            $verificar = "SELECT * FROM categorias WHERE nombre= '$this->nombre'";
            $existe = $this->select($verificar);
            if (empty($existe)){
                $sql = "INSERT INTO categorias(nombre, imagen)
                        VALUES (?,?)";
                $datos = array($this->nombre, $this->imagen);
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



        public function modificarCategoria(string $nombre, string $imagen, int $id)
        {
            $this->nombre = $nombre;
            $this->imagen = $imagen; 
            $this->id = $id;
             
            
            
                $sql = "UPDATE categorias SET nombre=?, imagen=? WHERE id=?";
                $datos = array($this->nombre, $this->imagen, $this->id);
                $data = $this->save($sql, $datos);
                if ($data==1){
                    $res = "modificado";
                }else{
                    $res = "error";
                }
            
            return $res;
        }

        public function editarCategoria(int $id)
        {
            $sql = "SELECT * FROM categorias WHERE id = $id";
            $data = $this->select($sql);
            return $data;
        }

        public function accionCategoria(int $estado, int $id)
        {
            $this->id = $id;
            $this->estado = $estado;
            $sql = "UPDATE categorias SET estado = ? WHERE id = ?";
            $datos = array($this->estado, $this->id);
            $data = $this->save($sql, $datos);
            return $data;
        }

        
}
?>