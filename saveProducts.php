<?php
    require_once "Connection.php";
    date_default_timezone_set('America/Mexico_city');
    if(isset($_POST['btnSubmit']))
    {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $amount = $_POST['amount'];
        $date = date("Y-m-d H:i:s");
        global $sizesC, $sizeS, $flagC, $flagS, $imageNewName;

        if(isset($_POST['sizeC']))
        {
             foreach($_POST['sizeC'] as $value)
             {
                $sizesC = $sizesC.' '.$value;
             }
             $flagC = 1;
        }
        
        if(isset($_POST['sizeS']))
        {
             foreach($_POST['sizeS'] as $value)
             {
                $sizeS = $sizeS.' '.$value;
             }
             $flagS = 1;
        }

        $image = $_FILES['picture'];
        $imageName = $_FILES['picture']['name'];
        $imageTmpName = $_FILES['picture']['tmp_name'];
        $imageSize = $_FILES['picture']['size'];
        $imageError = $_FILES['picture']['error'];
        $imageType = $_FILES['picture']['type'];

        $imageExt = explode('.', $imageName);
        $imageActualExt = strtolower(end($imageExt));
        $allowedExt = array('jpg','jpeg','png');
        
        if(in_array($imageActualExt, $allowedExt)){
            if($imageError === 0){
                if($imageSize < 1000000){
                    $imageNewName = uniqid('', true).".".$imageActualExt;
                    if($flagC == 1){
                        $imageDest = 'Images/Clothes/'.$imageNewName;
                        move_uploaded_file($imageTmpName, $imageDest);
                        echo '<h1 style="color: green; font-weight: bold; text-align: center;">imagen subida en ropa</h1>';
                    }
                    elseif($flagS == 1){
                        $imageDest = 'Images/Shoes/'.$imageNewName;
                        move_uploaded_file($imageTmpName, $imageDest);
                        echo '<h1 style="color: green; font-weight: bold; text-align: center;">imagen subida en zapatos</h1>';
                    }
                    else{
                        $imageDest = 'Images/Jewelry/'.$imageNewName;
                        move_uploaded_file($imageTmpName, $imageDest);
                        echo '<h1 style="color: green; font-weight: bold; text-align: center;">imagen subida en joyería</h1>';
                    }
                }
                else{
                    echo '<h1 style="color: red; font-weight: bold; text-align: center;">El archivo es demasiado pesado</h1>';
                }
            }
            else{
                echo '<h1 style="color: red; font-weight: bold; text-align: center;">Ocurrió un error al subir el archivo</h1>';
            }
        }
        else{
            echo '<h1 style="color: red; font-weight: bold; text-align: center;">No se puede subir un archivo de este tipo</h1>';
        }

        
        if($flagC == 1)
        {
            $sql = mysqli_query($connection, "SELECT * FROM clothes WHERE productName='$name' AND price='$price'");
        }
        elseif($flagS == 1)
        {
            $sql = mysqli_query($connection, "SELECT * FROM shoes WHERE productName='$name' AND price='$price'");
        }
        else
        {
            $sql = mysqli_query($connection, "SELECT * FROM jewelry WHERE productName='$name' AND price='$price'");
        }
        
        $res = mysqli_num_rows($sql);

        if($res == 1)
        {
            echo '<h1 style="color: red; font-weight: bold; text-align: center;">Ya existe un producto con estas características</h1>';
        }
        else
        {   
            if($flagC == 1)
            {
                $sqlInsert = mysqli_query($connection, "INSERT INTO clothes (productName,price,ProductAmount,sizes,date,description,image) VALUES ('$name','$price','$amount','$sizesC','$date','$description','$imageNewName')");
                header("Location: adminDashBoard.html");
            }
            elseif($flagS == 1)
            {
                $sql = mysqli_query($connection, "INSERT INTO shoes (productName,price,ProductAmount,sizes,date,description,image) VALUES ('$name','$price','$amount','$sizeS','$date','$description','$imageNewName')");
                header("Location: adminDashBoard.html");
            }
            else
            {
                $sql = mysqli_query($connection, "INSERT INTO jewelry (productName,price,ProductAmount,date,description,image) VALUES ('$name','$price','$amount','$date','$description','$imageNewName')");
                /*$sql2 = mysqli_query($connection, "CREATE TRIGGER bitacora_productos
                        AFTER INSERT ON jewelry
                        FOR EACH ROW
                        BEGIN
                        INSERT INTO bitacora_productos (Fecha, Sentencia, Contrasentencia)
                        VALUES (NOW(), 
                                CONCAT('INSERT INTO jewelry (productName,price,description) VALUES (\'', NEW.productName, '\', \'', NEW.price, '\', ', NEW.description, ');'),
                                CONCAT('DELETE FROM jewelry WHERE productName = ', NEW.productName)
                        );
                            IF ROW_COUNT() = 0 THEN
                                SIGNAL SQLSTATE '45000'
                                SET MESSAGE_TEXT = 'Error: El trigger no insertó en bitacora_producto';
                            END IF;
                        END;
                        ");*/
                header("Location: adminDashBoard.html");
            }
        }
    }
    mysqli_close($connection);
?>