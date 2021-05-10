// Generador del boton

/* $(document).ready(function() {
    $("#addLinks").click(function(){
        var contador = $("input[type='Text-Area']").length+1;

        $(this).before('<div class="form-outline mb-2"><label for="Enlace'+ contador +'">Enlace:</label><input type="Text-Area" id="Enlace'+ contador +'" name="Enlace'+ contador +'"/><button type="button" class="delete_Enlace btn btn-primary">Del</button></div>');
    });

    $(document).on('click', '.delete_Enlace', function(){
        $(this).parent().remove();
    });
});
 */



// Chequear

$("#chequear").click(function(event){
    event.preventDefault();
    enviar();
    $("#Cargando").removeClass("d-none");
    $("#resultados").addClass("d-none");
    $(".resultados").addClass("d-none");
   /*  // $('#chequear').prop('disabled', true);
    // $('#chequear').addClass("disabled btn-secondary");
    // $('#chequear').removeClass("btn-primary"); */

});

function enviar(){
    
    var envio = [];
    envio.push('Envio');
    var datos = $("#Enlace1").val();
    envio.push(datos);
                
    alert('Se esta realizando la busqueda: '+ ' ' + envio);


    
    $.ajax({
        type: "post",
        url:"ping.php",
        data: {'datos' : envio},
        success: function(textos){

            alert(envio + '  ' + textos);
            $("#Cargando").addClass("d-none");
            $("#resultados").removeClass("d-none");
            $(".resultados").removeClass("d-none");
            /* // $('#chequear').prop('disabled', false);
            // $('#chequear').removeClass("disabled btn-secondary");
            // $('#chequear').addClass("btn-primary"); */

            $("#resultados").html(textos);
            $(".resultados").html(textos);
            
            

        }
    })
};



// Loging.

$("#loging").submit(function(event){
    event.preventDefault();
    Logear();
});

function Logear(){
    
    var ClaveVal = $("#clave").val();
    var ClaveU = '1234';

    if (ClaveVal === ClaveU) {
        $("#Chequeador").removeClass("d-none");
        $("#Logear").addClass("d-none");
        $("#Enlace1").val('');
        alert('Clave Correcta');
    }else{
        alert('Clave Errada');
    }
    
}