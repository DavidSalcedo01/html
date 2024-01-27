<?php
require('Library/fpdf/fpdf.php');
require_once "Connection.php";
include 'emailSender.php';


    session_start();
    global $subTotal, $total;
    if(!isset($_SESSION['user'])){
        header("Location: login.html");
    }
    else{
        if(isset($_POST['btnSubmit']))
        {   
            $user = $_SESSION['user'];
            $subTotal = $_POST['subtotal'];
            $total = $_POST['total'];

            $sql = mysqli_query($connection, "SELECT * FROM `users` WHERE email='$user'");
            $data = mysqli_fetch_assoc($sql);
        
            $sqlProduct = mysqli_query($connection, "SELECT * FROM sales WHERE costumerUser='$user'");
            ob_start();
        }
    }


class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        $this->SetFillColor(105, 75, 52);
        $this->Rect(0, 0, $this->w, 15, 'F');
    }


    // Pie de página
    function Footer()
    {
        $this->SetFillColor(105, 75, 52);
        $this->Rect(0, 177, $this->w, 15, 'F');
    }
}




$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Ln(26);  
$pdf->Image('Images/logoSaloc2.png', 93, 24, 18);
$pdf->MultiCell(0, 5, utf8_decode('Agradecemos sinceramente su compra y confianza en nuestros productos. Estamos encantados de que haya elegido nuestro producto y esperamos que satisfaga todas sus necesidades. Siempre nos esforzamos por ofrecer la mejor calidad y servicio, y su apoyo nos motiva a seguir mejorando. ¡Gracias de nuevo por ser parte de nuestra comunidad de clientes!'));

// Agregar título centrado
$pdf->Ln(10);  
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(105, 75, 52);
$pdf->Cell(0, 10, 'Resumen de Compra', 0, 1, 'C');

// Agregar subtítulos
$pdf->Ln(3); 
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(0, 67, 70);
$pdf->Cell(0, 10, 'Datos Personales', 0, 1, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0, 0, 0);
$pdf->MultiCell(0, 5, 'Nombre: '.$data['name'].' '.$data['lastname'].'
Correo: '.$data['email'].'
Telefono: '.$data['phone'].'
Estado: '.$data['state'].'
Calle: '.$data['addressStreet'].'
Ciudad: '.$data['city']);

$pdf->Ln(4);  
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(0, 67, 70);
$pdf->Cell(0, 10, 'Productos Comprados', 0, 1, 'L');
$pdf->SetFillColor(0, 67, 70);  // Fondo azul para títulos
$pdf->SetTextColor(255);  // Texto blanco para títulos
$pdf->SetDrawColor(105, 75, 52);  // Líneas divisorias color café

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(40, 9, 'Nombre Producto', 1, 0, 'C', 1);
$pdf->Cell(30, 9, 'Precio', 1, 0, 'C', 1);
$pdf->Cell(30, 9, 'Cantidad', 1, 0, 'C', 1);
$pdf->Cell(30, 9, 'Subtotal', 1, 1, 'C', 1);
$pdf->SetFillColor(211, 211, 211); 

$pdf->SetTextColor(0);
$pdf->SetFont('Arial', '', 11);

while ($dataP = mysqli_fetch_assoc($sqlProduct)) {
    $pdf->Cell(40, 10, utf8_decode($dataP['productName']), 1);
    $pdf->Cell(30, 10, $dataP['price'], 1);
    $pdf->Cell(30, 10, $dataP['amount'], 1);
    $pdf->Cell(30, 10, $dataP['amount']*$dataP['price'], 1, 1);
}

$pdf->SetFillColor(255, 255, 255);
$pdf->SetDrawColor(255, 255, 255);
$pdf->Cell(40, 9, '', 1, 0, 'C', 1);
$pdf->Cell(30, 9, '', 1, 0, 'C', 1);
$pdf->SetDrawColor(105, 75, 52);
$pdf->SetFillColor(211, 211, 211); 
$pdf->Cell(30, 9, 'Total', 1, 0, 1);
$pdf->Cell(30, 9, $total, 1, 0, 1);

$pdfFile = 'ComprobanteSaloc.pdf';
$pdf->Output($pdfFile, 'F');

sendEmail($pdfFile);
mysqli_close($connection);
?>