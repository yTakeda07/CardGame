window.onload = function() { //quando a pagina carregar
    const paginaAtual = window.location.pathname.split('/').pop();
        //define qual é a pagina atual

if (paginaAtual === "registro.html"|| paginaAtual==="login.html"){
    //faz nada, já que isso é pra verificar login, e essas sao as paginas pra logar
}else{
    //caso seja qualquer outra pagina sem ser as de login, ou seja, o site todo
            $.ajax({
                url: "../PHP/login.php",
                type: "POST",
                data: { acao: "verificar" }, //serve apenas para estabelecer a conexao com o php
            dataType: "json" //retorna data json pq é o que eu quero dessa vez, pra ser usado no proprio js
        }).done(function(resp) {
        if(resp.islogado!= true){ //se o usuario não estiver logado
            window.location.href = 'login.html'; //retorna pra pagina de login
        }else{ // se ele estiver jogado
            $("footer").html(resp.nome+" - "+resp.senha+" - "+resp.tipo+" <a href='' onclick='deslogarsession(this)'>Deslogar</a>"); //escreve no canto inferior as informações
            if(resp.tipo=="ADMIN"){ // se ele for adm
                document.querySelector('ul').insertAdjacentHTML('beforeend', '<li><a href=admin.html>ADMIN</a></li>');
            }else{// se não for adm
                //n vai fazer nada k
            }
            if(paginaAtual ==="admin.html"|| paginaAtual==="universo.html"){//verifica se a pagina que ele esta é uma de administrador
                if(resp.tipo!="ADMIN"){ //se ele não for adm nao entra.
                window.location.href = 'index.html';
                }else{}
            }else{
                //ja ta logado, faz mais nada n
            }
        }
        }).fail(function(jqXHR, textStatus) {
            alert("Falha na requisição AJAX: " + textStatus);
            console.log("Resposta do servidor:"+ jqXHR.responseText);
        }).always(function() {
        console.log("Requisição AJAX verificar login ao carregar tela concluída");
        });

        }


if(paginaAtual === "admin.html"){
    //se a pagina atual for admin.html, faça
            $.ajax({
                url: "../PHP/exibircarta.php",
                type: "POST",
                data: { acao: "verificar" },
            dataType: "html"
        }).done(function(resp) {
        $("main").html(resp); 
        }).fail(function(jqXHR, textStatus) {
        alert("Falha na requisição AJAX: " + textStatus);
        }).always(function() {
        console.log("Requisição AJAX carregar cartas concluída");
        });


}else if(paginaAtual === "universo.html"){
    //se a pagina atual for universo.html, faça
            $.ajax({
                url: "../PHP/exibiruniversos.php",
                type: "POST",
                data: { acao: "verificar" },
            dataType: "html"
        }).done(function(resp) {
        $("main").html(resp); 
        }).fail(function(jqXHR, textStatus) {
        alert("Falha na requisição AJAX: " + textStatus);
        }).always(function() {
        console.log("Requisição AJAX carregar universos concluída");
        });
    }else if(paginaAtual === "habilidades.html"){
        //se a pagina atual for habilidades.html, faça
                $.ajax({
                    url: "../PHP/exibirhabilidades.php",
                    type: "POST",
                    data: { acao: "verificar" },
                dataType: "html"
            }).done(function(resp) {
            $("main").html(resp); 
            }).fail(function(jqXHR, textStatus) {
            alert("Falha na requisição AJAX: " + textStatus);
            }).always(function() {
            console.log("Requisição AJAX carregar habilidades concluída");
            });
        }
};

//  verificação islogado-----------------------------------------------------------------------------------------------



function botaologin(botao){
    var nome = document.getElementById("nome").value;
    var senha = document.getElementById("senha").value;
        $.ajax({
            url: "../PHP/verificacaologin.php",
            type: "POST",
            data: { nome: nome, senha: senha }, // Enviar os dados como objeto JSON
            dataType: "html"
        }).done(function(resp) {
            $(".caixa").html(resp); // Forma mais simples de modificar o conteúdo da div
        }).fail(function(jqXHR, textStatus) {
            alert("Falha na requisição AJAX: " + textStatus);
        }).always(function() {
            console.log("Requisição AJAX login concluída");
        });
}
// fim ajax login -------------------------------------------------------------


// ajax registro --------------------------------------------------------------

function botaoregistro(botao){
    var nome = document.getElementById("nome").value;
    var senha = document.getElementById("senha").value;
        $.ajax({
            url: "../PHP/registrousuario.php",
            type: "POST",
            data: { nome: nome, senha: senha }, // Enviar os dados como objeto JSON
            dataType: "html"
        }).done(function(resp) {
            $(".caixa").html(resp); // Forma mais simples de modificar o conteúdo da div
        }).fail(function(jqXHR, textStatus) {
            alert("Falha na requisição AJAX: " + textStatus);
        }).always(function() {
            console.log("Requisição AJAX registro concluída");
        });
}

// fim registro ----------------------------------------------------------------



// adicionar carta --------------------------------------------------------------

function AbrirModalCriarCarta(botao){

        $.ajax({
            url: "../PHP/ExibirModalCriarCarta.php",
            type: "POST",
            data: { acao: "verificar" },
        dataType: "html"
    }).done(function(resp) {
    $("#conteudomodal").html(resp); 
    openmodal();
    }).fail(function(jqXHR, textStatus) {
    alert("Falha na requisição AJAX: " + textStatus);
    }).always(function() {
    console.log("Requisição AJAX carregar cartas concluída");
    });
}

// Fim ajaxa dicionar carta -----------------------------


// modal ----------------------------------------------------------------------------
function closemodal(botao){
    const modal = document.querySelector("dialog")
    modal.close()
}

function openmodal(botao){
    const modal = document.querySelector("dialog")
    modal.showModal()
}
// fim modal -----------------------------------------------------------------------------------

// função para preview de imagem e texto -------------------------------------------------------------

function previewImagem(input) {
    const preview = document.getElementById('preview-imagem');
    const file = input.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}

function alterar(input) {
    let valor = input.value;
const preview = document.getElementById("previewtexto");
if (preview){
    preview.innerText = "Nome: "+valor;}
}

// fim função para preview de imagem e texto -------------------------------------------------------------


// upload de universo no banco --------------------------------------------------------------------------
$(document).on("click", "#uploaduniverso", function(){
    var fileInput = $("#arquivo")[0].files[0];
    var nome = document.getElementById("NM_UNIVERSO").value;
    if (fileInput) {
        var formData = new FormData();
        formData.append("arquivo", fileInput);
        formData.append("nome", nome);
        $.ajax({
            url: "../PHP/uploaduniverso.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "html"
        }).done(function(resposta) {
           $(".lado-direito").append(resposta);
            
            // carrega novamente os cards, já que foi adicionado um novo
            $.ajax({
                url: "../PHP/exibiruniversos.php",
                type: "POST",
                data: { acao: "verificar" },
             dataType: "html"
        }).done(function(resp) {
        $("main").html(resp); 
        }).fail(function(jqXHR, textStatus) {
        alert("Falha na requisição AJAX: " + textStatus);
        }).always(function() {
        console.log("Requisição AJAX carregar universos concluída");
        });
        


        }).fail(function(jqXHR, textStatus ) {
            console.log("Request failed: " + textStatus);
        }).always(function() {
            console.log("requisicão ajax upload universo concluida");            
        });
    } else {
        alert("Selecione um arquivo para fazer upload.");
    }
    
});

// fim upload universo banco -------------------------------------------------------------------------------


// apagar universo ----------------------------------------------------------------------------------------

function apagarUniverso(botao){
    
    const confirmacao = window.confirm("Voce Tem certeza que deseja excluir este universo?") //confim pra nao excluir uma materia sem querer kk
    if(confirmacao == true){
        //se o usuario colocar sim, faz
        var id = botao.id; //pega o id do botao clicado
        $.ajax({
            url: "../PHP/apagaruniverso.php",
            type: "POST",
            data: { id: id },
         dataType: "html"
    }).done(function(resp) {
    $("main").html(resp); 
    }).fail(function(jqXHR, textStatus) {
    alert("Falha na requisição AJAX: " + textStatus);
    }).always(function() {
    console.log("Requisição AJAX apagar universo concluída");
    });
 
    }
}

// fim apagar universo ------------------------------------------------------------------------

// ebixe modal editar universo ----------------------------------------------------------------
function ModalEditarUniverso(botao){
    id=botao.id;
    $.ajax({
        url: "../PHP/ExibirModalEditarUniverso.php",
        type: "POST",
        data: { id: id },
    dataType: "html"
}).done(function(resp) {
$("#conteudomodal").html(resp); 
openmodal();
}).fail(function(jqXHR, textStatus) {
alert("Falha na requisição AJAX: " + textStatus);
}).always(function() {
console.log("Requisição AJAX exibir modal editar universo concluída");
});
}

// fim exibe modal editar universo ------------------------------------------------------------------------


// função pra editar o universo ------------------------------------------------------------------------

function EditarUniverso(botao){
    id=botao.id;
    imgatual=document.getElementById("arquivo").className;
var fileInput = $("#arquivo")[0].files[0];
    var nome = document.getElementById("NM_UNIVERSO").value;
    var formData = new FormData();
    if (fileInput) {
        formData.append("temimg?", true);
    } else {
        formData.append("temimg?", false);
    }


        formData.append("arquivo", fileInput);
        formData.append("nome", nome);
        formData.append("id", id);
        formData.append("imgatual", imgatual);

        $.ajax({
            url: "../PHP/EditarUniverso.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "html"
        }).done(function(resposta) {
           $(".lado-direito").append(resposta);
            
            // carrega novamente os cards, já que foi adicionado um novo
            $.ajax({
                url: "../PHP/exibiruniversos.php",
                type: "POST",
                data: { acao: "verificar" },
             dataType: "html"
        }).done(function(resp) {
        $("main").html(resp); 
        }).fail(function(jqXHR, textStatus) {
        alert("Falha na requisição AJAX: " + textStatus);
        }).always(function() {
        console.log("Requisição AJAX carregar universos concluída");
        });
        


        }).fail(function(jqXHR, textStatus ) {
            console.log("Request failed: " + textStatus);
        }).always(function() {
            console.log("requisicão ajax edit universo concluida");            
        });





    
}




// fim função pra editar universo ------------------------------------------------------------------------


// deslogar session --------------------------------------------------------------------------------

function deslogarsession(a){
    const confirmacao = window.confirm("Voce Tem certeza que deseja sair de sua conta?") //confim pra nao excluir uma materia sem querer kk
    if(confirmacao == true){

                $.ajax({
                url: "../PHP/deslogarsession.php",
                type: "POST",
                data: { acao: "verificar" },
            dataType: "html"
        }).done(function(resp) {

        }).fail(function(jqXHR, textStatus) {
        alert("Falha na requisição AJAX: " + textStatus);
        }).always(function() {
        console.log("Requisição AJAX deslogar session concluída");
        });
}
}

//fim deslogar session-----------------------------------------------------------------------------

// botao exibir criar universo -----------------------------------------------------------------------------
function CriarUniverso(botao){
                    $.ajax({
                url: "../PHP/ExibirModalCriarUniverso.php",
                type: "POST",
                data: { acao: "verificar" },
            dataType: "html"
        }).done(function(resp) {
        $("#conteudomodal").html(resp); 
        openmodal();
        }).fail(function(jqXHR, textStatus) {
        alert("Falha na requisição AJAX: " + textStatus);
        }).always(function() {
        console.log("Requisição AJAX carregar modar criar universo concluída");
        });
}

// fim botao exiir criar universo ------------------------------------------------------------------------------------

// botao exibir criar habilibade ------------------------------------------------------------------------------------------

function CriarHabilidade(botao){
    $.ajax({
url: "../PHP/ExibirModalCriarHabilidade.php",
type: "POST",
data: { acao: "verificar" },
dataType: "html"
}).done(function(resp) {
$("#conteudomodal").html(resp); 
openmodal();
}).fail(function(jqXHR, textStatus) {
alert("Falha na requisição AJAX: " + textStatus);
}).always(function() {
console.log("Requisição AJAX carregar modal criar habilidade concluída");
});
}

// fim botao exibir criar habilibade ------------------------------------------------------------------------------------------

// função upar habilidade no banco --------------------------------------------------------------------------------------------------------------

function uparhabilidade(botao){
    let LV_HABILIDADE = document.getElementById("LV_HABILIDADE").value;
    let NM_HABILIDADE = document.getElementById("NM_HABILIDADE").value;
    let DS_HABILIDADE = document.getElementById("DS_HABILIDADE").value;

        $.ajax({
            url: "../PHP/uploadhabilidade.php",
            type: "POST",
            data: {LV_HABILIDADE: LV_HABILIDADE, NM_HABILIDADE: NM_HABILIDADE, DS_HABILIDADE: DS_HABILIDADE},
            dataType: "html"
        }).done(function(resposta) {
           $(".respmodal").append(resposta);
            
            // carrega novamente os cards, já que foi adicionado um novo
            $.ajax({
                url: "../PHP/exibirhabilidades.php",
                type: "POST",
                data: { acao: "verificar" },
            dataType: "html"
        }).done(function(resp) {
        $("main").html(resp); 
        }).fail(function(jqXHR, textStatus) {
        alert("Falha na requisição AJAX: " + textStatus);
        }).always(function() {
        console.log("Requisição AJAX carregar habilidades concluída");
        });
        


        }).fail(function(jqXHR, textStatus ) {
            console.log("Request failed: " + textStatus);
        }).always(function() {
            console.log("requisicão ajax upar habilidade concluida");            
        });




}


// fim função upar habilidade no banco ------------------------------------------------------------------------------------------------------------


// função apagar habilidade -------------------------------------------------------------------------------------------------------------------------------------

function apagarHabilidade(botao){
        
    const confirmacao = window.confirm("Voce Tem certeza que deseja excluir esta habilidade?") //confim pra nao excluir uma materia sem querer kk
    if(confirmacao == true){
        //se o usuario colocar sim, faz
        var id = botao.id; //pega o id do botao clicado
        $.ajax({
            url: "../PHP/apagarhabilidade.php",
            type: "POST",
            data: { id: id },
         dataType: "html"
    }).done(function(resp) {
        
    $("main").html(resp); 
    }).fail(function(jqXHR, textStatus) {
    alert("Falha na requisição AJAX: " + textStatus);
    }).always(function() {
    console.log("Requisição AJAX apagar habilidade concluída");
    });
 
    }
}

// fim função apagar habilidade -------------------------------------------------------------------------------------------------------------------------------------

// função modal editar habilidade -----------------------------------------------------------------------------------------------------------------------------------------------

function ModalEditarHabilidade(botao){
    id=botao.id;
    $.ajax({
        url: "../PHP/ExibirModalEditarHabilidade.php",
        type: "POST",
        data: { id: id },
    dataType: "html"
}).done(function(resp) {
$("#conteudomodal").html(resp); 
openmodal();
}).fail(function(jqXHR, textStatus) {
alert("Falha na requisição AJAX: " + textStatus);
}).always(function() {
console.log("Requisição AJAX exibir modal editar habilidade concluída");
});
}

// fim função modal editar habilidade -------------------------------------------------------------------------------------------------------------------------------------------

// função editar habilidade ------------------------------------------------------------------------------------------------------------------------------------------------------------------

function EditarHabilidade(botao){
    let id = botao.id;
    let LV_HABILIDADE = document.getElementById("LV_HABILIDADE").value;
    let NM_HABILIDADE = document.getElementById("NM_HABILIDADE").value;
    let DS_HABILIDADE = document.getElementById("DS_HABILIDADE").value;

        $.ajax({
            url: "../PHP/EditarHabilidade.php",
            type: "POST",
            data: {LV_HABILIDADE: LV_HABILIDADE, NM_HABILIDADE: NM_HABILIDADE, DS_HABILIDADE: DS_HABILIDADE, id: id},
            dataType: "html"
        }).done(function(resposta) {
           $(".respmodal").append(resposta);
            
            // carrega novamente os cards, já que foi adicionado um novo
            $.ajax({
                url: "../PHP/exibirhabilidades.php",
                type: "POST",
                data: { acao: "verificar" },
            dataType: "html"
        }).done(function(resp) {
        $("main").html(resp); 
        }).fail(function(jqXHR, textStatus) {
        alert("Falha na requisição AJAX: " + textStatus);
        }).always(function() {
        console.log("Requisição AJAX carregar habilidades concluída");
        });
        


        }).fail(function(jqXHR, textStatus ) {
            console.log("Request failed: " + textStatus);
        }).always(function() {
            console.log("requisicão ajax editar habilidade concluida");            
        });

}

// fim função editar habilidade ------------------------------------------------------------------------------------------------------------------------------------------------------------