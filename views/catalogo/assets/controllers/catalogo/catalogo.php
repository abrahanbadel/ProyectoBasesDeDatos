<?php  

    class ControladorCatalogo{
        public function ConsultarProductosSubCategorias($bd,$idsubcategoria){
            $sql = "SELECT * from productos where idsubcategoria = ?;";

            $stmt = $bd->prepare($sql);

            $stmt->bind_param("i",
            $idsubcategoria
            );

            $stmt->execute();        
            
            $resultado = $stmt->get_result();

            return $resultado;
        } 
        public function ConsultarimagenesProductos($bd,$id){
            $sql = "SELECT i.* from imagenesproductos ip, imagenes i where ip.idproducto = ? and ip.idimagen = i.id;";

            $stmt = $bd->prepare($sql);

            $stmt->bind_param("i",
            $id
            );

            $stmt->execute();        
            
            $resultado = $stmt->get_result();

            return $resultado;
        }

        public function ConsultarProductosCategorias($bd,$id){
            $sql= "select p.* from productos p, categorias c, subcategorias sc where c.id = ? and sc.idcategoria = c.id and sc.id = p.idsubcategoria;";
            $stmt = $bd->prepare($sql);

            $stmt->bind_param("i",
            $id
            );

            $stmt->execute();        
            
            $resultado = $stmt->get_result();

            return $resultado;
        }

        public function ConsultarProductosSeccion($bd,$id){
            $sql= "select p.* from productos p, categorias c, subcategorias sc, seccion s where s.id =? and sc.idcategoria = c.id and sc.id = p.idsubcategoria and s.id=c.idseccion;";
            $stmt = $bd->prepare($sql);

            $stmt->bind_param("i",
            $id
            );

            $stmt->execute();        
            
            $resultado = $stmt->get_result();

            return $resultado;
        }
    }

?>