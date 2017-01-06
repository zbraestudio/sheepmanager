$(document).ready(function(){

  $('input.mask').each(function(){

    var mask = $(this).attr('mask');
    $(this).mask(mask, {clearIfNotMatch: true});

  });



});


$(document).ready(function(){

  $('.summernote').summernote();

  $('.chosen-select').chosen({
    width: "100%",
    allow_single_deselect: true,
    no_results_text: "Nenhum",
    placeholder_text_single: "Selecione uma opção",
    placeholder_text_multiple: "Selecione algumas opções"
  });


  $('.input-group.date').datepicker({
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    calendarWeeks: true,
    autoclose: true,
    currentText: 'Hoje',
    language: "pt-BR"
  });


});
