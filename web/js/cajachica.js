$(".metodo").hide();
    $('input[name="CajaChica[stpagado]"]').on('switchChange.bootstrapSwitch', function(event, state) {
        console.log(state);
    if(state){
        $(".metodo").show('slow');
    }else{
        $(".metodo").hide('slow');
    }
});