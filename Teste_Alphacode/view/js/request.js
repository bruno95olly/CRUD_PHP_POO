'use strict';

const $$ = element => document.querySelectorAll(element)

function regexEmail(email) {
    let emailPattern =
      /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
    return emailPattern.test(email);
}

$(function(){
        $("#formContato").submit(function(e){
            e.preventDefault();

            if($("#nome_completo").val() == " " || $("#telefone").val().length > 14 || 
                $("#celular").val().length < 15 || $("#celular").val().length > 15 || regexEmail($("#email").val()) !== true || 
                $("#email").val() == " " || $("#celular").val() == " " || $("#nascimento").val() == " " || 
                $("#nascimento").val().length < 10 || $("#nascimento").val().length > 10){
                $("#textErro").text("Preencha os campos obrigatórios de forma válida!");
            }
            else{
                var nascimento = $("#nascimento").val();   
                nascimento = nascimento.replace(/[^0-9]/g, ''); 
                nascimento = nascimento.replace(/(\d{2})(\d{2})(\d{4})/, "$3-$2-$1"); 

                $$("input[type=checkbox]").forEach(()=>{
                    if($("input:checked[type=checkbox]")){
                        $("input:checked[type=checkbox]").val(1);
                    }
                })

                const dados = {
                    nome: $("#nome_completo").val(),
                    email: $("#email").val(),
                    celular: $("#celular").val(),
                    telefone: $("#telefone").val(),
                    profissao: $("#profissao").val(),
                    nascimento: nascimento,
                    chkWhatsapp: $("#chkWhatsapp").val(),
                    chkEmail: $("#chkEmail").val(),
                    chkSMS: $("#chkSMS").val(),
                }

                if($("#buttonSubmit").attr('data-acao') == 'salvar'){
                    $.ajax({
                        method: "POST",
                        url: "../../router.php?modo=inserir",
                        data: dados,
                        success: function(res){
                            console.log(res);
                        }      
                        }).done(function(){
                            $(".container-message").css("display", "flex");
                            $(".message").append("<span style='color: #00d83f' class='material-symbols-outlined'>check_circle</span><p>Cadastro realizado com sucesso!</p><span id='closeMsg' class='material-symbols-outlined'>close</span>")
                            $("body").on('click', "#closeMsg", function(){
                                $(".container-message").css("display", "none");
                                window.location.reload(true);
                            })
                        });
                }
                else if($("#buttonSubmit").attr('data-acao') == 'atualizar'){
                    $.ajax({
                        method: "POST",
                        url: `../../router.php?modo=atualizar&id=${$("#buttonSubmit").attr('data-id')}`,
                        data: dados,
                        success: function(res){
                            console.log(res);
                        }      
                        }).done(function(){
                            $(".container-message").css("display", "flex");
                            $(".message").append("<span style='color: #00d83f' class='material-symbols-outlined'>check_circle</span><p>Contato atualizado com sucesso!</p><span id='closeMsg' class='material-symbols-outlined'>close</span>")
                            $("body").on('click', "#closeMsg", function(){
                                $(".container-message").css("display", "none");
                                window.location.reload(true);
                            })
                    });
                }
            }
        })
})


function removeContact(e){
    if(confirm("Tem certeza que deseja remover este contato?")){
        $.ajax({
            method: "POST",
            url: "../../router.php?modo=deletar",
            data: {id: $(e).data('id')},
            success: function(res){
                console.log(res);
            }      
         }).done(function(){
            $(".container-message").css("display", "flex");
                $(".message").append("<span style='color: #ff0000' class='material-symbols-outlined'>check_circle</span><p>Contato excluído com sucesso!</p><span id='closeMsg' class='material-symbols-outlined'>close</span>")
                $("body").on('click', "#closeMsg", function(){
                    $(".container-message").css("display", "none");
                    window.location.reload(true);
                })
         });
    }
}

function findContact(e){
    $.ajax({
        method: "POST",
        url: "../../router.php?modo=buscar",
        data: {id: $(e).data('id')},
    }).done(function(res){
        const data = JSON.parse(res);

        var formatData = data.nascimento;   
        formatData = formatData.replace(/[^0-9]/g, ''); 
        formatData = formatData.replace(/(\d{4})(\d{2})(\d{2})/, "$3/$2/$1"); 

        $("#nome_completo").val(data.nome);
        $("#nascimento").val(formatData);
        $("#email").val(data.email);
        $("#celular").val(data.celular);
        $("#telefone").val(data.telefone);
        $("#profissao").val(data.profissao);
        $("#chkWhatsapp").val(data.chkWhatsapp);
        $("#chkEmail").val(data.chkEmail);
        $("#chkSMS").val(data.chkSMS);

        data.chkWhatsapp == 1 ? $("#chkWhatsapp").prop('checked', true) : $("#chkWhatsapp").prop('checked', false) 
        data.chkEmail == 1 ? $("#chkEmail").prop('checked', true) : $("#chkEmail").prop('checked', false) 
        data.chkSMS == 1 ? $("#chkSMS").prop('checked', true) : $("#chkSMS").prop('checked', false) 

        $("#buttonSubmit").attr('data-acao', 'atualizar');
        $("#buttonSubmit").attr('data-id', data.id);
        $("#buttonSubmit").text("ATUALIZAR CONTATO")

        window.scrollTo(0, 0)

        console.log(res);
    });
}