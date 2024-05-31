<?php  

    class ControladorIndex{

        public function ConsultarSecciones($bd){
            $sql = "SELECT * from seccion;";
    
            $stmt = $bd->prepare($sql);
    
            $stmt->execute();        
            
            $resultado = $stmt->get_result();
    
            return $resultado;
        }  

        public function ConsultarCategorias($bd,$id){
            $sql = "SELECT * from categorias where idseccion = ?;";

            $stmt = $bd->prepare($sql);

            $stmt->bind_param("i",
            $id
            );

            $stmt->execute();        
            
            $resultado = $stmt->get_result();

            return $resultado;
        } 

        public function ConsultarSubCategorias($bd,$id){
            $sql = "SELECT * from subcategorias where idcategoria = ?;";

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