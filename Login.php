<?php
    require_once "Connection.php";

    if(isset($_POST['btnSubmit']))
    {
        $user = $_POST['email'];
        $password = $_POST['password'];
    
        $sql = mysqli_query($connection, "SELECT * FROM `users` WHERE email='$user'");
        $res = mysqli_fetch_array($sql, MYSQLI_ASSOC);

        
    
        if ($res) {
            if (password_verify($password, $res['password'])) {
    
                if ($res['admin'] == 1) {
                    echo '<h1 style="color: blue; font-weight: bold; text-align: center;">Administrador correcto</h1>';
                    header("Location: adminDashBoard.html");
                } else {
                    session_start();
                    $_SESSION['user'] = $user;
                    echo '<h1 style="color: green; font-weight: bold; text-align: center;">Usuario correcto</h1>';
                    header("Location: index.html");
                }
            } else {
                echo '<h1 style="color: red; font-weight: bold; text-align: center;">Usuario incorrecto</h1>';
            }
        } else {
            echo "<br><h1>Usuario invalido</h1>";
            //echo "Error". $sql. "<br>".mysqli_error($connection);
        }
    }
    mysqli_close($connection);
?>