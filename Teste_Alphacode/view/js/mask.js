'use strict';

function textMask(e){
    e.value = e.value.replace(/[\[\]}.!'-@,><|://#"%$\\;&*()_+={]/g, "");
    e.value = e.value.replace(/[^\D]/g, "");
}

$(document).ready(function(){
    $('#nascimento').mask('00/00/0000');
    $('#celular').mask('(00) 00000-0000');
    $('#telefone').mask('(00) 0000-0000');
})


function validatorTelephone(e){
    if (e.value.length < 14 || e.value.length > 14) {
        $(e).addClass("invalid");
        $("#textTelephone").text("Número de telefone inválido");
      } else {
        $("#textTelephone").text("");
        $(e).removeClass("invalid");
      }
}

function validatorCelular(e){
    if (e.value.length < 15 || e.value.length > 15) {
        $(e).addClass("invalid");
        $("#textCelular").text("Número de telefone inválido");
      } else {
        $("#textCelular").text("");
        $(e).removeClass("invalid");
      }
}

function validatorData(e){
    if (e.value.length < 10 || e.value.length > 10) {
        $(e).addClass("invalid");
        $("#textData").text("Data inválida Ex: ddmmyyyy");
      } else {
        $("#textData").text("");
        $(e).removeClass("invalid");
      }
}

function validatorEmail(e){
    if (regexEmail(e.value) !== true) {
        $(e).addClass("invalid");
        $(e).css({"border-bottom": " 2px solid #068ED0"});
        $("#textEmail").text("Email inválido Ex: nome@dominio.com");
      } else {
        $("#textEmail").text("");
        $(e).removeClass("invalid");

      }
}

function regexEmail(email) {
    let emailPattern =
      /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
    return emailPattern.test(email);
}


