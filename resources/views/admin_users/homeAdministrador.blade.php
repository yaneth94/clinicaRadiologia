@extends('layouts.app')

@section('content')
<section>
<div class="alert alert-info">
<strong>Bienvenido al Sistema de la Clinica </strong>Indicaciones para Administrador
</div>

<section class="mbr-section mbr-section--relative mbr-section--fixed-size" id="features1-12" style="background-color:	#F0F8FF ">
    
    
    <div class="mbr-section__container container mbr-section__container--std-top-padding" style="padding-top: 93px;">
        <div class="mbr-section__row row">
            <div class="mbr-section__col col-xs-12 col-md-3 col-sm-6">
                <div class="mbr-section__container mbr-section__container--center mbr-section__container--middle">
                    <figure class="mbr-figure"><img src="{{ asset('img/user.png')}}" class="mbr-figure__img"></figure>
                </div>
                <div class="mbr-section__container mbr-section__container--middle">
                    <div class="mbr-header mbr-header--reduce mbr-header--center mbr-header--wysiwyg">
                        <h3 class="mbr-header__text_manejo">Para Crear un Usuario</h3>
                    </div>
                </div>
                <div class="mbr-section__container mbr-section__container--middle">
                    <div class="mbr-article mbr-article--wysiwyg">
                        <p>Debe solicitar todos los datos del Usuario para proceder a la creación de las credenciales&nbsp;<br>Debe llenar el formulario que se le presenta despues de presionar el botón</p>
                    </div>
                </div>
                <div class="mbr-section__container mbr-section__container--last" style="padding-bottom: 93px;">
                    <div class="mbr-buttons mbr-buttons--center"><a href="{{ route('admin_users.create')}}"" class="mbr-buttons__btn btn btn-wrap btn-xs-lg btn-default">Crear Usuario</a></div>
                </div>
            </div>
            <div class="mbr-section__col col-xs-12 col-md-3 col-sm-6">
                <div class="mbr-section__container mbr-section__container--center mbr-section__container--middle">
                    <figure class="mbr-figure"><img src="{{ asset('img/user2.png')}}" class="mbr-figure__img"></figure>
                </div>
                <div class="mbr-section__container mbr-section__container--middle">
                    <div class="mbr-header mbr-header--reduce mbr-header--center mbr-header--wysiwyg">
                        <h3 class="mbr-header__text_manejo">Para Ver lista de Usuarios</h3>
                    </div>
                </div>
                <div class="mbr-section__container mbr-section__container--middle">
                    <div class="mbr-article mbr-article--wysiwyg">
                        <p>Para realizar una actualización de un Usuario o eliminación debe seleccionarlo en el expediente &nbsp;</p>
                    </div>
                </div>
                <div class="mbr-section__container mbr-section__container--last" style="padding-bottom: 93px;">
                    <div class="mbr-buttons mbr-buttons--center"><a href="{{ route('admin_users.index')}}" class="mbr-buttons__btn btn btn-wrap btn-xs-lg btn-default">Ver Usuarios</a></div>
                </div>
            </div>
            <div class="clearfix visible-sm-block"></div>
            <div class="mbr-section__col col-xs-12 col-md-3 col-sm-6">
                <div class="mbr-section__container mbr-section__container--center mbr-section__container--middle">
                    <figure class="mbr-figure"><img src="{{ asset('img/radio.png')}}" class="mbr-figure__img"></figure>
                </div>
                <div class="mbr-section__container mbr-section__container--middle">
                    <div class="mbr-header mbr-header--reduce mbr-header--center mbr-header--wysiwyg">
                        <h3 class="mbr-header__text_manejo">Estamos trabajando para Usted</h3>
                    </div>
                </div>
                <div class="mbr-section__container mbr-section__container--middle">
                    <div class="mbr-article mbr-article--wysiwyg">
                        <p>Nuestro Sistema Espera ayudar con la administración desde guardar los datos del paciente con sus respectivos examenes, eliminado el papeleo excesivo</p>
                    </div>
                </div>
            </div>
            
            <div class="mbr-section__col col-xs-12 col-md-3 col-sm-6">
                <div class="mbr-section__container mbr-section__container--center mbr-section__container--middle">
                    <figure class="mbr-figure"><img src="{{ asset('img/ues.png')}}" class="mbr-figure__img"></figure>
                </div>
                <div class="mbr-section__container mbr-section__container--middle">
                    <div class="mbr-header mbr-header--reduce mbr-header--center mbr-header--wysiwyg">
                        <h3 class="mbr-header__text_manejo">Seguimos arreglando este Modulo</h3>
                    </div>
                </div>
                <div class="mbr-section__container mbr-section__container--middle">
                    <div class="mbr-article mbr-article--wysiwyg">
                        <p>Bienvenido a su portal para Recepción&nbsp;</p>
                    </div>
                </div>
            </div>
            </div>
 </div>
 </section>
 </section>
<!-- /. PAGE WRAPPER  -->
@endsection