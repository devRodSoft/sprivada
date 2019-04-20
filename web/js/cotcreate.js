$(".dynamicform_wrapper").on("afterInsert", function(e, item) {
     
    $(".container-items .item").each(function(index) {
        $(this).find(".panel-title").html("Propuesta: " + (index + 1))
    });
});

$(".dynamicform_wrapper").on("afterDelete", function(e) {
    $(".container-items .item").each(function(index) {
        $(this).find(".panel-title").html("Propuesta: " + (index + 1))
    });
});

$(".iluminacion").hide();
    $('input[name="Cotizacion[st_iluminacion]"]').on('switchChange.bootstrapSwitch', function(event, state) {
        console.log(state);
    if(state){
        $(".iluminacion").show('slow');
    }else{
        $(".iluminacion").hide('slow');
    }
});


$(".sitio").hide();
$('input[name="Cotizacion[st_sitio]"]').on('switchChange.bootstrapSwitch', function(event, state) {
    console.log(state);
if(state){
    $(".sitio").show('slow' , function(){
        tinyMCE.DOM.setHTML('mydiv', 'some inner html');
        $("#mceu_31-sitio").text('<p>Base compuesta de bastidor de pino y/o MDF y cubierta o superficie de MDF de <strong>6mm</strong> de espesor.</p><p>El sitio se representar&aacute; de acuerdo a los planos proporcionados por el arquitecto. Todas las piezas del sitio se fabricar&aacute;n en una combinaci&oacute;n de l&aacute;minas de acr&iacute;lico y MDF de diferentes espesores seg&uacute;n sea requerido. Las piezas se cortar&aacute;n en l&aacute;ser para su ensamble y terminado.</p><p>Niveles generales del terreno, niveles de desplante de edificaciones y de calles seg&uacute;n planos de nivel.</p><p>Se grabar&aacute;n todas las l&iacute;neas de dise&ntilde;o y textura de pisos sobre la superficie de los materiales.</p><p>Aplicaci&oacute;n de color en todas las superficies del sitio basado en especificaciones proporcionadas por el cliente (color y textura de los materiales)</p>');


    });
}else{
    $(".sitio").hide('slow');
}
});