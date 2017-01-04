$(document).ready(function(){

  $('[data-toggle=confirmation]').confirmation({
    rootSelector: '[data-toggle=confirmation]',
    btnCancelLabel: 'não',
    btnOkLabel: 'sim'
  });

});