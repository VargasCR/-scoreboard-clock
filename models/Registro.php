<?php
namespace Model;

use DateInterval;
use DateTime;
use setasign\Fpdi\Fpdi;
class Registro extends ActiveRecord {
    // Base de Datos
    protected static $table = 'registro';
    protected static $columnsDB= ['id','idempleado','fechaEntrada','fechaSalida','horaSalida','horaEntrada','horasExtra'];
    public $id;
    public $idempleado;
    public $fechaEntrada;
    public $fechaSalida;
    public $horaEntrada;
    public $horaSalida;
    public $horasExtra;
    

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;       
        $this->idempleado = $args['idempleado'] ?? '';       
        $this->fechaEntrada = $args['fechaEntrada'] ?? '';       
        $this->fechaSalida = $args['fechaSalida'] ?? '';       
        $this->horaEntrada = $args['horaEntrada'] ?? '';       
        $this->horaSalida = $args['horaSalida'] ?? '';       
        $this->horasExtra = $args['horasExtra'] ?? 0;
 
    }
    

    public function calcularHorasTrabajadasLocal($fechaEntrada, $horaEntrada, $fechaSalida, $horaSalida)
{
    $fechaEntradaObj = new DateTime($fechaEntrada . ' ' . $horaEntrada);
    $fechaSalidaObj = new DateTime($fechaSalida . ' ' . $horaSalida);

    // Verificar si la fecha de salida es menor que la fecha de entrada (al día siguiente)
    if ($fechaSalidaObj < $fechaEntradaObj) {
        // Sumar un día a la fecha de salida
        $fechaSalidaObj->add(new DateInterval('P1D'));
    }

    // Calcular la diferencia de tiempo normalmente
    $intervalo = $fechaEntradaObj->diff($fechaSalidaObj);

    // Convertir días a horas
    $horas = $intervalo->days * 24 + $intervalo->h;
    $minutos = $intervalo->i;
    
    return ['horas' => $horas, 'minutos' => $minutos];
}


    public function crearPDFreport($registros,$empleado,$totalSalario,$totalHoras) {
        //debuguear($totalSalario);
        // Array de registros
        
        // Crear un nuevo objeto Fpdi
        $pdf = new Fpdi();
        
    
        // Agregar una página al PDF
        $pdf->AddPage('P','letter');
        

        // Encabezado
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->MultiCell(0, 6, 'Nombre de empleado: '.$empleado->nombre.' '.$empleado->apellido);
        $pdf->MultiCell(0, 6, 'Cedula: '.$empleado->dni);
        $pdf->MultiCell(0, 6, 'Pago x hora: c'.$empleado->salario);
        $pdf->MultiCell(0, 6, '');
        $pdf->MultiCell(0, 6, 'Total de horas: '.$totalHoras);
        $pdf->MultiCell(0, 6, 'Total de salario: c'.$totalSalario);
        $pdf->MultiCell(0, 10, '');
        $pdf->SetFont('Arial', 'B', 9);
        //$pdf->Cell(25, 10, 'ID', 1);
       // $pdf->Cell(25, 10, 'ID Empleado', 1);
       $pdf->SetX(40); // Modifica el valor según sea necesario para centrar la tabla
       $pdf->Cell(30, 10, 'Fecha Entrada', 1);
       $pdf->Cell(25, 10, 'Hora Entrada', 1);
       $pdf->Cell(30, 10, 'Fecha Salida', 1);
       $pdf->Cell(25, 10, 'Hora Salida', 1);
       $pdf->Cell(30, 10, 'Total de horas', 1);
       $pdf->Ln();
       // Datos de los registros
       foreach ($registros as $registro) {
           $total_horas = 0;
           //$pdf->Cell(25, 10, $registro->id, 1);
           //$pdf->Cell(25, 10, $registro->idempleado, 1);
           $total_horas = self::calcularHorasTrabajadasLocal($registro->fechaEntrada, $registro->horaEntrada, $registro->fechaSalida, $registro->horaSalida);
           
           $pdf->SetX(40); // Modifica el valor según sea necesario para centrar la tabla
           if($total_horas['minutos'] > 0){
               $horas_totales = $total_horas['horas'].' horas y '.$total_horas['minutos'].' minutos';
           } else {
            $horas_totales = $total_horas['horas'].' horas';
           }
          // debuguear($horas_totales);
            
            $pdf->Cell(30, 10, $registro->fechaEntrada, 1);
            $pdf->Cell(25, 10, $registro->horaEntrada, 1);
            $pdf->Cell(30, 10, $registro->fechaSalida, 1);
            $pdf->Cell(25, 10, $registro->horaSalida, 1);
            $pdf->Cell(30, 10, $horas_totales, 1);
            //$pdf->Cell(20, 10, $registro->horasExtra, 1);
            $pdf->Ln();
        }
        // Nombre del archivo PDF
        $filename = uniqid() . '.pdf';
        
        // Guardar el PDF en un archivo
        $rutaPDF = REPORT_BASE_FOLDER . $filename;
        //debuguear($rutaPDF);
        //debuguear($pdf->Output($rutaPDF));


        $pdf->Output($rutaPDF, 'F');
    
        // URL del PDF
        if($_ENV['ENVIROMENT'] == '1') {
            $url = $_ENV['SERVER_HOST'] . '/build/report/' . $filename;
        } else {
            $url = $_ENV['SERVER_HOST_LOCAL'] . '/build/report/' . $filename;
        }
    
        // Devolver la URL y el nombre del archivo PDF
        return [$url, $filename];
    }
    
}