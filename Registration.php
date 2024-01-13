<?php
    require_once "Connection.php";
    if(isset($_POST['btnSubmit']))
    {
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 5]);
        $state = $_POST['state'];
        $addresStreet = $_POST['addresStreet'];
        $city = $_POST['city'];
    
        $sql = mysqli_query($connection, "SELECT * FROM users WHERE email='$email'");
        $res = mysqli_num_rows($sql);
    
        if ($res == 1) {
            echo '<h1 style="color: red; font-weight: bold; text-align: center;">Ya existe un usuario con este correo</h1>';
        } else {
    
            $sqlInsert = mysqli_query($connection, "INSERT INTO users (name,lastName,email,phone,password,state,addressStreet,city,admin) VALUES ('$name','$lastname', '$email', '$phone', '$password', '$state', '$addresStreet', '$city', '0')");
            /*$sql2 = mysqli_query($connection, "CREATE TRIGGER bitacora_usuarios
                        AFTER INSERT ON users
                        FOR EACH ROW
                        BEGIN
                        INSERT INTO bitacora_usuarios (Fecha, Sentencia, Contrasentencia)
                        VALUES (NOW(), 
                                CONCAT('INSERT INTO users (name,phone,email) VALUES (\'', NEW.name, '\', \'', NEW.phone, '\', ', NEW.email, ');'),
                                CONCAT('DELETE FROM users WHERE email = ', NEW.email)
                        );
                            IF ROW_COUNT() = 0 THEN
                                SIGNAL SQLSTATE '45000'
                                SET MESSAGE_TEXT = 'Error: El trigger no insertó en bitacora_producto';
                            END IF;
                        END;
                        ");*/
    
            if ($sqlInsert) {
                echo '<h1 style="color: green; font-weight: bold; text-align: center;">Usuario registrado</h1>';
                //header("Location: index.html");
            } else {
                echo "Error" . $sql . "<br>" . mysqli_error($connection);
            }
        }
    }
    mysqli_close($connection);
?>