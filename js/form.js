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


  $(".number").TouchSpin({
    min: 0,
    max: 999999,
    step: 0.1,
    decimals: 2,
    boostat: 5,
    maxboostedstep: 10,
    buttondown_class: 'btn btn-white',
    buttonup_class: 'btn btn-white'
  });



});
