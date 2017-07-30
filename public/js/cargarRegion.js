$(document).ready(function(){ 
 $("#tipos").on('change',onSelectTipos)
   
function onSelectTipos(){
    var idCita = $(this).val();
   //alert(idCita);
   //AJAX
   $.get('/api/region/'+idCita+'',function(data){
    //console.log(data);
    var html_select = '<option value="">Seleccione una Region Anatomica</option>';
    $("#region").empty();
    for( var i=0;i<data.length;++i)
        html_select += '<option value="'+data[i].idRegionAnatomica+'">'+data[i].nombreRegionAnatomica+'</option>';
    console.log(html_select);
    $('#region').html(html_select);
   });
}

$("#tipoExamen").on('change',onSelectTiposUpdate)
   
function onSelectTiposUpdate(){
    var idCita = $(this).val();
   //alert(idCita);
   //AJAX
   $.get('/api/region/'+idCita+'',function(data){
    //console.log(data);
    $("#regionAnatomica").empty();
    var html_select = '<option value="">Seleccione una Region Anatomica</option>';
    for( var i=0;i<data.length;++i)
        html_select += '<option value="'+data[i].idRegionAnatomica+'">'+data[i].nombreRegionAnatomica+'</option>';
    console.log(html_select);
    $('#regionAnatomica').html(html_select);
   });
}
});