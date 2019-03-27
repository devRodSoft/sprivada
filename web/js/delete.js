yii.confirm = function (message, ok, cancel,titulo) {
    titulo = this.getAttribute('data-titulo');
    if(titulo == null)
        titulo = "Eliminar";
    
    bootbox.confirm(
        {
            title: titulo,

            message: "Deseas borrar este item?",
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
                    !ok || ok();
                } else {
                    !cancel || cancel();
                }
            }
        }
    );
};


