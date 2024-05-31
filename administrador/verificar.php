<?php
     session_start();
     require_once("conexion.php");
	 
     
	 $user = $_POST["user"];
	 $pass = $_POST["pass"];
	 
	 $sql = "select * from usuarios where user='$user' and pass='$pass'";
	 $res = mysqli_query($con, $sql);
	 $nr = mysqli_num_rows($res);
	 if ($nr>0){         
	     // obtener un array asociativo con el resulset
         $usuario = mysqli_fetch_assoc($res);       	 
		 // creo una variable de sesión	
		 $_SESSION['nombre_usuario'] = $usuario["user"];
		 header("location:dashboard/index.php");
	 }
	 else{
		 echo "<script languaje='javascript'>alert('Usuario/Contraseña no valido')</script>";
		 
	 }
