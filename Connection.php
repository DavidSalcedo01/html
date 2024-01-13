<?php 
    $SERVER_NAME = "localhost";
    $DATABASE = "globalweb";
    $USERNAME = "root";
    $PASSWORD = "";

    $connection = mysqli_connect($SERVER_NAME, $USERNAME, $PASSWORD, $DATABASE);

    if(!$connection)
    {
        die("Fallo la conexión". mysqli_connect_error());
    }
    else
    {
        //echo "Conexión exitosa";
    }

?>