<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use Session;

use App;

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class TicketController extends Controller
{
	static public function ajaxTicketCreate(){
      	setlocale(LC_TIME, 'es_ES');
      	date_default_timezone_set('America/Bogota');
      	Carbon::setLocale('es');
		$plate = mb_strtoupper($_POST['placa']);
	   	$answer = new App\Models\Ticket();
	   	$answer->plate = $plate;
	   	$answer->save();
      	$hoy = Carbon::now();
      	$hoy->toDateString();
      	$hora = substr($hoy, -8,5);
      	$hoy = substr($hoy, 0,-9);


		$impresora = "SAT";

		$conector = new WindowsPrintConnector($impresora);

		$printer = new Printer($conector);

		$printer -> setJustification(Printer::JUSTIFY_CENTER);

		$printer -> text("Parqueadero de motos"."\n");

		$printer -> text("SOPLAZA"."\n");

		$printer -> feed(1); //Alimentamos el papel 1 vez*/	

		$printer -> setJustification(Printer::JUSTIFY_LEFT);

		$printer -> text("Dirección: Carrera 40a # 37sur - 26"."\n");

		$printer -> text("NIT: 84.042.642-4"."\n");

		$printer -> text("CEL: 319 2349 205"."\n");

		$printer -> setTextSize(3,3);

		$printer -> text("Placa: ".$plate."\n");
		
		$printer -> setTextSize(1,1);

		$printer -> text("Fecha: ".$hoy."\n");

		$printer -> text("Hora de entrada: ".$hora."\n");

		$printer -> text("Hora de salida: "."\n");

		$printer -> text("Valor: "."\n");

		$printer -> feed(1); //Alimentamos el papel 1 vez*/	

		$printer -> setJustification(Printer::JUSTIFY_CENTER);

		$printer -> text("Nuestro horario de atención es:"."\n");

		$printer -> text("Lunes - Sabado"."\n");

		$printer -> text("7:00 am - 8:00 pm"."\n");

		$printer -> text("No abrimos días festivos"."\n");

		$printer -> feed(1); //Alimentamos el papel 1 vez*/	
		
		$printer->text("Muchas gracias por preferirnos"); //Podemos poner también un pie de página

		$printer -> feed(3); //Alimentamos el papel 3 veces*/

		$printer -> cut(); //Cortamos el papel, si la impresora tiene la opción

		$printer -> feed(1); //Alimentamos el papel 3 veces*/

		$printer -> close();
	   	echo "ok";
	}
	static public function ajaxTicketSearch(){
		$plate = mb_strtoupper($_POST['placa']);
	   	$answer = App\Models\Ticket::where('plate',$plate)->orderBy('id', 'desc')->first();
	   	echo json_encode($answer);

	}
}
