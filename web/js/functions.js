//ELIMINAR AL BUSCAR Y APRETARLE AL BO
$(document).ready(function () {
	$('#reset').click(function(){
		$('#search').val("");
		$( "#searchForm" ).submit();


	});

//CONVERTIR EN MAYUSCULAS
 $('.uc').keyup(function() {
        this.value = this.value.toLocaleUpperCase();
    });


$(".modalwin").click(function (event){
    var titulo = $(this).attr('title');
    var bar = $("#modal").find('.progress-bar');
    var contenido  =  $('#modal').find('#modalContent');
    var weba = $(this).attr('href');
    weba = weba.replace("/dash/erp/", "/dash/");
    console.log(weba);
    event.preventDefault();
    bar.css('display', 'none');
     if ($('#modal').data('bs.modal').isShown) {

            // contenido.load($(this).attr('href') , function (){
            //     // console.log(bar);
            //     // bar.addClass('animate');
            //     // setTimeout(function(){
            //       //  $bar.removeClass('animate');
            //         $('#modalHeader').html('<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h2>' + titulo + '</h2>');
                    
            //     // })

            // });
        } else {
            $('#modal').modal('show').find('#modalContent').load(weba , function(){
                       $('#modalHeader').html('<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h2>' + titulo + '</h2>');
            });
            
        }

    });

$(".filtrar button").click(function(event) {
    var btn = $(this);
   var valor = btn.attr("data-value");
   var page = location.protocol+ '//'+location.hostname+"/erp/"+btn.parent().attr("data-page");
   var columna = btn.parent().attr("data-column");
   var buscador = btn.parent().attr("data-search");
   if(valor==0)
    location.href =page+"/index"
   else
     location.href = page+"/index?"+buscador+"%5B"+columna+"%5D="+valor;

   //var valor = btn.attr("data-value");
});

});

$(".confirmar .btn").click(function(event) {
    titulo = $(this).attr('data-titulo');
    message = $(this).attr('data-message');
    if(titulo == null){
        titulo = "Enviar Contizacion";
          message = "Desea cambiar status a enviado de la cotizacion?"
        }
     Confirmar(titulo , message, "#w0");
});



$("#finalizar").click(function(event) {
        event.preventDefault();
        titulo = "Finalizar Proyecto";
        message = "Desea cambiar el procentaje al 100%?"
        Confirmar(titulo , message, "#finalizar_form");
});


// $("#nfase").click(function(event) {
//         event.preventDefault();
//         titulo = "Fase Produccion";
//         message = "Desea pasar a la fase produccion?"
//         Confirmar(titulo , message, "#fase_form");
// });

function Confirmar(titulo , mensaje , formulario){
    bootbox.confirm(
        {
            title: titulo,

            message: mensaje,
            buttons: {
                confirm: {
                    label: "OK"
                },
                cancel: {
                    label: "Cancelar"
                }
            },
            callback: function (confirmed) {
                console.log(confirmed);
                if (confirmed) {
                    $(formulario).submit();            
                }
        }
    });
}

