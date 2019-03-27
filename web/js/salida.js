/************************************************************************
*************           EVENTOS                  ***********************
*************************************************************************/
$(".field-movimiento-metodo").hide('slow');
$(".field-movimiento-proyecto").hide('slow');


var dez = null;
var datagrid = null;
//PRESIONA EL CODIGO
$('body').on("keypress", '.codigo' , function(event) {
    if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode ==9  ) {

    }else if( event.keyCode == 13){ //ENTER
        buscarCodigo($(this))
        event.preventDefault(); 
    }/*else {
	   //SI NO ES NUMERO
		if (event.keyCode < 48 || event.keyCode > 57 ) 
			event.preventDefault();	
}*/
});
// //BLUR CODIGO


//PRESIONA F2 CODIGO
$('body').on("keydown", '.codigo' , function(event) {
    if(event.which == 113) { //F2
  dez = $(this);
  crearGrid();
  datagrid.show();
}});


//PRESIONA EN CANTIDAD O COSTO
$('body').on("keypress", '.cantidad ', function(e) {
    var des = $(this).parent().parent().parent().find('.descripcion');
    if(des.val()=="")
        event.preventDefault();
    else {
      if ( event.keyCode == 8  || (event.keyCode == 46 && !$(this).val().includes("."))  ) {
      }else if( event.keyCode == 13){
        event.preventDefault();   
        totalItem($(this));
      }else {
		if (event.keyCode < 48 || event.keyCode > 57 ) {
			event.preventDefault();	
		}	
	}
}
});

$('body').on("blur", '.cantidad ', function(e) {
   totalItem($(this));
});

//INSERTAR O ELIMINAR CAMPO 
$(".dynamicform_wrapper").on("afterInsert  afterDelete ", function(e, item) {
    sumarTotal();
});


/************************************************************************
*************           FUNCIONES                ***********************
*************************************************************************/

//MOSTRAR EN ENCABEZADO EL TOTAL
function sumarTotal(){
    var num = 0;
    var total = 0;
    var tmp = 0;
     $(".form-options-body .form-options-item").each(function(index) {
        var item = $(this).find(".total");
        total += (item.val() == "")? 0 :parseFloat(item.val());
        num++;
    });
     // total = total *1.16;
    $("#enc").html("Materiales ("+ num +") - Total : " + total.toFixed(2) );
    $("#movimiento-total_mvto").val(total.toFixed(2));
}

function totalItem(dis){
    var clase =dis.attr('class');

    var total = dis.parent().parent().parent().find('.total');
    var costo = dis.parent().parent().parent().find('.costo');
    var cantidad = dis.parent().parent().parent().find('.cantidad');

    $(".panel-heading").find('.add-item').focus();
    
    var cov = (costo.val() == "")?0:parseFloat(costo.val());
    var cav = (cantidad.val() == "")?0:parseFloat(cantidad.val());
    var r = (cov*cav).toFixed(2);
    total.val(r);
    sumarTotal();
}

function buscarCodigo(dis){
    var valor = dis.val();
    var siguiente = dis.parent().parent().next();

    $.get("/erp/almacen/verifycode", {  code: valor })
      .done(function( data ) {
        if(data.error == 1){

            bootbox.alert("No existe la materia prima");
            siguiente.find('input').val("");  
        }else{
            siguiente.find('input').val(data.material_almacen);
            siguiente.next().find('input').val(data.familia);
            siguiente.next().next().find('input').val(data.costo_iva);
          siguiente.next().next().next().find('input').focus();
        }
    });//TERMINA FUNCION DONE
}


$(function() {
  crearGrid();
});


function crearGrid(){
//var data = [{"idmaterial_almacen":"2","codigo":"10000","material_almacen":"ACRILICO DE 40MM","familia":"ACRILICO","existencia":"0","costo":"0","costo_iva":"0","created_at":"2016-07-21 21:43:01","updated_at":"2016-07-21 23:19:04","created_by":"moskito","updated_by":"moskito"},{"idmaterial_almacen":"5","codigo":"10001","material_almacen":"ACRILICO DE 70 MM","familia":"ACRILICO","existencia":"0","costo":"0","costo_iva":"0","created_at":"2016-07-21 23:26:57","updated_at":"2016-07-21 23:31:27","created_by":"moskito","updated_by":"moskito"}];
  datagrid =  new FancyGrid({

    title: 'Lista de materiales',
    theme: {
  name: 'gray',
  
},
    window:true,
    modal:true,
    width: 750,
    height: 400,
    data: {
      proxy: {
        url: 'getmateriales',
      }
    },
     events: [{
    cellclick: 'onCellClick'
  },{
    celldblclick: 'onCellDBLClick'
  }],
  onCellClick: function(grid, o){
    console.log(o.data);
   //  $('#modalMat').modal('hide');
     dez.val(o.data.codigo);
     // dez.focus();
    datagrid.hide(false);
    var e = $.Event('keypress');
    e.keyCode= 13; // enter
    dez.trigger(e);

    // buscarCodigo(dez);
  },
  onCellDBLClick: function(grid, o){
    
  },
     paging : true,
    defaults: {
      type: 'string',
      width: 100,
      editable: false,
      sortable: false,
      filter: {
        header: true,
        emptyText: 'Buscar...'
      }
    },
    clicksToEdit: 1,
    columns: [ {
      index: 'codigo',
      locked: true,
      title: 'Codigo'

    }, {
      index: 'material',
      title: 'Descripcion',
      width: 350
    }, {
      index: 'familia',
      title: 'Familia',
      width: 150
         },
         {
      index: 'costo_iva',
      title: 'Costo',
      width: 150
         }
       
         ]
        
  
  });
}

// $('body').on("submit" , 'form#searcher' ,function(event) {
//     event.preventDefault();
    
// });
