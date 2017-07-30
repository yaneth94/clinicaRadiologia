<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Cita;
use App\Reservacion;

class CitasController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response

  */
  private $path = '/admin_citas';
  public function index()
  {
    $citas = DB::table('citas')
    ->orderBy('idCita', 'desc')
    ->select('citas.idCita','citas.fechaCita','citas.horaCita','citas.idTipoExamen','tipoExamen.nombreTipoExamen','citas.habilitado')
    ->join('tipoExamen','citas.idTipoExamen','=','tipoExamen.idTipoExamen')
    ->paginate(10);

    $preliminar = DB::table('citas')->count();
    //dd($preliminar);

    $cantidad = [];
    for ($i=1; $i<=$preliminar;$i++) {
      $aux = DB::table('reservacion')
      ->where([['reservacion.idCita','=',$i]])
      ->select('reservacion.idCita',DB::raw('count(reservacion.idPaciente) as conteo'))
      ->groupBy('reservacion.idCita')
      ->get();
      array_push($cantidad, $aux);
    }
    //dd($cantidad);

    return view($this->path.'/admin_citas')->with('citas',$citas)->with('cantidad',$cantidad)
    ->with('preliminar',$preliminar);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $tipoExamenes = DB::table('tipoExamen')->select('idTipoExamen', 'nombreTipoExamen')->get();
    return view($this->path.'/crearCita')->with('tipoExamenes',$tipoExamenes);
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    try{
      //valida si hay una cita activa para la fecha asignada y tipo de examen específico
      $validar=DB::table('citas')->where('fechaCita',$request->fechaCita)
      ->where('idTipoExamen',$request->tipoExamen)
      ->where('habilitado','=',true)
      ->count();

if($validar==0){
  //revisa si hay citas antiguas activas para ser desactivadas debido a que se crea una nueva cita
  $idcitaAnterior= DB::table('citas')
        ->where('citas.idTipoExamen',$request->tipoExamen)
        ->where('citas.habilitado','=',true)
        ->max('citas.idCita');

        if($idcitaAnterior!=null){
          $citaAnterior=Cita::findOrFail($idcitaAnterior);
          $citaAnterior->habilitado=false;
          $citaAnterior->save();
        }

        $cita = new Cita();
        $cita->fechaCita = $request->fechaCita;
        $cita->horaCita = $request->horaCita;
        $cita->idTipoExamen= $request->tipoExamen;
        $cita->save();
        return redirect($this->path)->with('msj','Cita Registrada');

}else{
  return redirect($this->path)->with('msj2','Cita NO registrada, es posible que ya exista una cita para el mismo tipo de examen en la misma fecha');
}



    }catch(Exception $e){
      return "Fatal error - ".$e->getMessage();
    }
  }



  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $cita = Cita::findOrFail($id);
    $citas = DB::table('citas')
    ->select('citas.idCita','citas.fechaCita','citas.horaCita','tipoExamen.nombreTipoExamen')
    ->join('tipoExamen','citas.idTipoExamen','=','tipoExamen.idTipoExamen')
    ->where('citas.idCita','=',$cita->idCita)
    ->get();

    $cantidad = DB::table('reservacion')
    ->select(DB::raw('count(reservacion.idReservacion) as conteo'))
    ->where('reservacion.idCita','=',$cita->idCita)
    ->get();


    $reservaciones = DB::table('reservacion')
    ->select('pacientes.primerNombre','pacientes.segundoNombre','pacientes.primerApellido','pacientes.segundoApellido',
    'pacientes.idPaciente','regionAnatomica.nombreRegionAnatomica','regionAnatomica.idRegionAnatomica','sexo.nombre_sexo')
    ->join('pacientes','pacientes.idPaciente','=','reservacion.idPaciente')
    ->join('sexo','pacientes.idSexo','=','sexo.idSexo')
    ->join('regionAnatomica','regionAnatomica.idRegionAnatomica','=','reservacion.idRegionAnatomica')
    ->where('reservacion.idCita','=',$cita->idCita)
    ->paginate(9);


    return view($this->path.'/verCitas')->with('citas',$citas)->with('reservaciones',$reservaciones)->with('cantidad',$cantidad);
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    try{
      $cita = Cita::findOrFail($id);
      $tipoExamenes= DB::table('tipoExamen')->where('idTipoExamen',$cita->idTipoExamen)
      ->select('idTipoExamen','nombreTipoExamen')->get();
      $tipoExamenesDiferente =DB::table('tipoExamen')->where('idTipoExamen','<>',$cita->idTipoExamen)
      ->select('idTipoExamen','nombreTipoExamen')->get();
      return view($this->path.'/editarCita')->with('cita',$cita)->with('tipoExamenes',$tipoExamenes)
      ->with('tipoExamenesDiferente',$tipoExamenesDiferente);
    }catch(Exception $e){
      return "Error al intentar modificar la cita".$e->getMessage();
    }

  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    try{
      $cita = Cita::findOrFail($id);
      $cita->fechaCita = $request->fechaCita;
      $cita->horaCita = $request->horaCita;
      $cita->idTipoExamen = $request->tipoExamen;
      if($cita->save()){
        return redirect($this->path)->with('msj','Cita modificada');
      }else{
        return back()->with();
      }

    }catch(Exception $e){

    }

  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    //
  }


}