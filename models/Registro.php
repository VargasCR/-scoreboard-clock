<?php
namespace Model;
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
    
    public function crearPDFreport($registros,$empleado,$totalSalario,$totalHoras) {
        //debuguear($totalSalario);
        // Array de registros
       
    
        // Crear un nuevo objeto Fpdi
        $pdf = new Fpdi();
    
        // Agregar una página al PDF
        $pdf->AddPage('P','letter');
        

        // Encabezado
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->MultiCell(0, 6, utf8_decode('Nombre de empleado: '.$empleado->nombre.' '.$empleado->apellido));
        $pdf->MultiCell(0, 6, 'Cedula: '.$empleado->dni);
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
           
           
           $pdf->SetX(40); // Modifica el valor según sea necesario para centrar la tabla
            // Separar horas y minutos de la hora de entrada
            $entrada_parts = explode(':', $registro->horaEntrada);
            $entrada_horas = intval($entrada_parts[0]);
            $entrada_minutos = intval($entrada_parts[1]);

            // Separar horas y minutos de la hora de salida
            $salida_parts = explode(':', $registro->horaSalida);
            $salida_horas = intval($salida_parts[0]);
            $salida_minutos = intval($salida_parts[1]);

            // Calcular la diferencia de tiempo en minutos
            $diferencia_minutos = ($salida_horas * 60 + $salida_minutos) - ($entrada_horas * 60 + $entrada_minutos);

            // Convertir la diferencia de minutos a horas
            $diferencia_horas = number_format($diferencia_minutos / 60, 3);

            // Sumar la diferencia al total de horas trabajadas
            $total_horas += $diferencia_horas;

            
            $pdf->Cell(30, 10, $registro->fechaEntrada, 1);
            $pdf->Cell(25, 10, $registro->horaEntrada, 1);
            $pdf->Cell(30, 10, $registro->fechaSalida, 1);
            $pdf->Cell(25, 10, $registro->horaSalida, 1);
            $pdf->Cell(30, 10, $total_horas, 1);
            //$pdf->Cell(20, 10, $registro->horasExtra, 1);
            $pdf->Ln();
        }

        // Nombre del archivo PDF
        $filename = uniqid() . '.pdf';
    
        // Guardar el PDF en un archivo
        $rutaPDF = REPORT_BASE_FOLDER . $filename;
        $pdf->Output($rutaPDF, 'F');
    
        // URL del PDF
        $url = $_ENV['APP_URL'] . '/build/report/' . $filename;
    
        // Devolver la URL y el nombre del archivo PDF
        return [$url, $filename];
    }
    
}