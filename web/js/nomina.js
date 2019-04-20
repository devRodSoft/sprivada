$("#nomina").click(function(event) {
    titulo = $(this).attr('data-titulo');
    message = $(this).attr('data-message');
    if(titulo == null){
        titulo = "Enviar Contizacion";
          message = "Desea crear la nomina?"
        }
    
    bootbox.confirm(
        {
            title: titulo,

            message: message,
            buttons: {
                confirm: {
                    label: "OK"
                },
                cancel: {
                    label: "Cancelar"
                }
            },
            callback: function (confirmed) {
                if (confirmed) {
                    console.log($("#nomina_form"));
                    $("#nomina_form").submit();            
                }
            }
        }
    );
});

