<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <style>
    body{
      font-family: sans-serif;
    }
    @page {
      margin: 160px 50px;
    }
    header { position: fixed;
      left: 0px;
      top: -130px;
      right: 0px;
      height: 150px;
      background-color: white;
      text-align: center;
    }
    header h2{
      margin: 10px 0;
    }
    header h3{
      margin: 0 0 15px 0;
    }
    footer {
      position: fixed;
      left: 0px;
      bottom: -50px;
      right: 0px;
      height: 15px;
      border-bottom: 3px solid #CEBEBE;
    }
    footer .page:after {
      content: counter(page);
    }
    footer table {
      width: 100%;
    }
    footer .izq {
      text-align: justify;
      color: blue;
    }
  </style>
</head>
<body>
  <header>
    <img src="img/logoUesLectura.png" align="left" >
    <img src="img/logoClinicaLectura.jpg" align="right" >
    <h2>UNIVERSIDAD DE EL SALVADOR</h2>
    <h3>FACULTAD DE MEDICINA</h3>
    <h3>CLINICA DE IMAGENES Y RADIOLOGIA</h3>
     <hr size="4" color="black" />
  </header>
  <footer>
    <table>
      <tr>
        <td>
            <p class="izq">
              La Clínica de Radiología y ultrasonografia de la Facultad de Medicina de la
              Universidad de El Salvador brinda sus servicios al público en general, a precios
              económicos y con atención profesional , mayor información a los teléfonos: 2511-2000
              ext. 6042 y ext.6022; clínicaderx_ues@hotmail.com
            </p>
        </td>
       </tr>
    </table>
  </footer>
  <div id="content">
    @foreach($lectura as $paciente)
      <p>
     <table class="table table-bordered">
        <tr>
          <th align="left"><h2>Nombre: {{$paciente->primerNombre}} {{$paciente->segundoNombre}} {{$paciente->primerApellido}} {{$paciente->segundoApellido}}</h2></th>
        </tr>
        <tr>
          <th align="left"><h2>Sexo: {{$paciente->nombreSexo}}</h2></th>
          <th align="rightt"><h2>Edad: {{$paciente->edadPaciente}} AÑOS</h2></th>
        </tr>

        <?php
        if($paciente->mesR==1){
          $mes='enero';
        }
        if($paciente->mesR==2){
          $mes='febrero';
        }
        if($paciente->mesR==3){
          $mes='marzo';
        }
        if($paciente->mesR==4){
          $mes='abril';
        }
        if($paciente->mesR==5){
          $mes='mayo';
        }
        if($paciente->mesR==6){
          $mes='junio';
        }
        if($paciente->mesR==7){
          $mes='julio';
        }
        if($paciente->mesR==8){
          $mes='agosto';
        }
        if($paciente->mesR==9){
          $mes='septiembre';
        }
        if($paciente->mesR==10){
          $mes='octubre';
        }
        if($paciente->mesR==11){
          $mes='noviembre';
        }
        if($paciente->mesR==12){
          $mes='diciembre';
        }
          ?>
           <tr>
          <th align="center"><h2>{{$paciente->diaR}} de <?php echo($mes)?> del {{$paciente->anioR}} </h2></th>
        </tr>

        <tr>
          <th align="center"><h2>ULTRASONOGRAFIA PELVICA</h2></th>
        </tr>
         <tr>
          <th align="center"><h2>UTERO:</h2></th>
        </tr>
        <tr>
          <th align="left"><h2>Posicion: {{}}</h2></th>
        </tr>
         <tr>
          <th align="left"><h2>Medidas:de {{}}</h2></th>
        </tr>
         <tr>
          <th align="left"><h2>Contorno: {{}}</h2></th>
        </tr>
         <tr>
          <th align="left"><h2>Miometrio: {{}}</h2></th>
        </tr>
         <tr>
          <th align="left"><h2>Endometrio: {{}}</h2></th>
        </tr>
        <tr>
          <th align="center"><h2>OVARIOS:</h2></th>
        </tr>
        <tr>
          <th align="left"><h2>Derechos: de</h2></th>
        </tr>
        <tr>
          <th align="left"><h2>Volumen de</h2></th>
        </tr>
         <tr>
          <th align="left"><h2>Izquierdo de</h2></th>
        </tr>
         <tr>
          <th align="left"><h2>Volumen de</h2></th>
        </tr>
         <tr>
          <th align="left"><h2>Fondo de saco</h2></th>
        </tr>
      </table>
    </p>
    @endforeach
   </div>
