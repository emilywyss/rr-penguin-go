$(function () {
  $('[data-toggle="tooltip"]').tooltip({ container: 'body' })
})

$('select[name=country]').change(function(e){
  if ($('select[name=country]').val() == 'Canada'){
    $('#postalCodeBox').show();
  }else{
    $('#postalCodeBox').hide();
  }
});