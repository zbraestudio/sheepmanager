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


  $(".field_number").TouchSpin({
    min: 0,
    max: 9999999999999999999999999999999,
    step: 0.01,
    forcestepdivisibility: 'none',
    decimals: 2,
    boostat: 5,
    maxboostedstep: 10,
    buttondown_class: 'btn btn-white',
    buttonup_class: 'btn btn-white',
    initval: " "


  }).focusout(function(){
    var val = $(this).val();
    $(this).val(val.replace(',', '.'));

  }).keydown(function(e) {

    var val = $(this).val();
    /*
     13 = ENTER
     8 = BACKSPACE
     9 = TAB
     110 = Separador Decimal (teclado numérico)
     190 = Ponto final
     47-58 - Números
     96 - 105 - Número (teclado númerico)
     */

    var tecla = e.which;

    if ( tecla == 13 || tecla == 9 || tecla == 8 || (tecla > 47 && tecla < 58) || (tecla >= 96 && tecla <= 105))
      return true;

    if(tecla == 110 || tecla == 190) {

      if (val.indexOf('.') <= 0 && val.indexOf(',') <= 0)
        return true;

    }

    return false;
  });




  $(".field_integer").TouchSpin({
    min: 0,
    max: 9999999999999999999999999999999,
    step: 1,
    forcestepdivisibility: 'none',
    decimals: 0,
    boostat: 5,
    maxboostedstep: 10,
    buttondown_class: 'btn btn-white',
    buttonup_class: 'btn btn-white',
    initval: " "


  }).focusout(function(){
    var val = $(this).val();
    $(this).val(val.replace(',', '.'));

  }).keydown(function(e) {

    var val = $(this).val();
    /*
     13 = ENTER
     8 = BACKSPACE
     9 = TAB
     110 = Separador Decimal (teclado numérico)
     190 = Ponto final
     47-58 - Números
     96 - 105 - Número (teclado númerico)
     */

    var tecla = e.which;

    if ( tecla == 13 || tecla == 9 || tecla == 8 || (tecla > 47 && tecla < 58) || (tecla >= 96 && tecla <= 105))
      return true;

    return false;
  });


});


$(document).ready(function(){

  $('.baixar-lancamento').click(function(){

    var item = $(this);

    var lancamentoID = item.attr('lancamento');
    var pagar = item.attr('pago');

    $.ajax({
      type: "POST",
      url: site_url + 'script/ajax.baixa-lancamento.php',
      data: { lancamentoID: lancamentoID, pagar: pagar },
      success: function(data){
        if(data != ''){

          if(pagar == 'sim'){
            item.attr('pago', 'nao');
          } else {
            item.attr('pago', 'sim');
          }

        }
      }
    });

  });



});
