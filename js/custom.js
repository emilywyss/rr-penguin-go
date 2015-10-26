$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$('select[name=country]').change(function(e){
  if ($('select[name=country]').val() == 'Canada'){
    $('#postalCodeBox').show();
  }else{
    $('#postalCodeBox').hide();
  }
});

$("#registrationForm").validetta({
  showErrorMessages : true,
  onError : function( event ){
    alert( 'Stop bro !! There are some errors.');
  }
});