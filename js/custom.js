/*--Navigation tooltip functionality--*/
$(function () {
  $('[data-toggle="tooltip"]').tooltip({ container: 'body' })
})

/*--Show and hide postal code box based on Country = Canada--*/
 var postalCode = jQuery('select[name=country]');
 var select = this.value;
 postalCode.change(function () {
     if ($(this).val() == 'Canada') {
         $('#postalCodeBox').show();
     } else {
         $('#postalCodeBox').hide()
     };
 }).change(); 
 /*--Have it fire after php validation, ensures postal code box still shows if Canada was selected and error occured--*/

