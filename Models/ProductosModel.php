<?php
    class ProductosModel extends Query{

        private $codigo, $nombre, $valor_compra, $valor_venta, $cantidad, $categoria, $id, $estado;
        



        public function __construct()
        {
            parent::__construct();   
        }
        public function getProducto(int $id)
        {
            $sql="SELECT * FROM productos WHERE id='$id' ";
            $data=$this->select($sql);
            return $data;
        }

        public function getProductos()
        {
            $sql="SELECT p.id, p.codigo, p.nombre, p.valor_compra, 
                    p.valor_venta, p.cantidad, p.estado, c.nombre as nombre_categoria  
                  FROM productos p INNER JOIN categorias c 
                  WHERE p.id_categoria=c.id ";
            $data=$this->selectAll($sql);
            return $data;
        }

        public function getCategorias()
        {
            $sql="SELECT * FROM categorias ";
            $data=$this->selectAll($sql);
            return $data;
        }

        public function registrarProducto(string $codigo, string $nombre, float $valor_compra,
                        float $valor_venta, int $cantidad, int $categoria)
        {
            $this->codigo = $codigo;
            $this->nombre = $nombre;

            
            $this->valor_compra = $valor_compra;
            $this->valor_venta = $valor_venta;
            $this->cantidad = $cantidad;
            $this->categoria = $categoria;  
            $verificar = "SELECT * FROM productos WHERE nombre= '$this->nombre'";
            $existe = $this->select($verificar);
            if (empty($existe)){
                $sql = "INSERT INTO productos(codigo, nombre, valor_compra,
                        valor_venta, cantidad, id_categoria)
                        VALUES (?,?,?,?,?,?)";
                $datos = array($this->codigo, $this->nombre, $this->valor_compra,  
                            $this->valor_venta, $this->cantidad, $this->categoria);
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



        public function modificarProducto(string $codigo, string $nombre, float $valor_compra,
                        float $valor_venta, int $cantidad, int $categoria, int $id)
        {
            $this->codigo = $codigo;
            $this->nombre = $nombre;

            
            $this->valor_compra = $valor_compra;
            $this->valor_venta = $valor_venta;
            $this->cantidad = $cantidad;
            $this->categoria = $categoria; 
            $this->id = $id;  
            
            
                $sql = "UPDATE productos SET codigo=?, nombre=?, valor_compra=? , valor_venta=?,
                        cantidad=?, id_categoria=? WHERE id=?";
                $datos = array($this->codigo, $this->nombre, $this->valor_compra,  
                        $this->valor_venta, $this->cantidad, $this->categoria, $this->id);
                $data = $this->save($sql, $datos);
                if ($data==1){
                    $res = "modificado";
                }else{
                    $res = "error";
                }
            
            return $res;
        }

        public function editarProducto(int $id)
        {
            $sql = "SELECT * FROM productos WHERE id = $id";
            $data = $this->select($sql);
            return $data;
        }

        public function accionProducto(int $estado, int $id)
        {
            $this->id = $id;
            $this->estado = $estado;
            $sql = "UPDATE productos SET estado = ? WHERE id = ?";
            $datos = array($this->estado, $this->id);
            $data = $this->save($sql, $datos);
            return $data;
        }

        
}
?>