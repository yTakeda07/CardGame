window.onload = function() { //quando a pagina carregar
    const paginaAtual = window.location.pathname.split('/').pop();
        //define qual é a pagina atual
if(paginaAtual === "index.html"){
    //se a pagina atual for index.html, faça
    $.ajax({
        url: "PHP/login.php",
        type: "POST",
        data: { acao: "verificar" },
     dataType: "html"
}).done(function(resp) {
$("main").html(resp); 
}).fail(function(jqXHR, textStatus) {
alert("Falha na requisição AJAX: " + textStatus);
}).always(function() {
console.log("Requisição AJAX verificar login ao carregar tela concluída");
});


}else{}
};

//  ajax login--------------------------------------------------------------

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
