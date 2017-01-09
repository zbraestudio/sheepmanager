$(document).ready(function(){

  $('[data-toggle=confirmation]').confirmation({
    rootSelector: '[data-toggle=confirmation]',
    btnCancelLabel: 'não',
    btnOkLabel: 'sim'
  });


  $('.grid form#filters').submit(function(){

    if($(this).find('input#s').val().length > 0 && $(this).find('input#s').val().length <= 3){
      alert('Para pesquisar, você precisa digitar mais do que 3 caracteres.');
      $(this).find('input#s').focus();
      return false;
    }


  });


  $('.grid #filter_list').change(function(){

    $('.grid form#filters').submit();

  });

});