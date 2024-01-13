<?php
    require_once "Connection.php";
    global $name, $email, $usrName, $lastname, $usrEmail, $phone, $password, $state, $addressStreet, $city, $admin;

    if(isset($_POST['btnSubmit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];

        $sql = mysqli_query($connection, "SELECT * FROM users WHERE name='$name' AND email='$email'");
        while ($data = mysqli_fetch_assoc($sql)) {
            $usrName = $data['name'];
            $lastname = $data['lastname'];
            $usrEmail = $data['email'];
            $phone = $data['phone'];
            $password = $data['password'];
            $state = $data['state'];
            $addressStreet = $data['addressStreet'];
            $city = $data['city'];
            $admin = $data['admin'];
        }
    }

    if(isset($_POST['btnChange'])){
        $newName = $_POST['name'];
        $newLastname = $_POST['lastname'];
        $newEmail = $_POST['email'];
        $newPhone = $_POST['phone'];
        $newState = $_POST['state'];
        $newAddressStreet = $_POST['addressStreet'];
        $newCity = $_POST['city'];
        $newAdmin = $_POST['admin'];
        $oldName = $_POST['oldName'];
        $oldPassword = $_POST['password'];

        $sqlInsert = mysqli_query($connection, "UPDATE users SET name='$newName', lastname='$newLastname', email ='$newEmail', phone ='$newPhone', password='$oldPassword', state ='$newState', addressStreet ='$newAddressStreet', city ='$newCity', admin ='$newAdmin' WHERE name ='$oldName'");
            /*$sql2 = mysqli_query($connection, "CREATE TRIGGER bitacora_usuariosUPDATE
                AFTER UPDATE ON users
                FOR EACH ROW
                BEGIN
                INSERT INTO bitacora_usuarios (Fecha, Sentencia, Contrasentencia)
                VALUES (NOW(), 
                        CONCAT('UPDATE users SET name = \'',NEW.name, '\',phone = ',NEW.phone,'\',email=\'',NEW.email,'\';'),
                        CONCAT('DELETE FROM users WHERE name = ', NEW.name)
                );
                    IF ROW_COUNT() = 0 THEN
                        SIGNAL SQLSTATE '45000'
                        SET MESSAGE_TEXT = 'Error: El trigger no insertó en bitacora_productoUPDATE';
                    END IF;
                END;
                ");*/
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/addProduct.css">
    <link rel="shortcut icon" href="Images/logoIcon.png" />
    <title>Modificar - Saloc</title>
</head>
<body>
<header>
        <div class="logoBar">
            <a href="index.html"><img src="Images/logoSaloc2.png" alt="Saloc"/></a>
        </div>
        <nav>
            <ul>
                <li><a href="index.html">Inicio</a></li>
                <li><a href="Registration.html">Registro</a></li>
                <li><a href="#">Productos</a>
                    <ul>
                        <li><a href="Clothes.html">Ropa</a></li>
                        <li><a href="Shoes.html">Zapatos</a></li>
                        <li><a href="Jewelry.html">Joyería</a></li>
                    </ul>
                </li>
                <li><a href="#">Login</a></li>
                <li><a href="#">Salir</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <form action="" method="post">
            <h1>Modifique un producto</h1>
            <div class="divForms">

                <label for="name">Nombre: </label>
                <input type="text" name="name" id="name" value="<?php echo $usrName; ?>" required>
    
                <label for="lastname">Apellido: </label>
                <input type="text" name="lastname" id="lastname" value="<?php echo $lastname;?>" required>

                <label for="email">email: </label>
                <input name="email" id="email" value="<?php echo $usrEmail;?>" required>

                <label for="phone">Teléfono: </label>
                <input type="number" name="phone" id="phone" value="<?php echo $phone;?>">

                <label for="state">Estado: </label>
                <input type="text" name="state" id="state" value="<?php echo $state; ?>" required">

                <label for="addressStreet">Calle: </label>
                <input type="text" name="addressStreet" id="addressStreet" value="<?php echo $addressStreet; ?>" required">

                <label for="city">Ciudad: </label>
                <input type="text" name="city" id="city" value="<?php echo $city; ?>" required">

                <label for="admin">Administrador: </label>
                <div class="sizeDiv">
                    <label for="admin">Si </label>
                    <input type="checkbox" name="admin[]" id="admin" value="1" <?php if($admin == 1){echo "checked";} ?>>

                    <label for="user">No </label>
                    <input type="checkbox" name="admin[]" id="user" value="0" <?php if($admin == 0){echo "checked";} ?>>
                </div>
            </div>
            <input type="text" name="oldName" id="oldName" value="<?php echo $usrName; ?>" style="display: none;">
            <input type="text" name="password" id="password" value="<?php echo $password; ?>" style="display: none;">
            <div>
                <button type="submit" name="btnChange">Modificar</button>
            </div>
        </form>
        <?php mysqli_close($connection);?>
    </main>
    <footer>
        <div class="divContact">
            <img src="Images/logoSaloc2.png" alt="Saloc">
            <p><span>Nombre: </span>Salcedo Monroy Joshua David 22110109 4P</p>
            <p><span>Correo: </span>a22110109@ceti.mx</p>
            <p><span>Materia: </span>Programación WEB - Bases de datos</p>
            <p><span>Ubicación: </span><a href="https://goo.gl/maps/JqHEX1eEVCcDfjn58">Jalisco Mexico</a></p>
        </div>
        <div class="divInfo">
            <p>Esta es una pagina para el proyecto integrador de Programación web I y Base de datos I que comprender 
                la creación del frontEnd y BackEnd sin la ayuda de ninguno framework o librería que facilite ninguno de estos ámbitos. 
                Para el aparatado de frontEnd se utilizo html y css solamente, para el apartado de backEnd se utilizo php y como base de datos mysql</p>
        </div>
    </footer>
</body>
</html>