<html>
   <head>
    <title>ADMINISTRADOR</title>
    <link href="../css/panel_admin.css" type="text/css" rel="stylesheet">
   </head>   
   <body style="text-align:center">
    <?php
	   session_start();
	?>
     <div class ="header">
     <h2>PANEL ADMINISTRADOR</h2>
	  <h3>Bienvenido sr(a) <?php echo $_SESSION['nombre_usuario'] ?>   </h3>

     </div>
     
      <div class="contenedor2">
     <h2 class="titulo2">Opciones de usuario </h2>  
     <br><br>	
	 <a href='Usuarios/form_guarda_usuario.php'><img src='../resursos/add_user.png' title='crear un usuario' /></a>
	 <a href='Usuarios/form_edita_usuario.php'><img src='../resursos/modify_user.png' title='editar un usuario' /></a>
	 <a href='Usuarios/form_elimina_usuario.php'><img src='../resursos/delete_user.png' title='eliminar un usuario' /></a>
	 <a href='Usuarios/consultaUsuarios.php'><img src='../resursos/search_user.png' title='consultar usuarios' /></a>
	 
   </div>  
   
   
    <div class="contenedor2">   
      <a href='cerrar_sesion.php'><img src='../resursos/logout.png' title='Salir' /></a>
	</div>
   </body>
</html>