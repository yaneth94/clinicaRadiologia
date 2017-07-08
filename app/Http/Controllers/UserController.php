<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Redirect;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     private $path = '/admin_users';

     //Referencia al middleware adminMiddleware
     public function __construct(){
     $this->middleware('auth');
     $this->middleware('admin',['except'=>'show']);
  }
    public function index()
    {
      $users = DB::table('users')
          ->join('roles', 'users.id_rol', '=', 'roles.id_rol')
          ->select('users.id','users.name', 'users.username', 'roles.nombre_rol')
          ->orderBy('id', 'desc')
          ->paginate(7);
          return view($this->path.'/admin_users')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $roles=DB::table('roles')->select('id_rol', 'nombre_rol')->get();
          return view($this->path.'/crearUsuario')->with('roles',$roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**Necesario para el home de Administrador*/
     public function home()
     {
         return view($this->path.'/homeAdministrador');
     }

    public function store(Request $request)
    {
      $this->validate($request,[
        'name' => 'required|max:75|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
        'username' => 'required|string|max:255|unique:users',
        'password' => 'required|string|min:6',

      ]);
      try{
     $user = new User();
      $user->name = $request->name;
      $user->username=$request->username;
      $user->id_rol=$request->id_rol;
      $user->password= bcrypt($request->password);

      if($user->id_rol==1){ //id administrador
        $user->nivel_1=true;
        $user->nivel_2=true;
        $user->nivel_3=true;
      } elseif ($user->id_rol==2) { //id lic radiologo
        $user->nivel_1=false;
        $user->nivel_2=true;
        $user->nivel_3=true;
      }elseif ($user->id_rol==3) { // id secretaria
      $user->nivel_1=true;
      $user->nivel_2=false;
      $user->nivel_3=false;
    }else{ //para cualquier rol futuro deberán asignarse manualmente los permisos
        $user->nivel_1=false;
        $user->nivel_2=false;
        $user->nivel_3=false;
      }






      if($user->save()){
      return redirect($this->path)->with('msj','Usuario Registrado');
      }else{
        return back()->with('msj2','Usuario no registrado, es posible que el username ya se encuentre registrado');
      }


      }catch(Exception $e){
          //return "Fatal error - ".$e->getMessage();
          return back()->with('msj2','Usuario no registrado, es posible que el username ya se encuentre registrado');
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
        $user = User::findOrFail($id);
        $users = DB::table('users')
        ->join('roles','users.id_Rol','=','roles.id_Rol')
        ->select('users.*','roles.nombre_rol')->where('users.id',$user->id)
        ->get();
        return view($this->path.'/perfilUser')->with('users',$users);
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
             $user = User::findOrFail($id);
             $rolUser= DB::table('roles')->where('id_rol',$user->id_rol)->select('id_rol','nombre_rol')->get();
             $rolDiferente =DB::table('roles')->where('id_rol','<>',$user->id_rol)->select('id_rol','nombre_rol')->get();;
             return view($this->path.'/editarUsuario')->with("user",$user)->with('rolUser',$rolUser)->with('rolDiferente',$rolDiferente);
        }catch(Exception $e){
            return "Error al intentar modificar al Usuario".$e->getMessage();
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
      $this->validate($request,[
        'name' => 'required|max:75|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
        'username' => 'required|string|max:255',

      ]);
      try{
          //
      $user = User::findOrFail($id);
      $user->name = $request->name;
      $user->username = $request->username;
      $user->id_rol = $request->id_rol;

//validacion de nueva contraseña para campo no vacío
      if($request->password != null){
        $user->password=bcrypt($request->password);
      }

//guardado y envío de confirmacion
      if($user->save()){
      return redirect($this->path)->with('msj','Usuario modificado');
      }else{
        return back()->with('msj2','Usuario no registrado, es posible que el username ya se encuentre registrado');
      }
      return redirect($this->path);
      }catch(Exception $e){
    return "Fatal error - ".$e->getMessage();

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
        try{
            $user = User::findOrFail($id);
            $user->delete();
            return redirect($this->path);
        }catch(Exception $e){
            return "No se pudo eliminar el Usuario Especificado";
        }
    }
}
