$(function() {
  $('#rechazar').click(function(event) {
  	$('#rechazada').show('slow');
  	$('#vencida').hide('slow');

  });

    $('#vencer').click(function(event) {
  	$('#rechazada').hide('slow');
  	$('#vencida').show('slow');

  });
});