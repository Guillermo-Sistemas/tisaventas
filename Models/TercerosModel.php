<?php
    class TercerosModel extends Query{

        private $documento, $nombre, $telefono, $direccion, $ciudad, $tipo, $id, $estado;
        



        public function __construct()
        {
            parent::__construct();   
        }
        public function getTercero(int $id)
        {
            $sql="SELECT * FROM terceros WHERE id='$id' ";
            $data=$this->select($sql);
            return $data;
        }

        public function getTerceros()
        {
            $sql="SELECT t.id, t.documento, t.nombre, t.telefono, t.direccion,
                  t.ciudad, t.id_tipo, t.estado, p.id as id_tipo, p.nombre_tipos 
                  FROM terceros t INNER JOIN tipos p 
                  WHERE t.id_tipo=p.id ";
            $data=$this->selectAll($sql);
            return $data;
        }

        public function getTipos()
        {
            $sql="SELECT * FROM tipos ";
            $data=$this->selectAll($sql);
            return $data;
        }

        public function registrarTercero(string $documento, string $nombre, string $telefono, string $direccion, 
                                        string $ciudad, int $tipo)
        {
            $this->documento = $documento;
            $this->nombre = $nombre;
            $this->telefono = $telefono;
            $this->direccion = $direccion;
            $this->ciudad = $ciudad;
            $this->tipo = $tipo;  
            $verificar = "SELECT * FROM terceros WHERE documento= '$this->documento'";
            $existe = $this->select($verificar);
            if (empty($existe)){
                $sql = "INSERT INTO terceros(documento, nombre, telefono, direccion, ciudad, id_tipo)
                        VALUES (?,?,?,?,?,?)";
                $datos = array($this->documento, $this->nombre, $this->telefono,  
                            $this->direccion, $this->ciudad, $this->tipo);
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



        public function modificarTercero(string $documento, string $nombre, string $telefono, 
                        string $direccion, string $ciudad, int $tipo, int $id)
        {
            $this->documento = $documento;
            $this->nombre = $nombre;
            $this->telefono = $telefono;
            $this->direccion = $direccion;
            $this->ciudad = $ciudad;
            $this->id = $id;
            $this->tipo = $tipo;  
            
            
                $sql = "UPDATE terceros SET documento=?, nombre=?, telefono=? , direccion=?,
                        ciudad=?, id_tipo=? WHERE id=?";
                $datos = array($this->documento, $this->nombre, $this->telefono,
                         $this->direccion, $this->ciudad, $this->tipo, $this->id);
                $data = $this->save($sql, $datos);
                if ($data==1){
                    $res = "modificado";
                }else{
                    $res = "error";
                }
            
            return $res;
        }

        public function editarTercero(int $id)
        {
            $sql = "SELECT * FROM terceros WHERE id = $id";
            $data = $this->select($sql);
            return $data;
        }

        public function accionTercero(int $estado, int $id)
        {
            $this->id = $id;
            $this->estado = $estado;
            $sql = "UPDATE terceros SET estado = ? WHERE id = ?";
            $datos = array($this->estado, $this->id);
            $data = $this->save($sql, $datos);
            return $data;
        }

        
}
?>