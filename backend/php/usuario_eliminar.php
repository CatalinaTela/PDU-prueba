<?php

	/*== Almacenando datos ==*/
    $id_user_del=limpiar_cadena($_GET['id_user_del']);

    /*== Verificando usuario ==*/
    $check_usuario=conexion();
    $check_usuario=$check_usuario->query("SELECT id_user FROM usuarios WHERE id_user='$id_user_del'");
    
    if($check_usuario->rowCount()==1){

    		
	    	$eliminar_usuario=conexion();
	    	$eliminar_usuario=$eliminar_usuario->prepare("DELETE FROM usuarios WHERE id_user=:id");

	    	$eliminar_usuario->execute([":id"=>$id_user_del]);

	    	if($eliminar_usuario->rowCount()==1){
		        echo '
		            <div class="notification is-info is-light">
		                <strong>¡USUARIO ELIMINADO!</strong><br>
		                Los datos del usuario se eliminaron con exito
		            </div>
		        ';
		    }else{
		        echo '
		            <div class="notification is-danger is-light">
		                <strong>¡Ocurrio un error inesperado!</strong><br>
		                No se pudo eliminar el usuario, por favor intente nuevamente
		            </div>
		        ';
		    }
		    $eliminar_usuario=null;
    	
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El USUARIO que intenta eliminar no existe
            </div>
        ';
    }
    $check_usuario=null;
