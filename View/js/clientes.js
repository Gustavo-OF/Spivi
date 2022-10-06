$(document).ready(function(){
    $("#botaoPesquisaUsuario").click(function(){
        $("#tabelaResultadoPesquisa tbody").html("");
        let tipo = $("#pesquisaEmailUsuario").val().length > 0 ? 1 : 0;
        let pesquisa = tipo == 1 ? $("#pesquisaEmailUsuario").val() : $("#pesquisaNomeUsuario").val();
        let url = tipo == 1 ? "usuarios/pesquisa_email" : "usuarios/pesquisa_nome";
        $.ajax({
            url: url,
            type: "GET",
            data: {
                valor: pesquisa
            },
            success: function(data){
                data = JSON.parse(data);
                console.log(data);
                if(data.Client !== undefined){
                    let linha = "";
                    if(data.Client.length > 1){
                        for(let i=0;i<data.Client.length;i++){

                            linha = "<tr><th scope='row' class='text-center'>"+i+"</th><td class='text-center'>"+data.Client[i].DisplayName+"</td><td class='text-center'>"+data.Client[i].Email+"</td><td class='text-center'>"+data.Client[i].LevelName+"</td>";
                            linha = linha.concat("<td class='text-center'>"+data.Client[i].FTP+" BPM</td><td class='text-center'>"+data.Client[i].LTHR+" BPM</td><td class='text-center'>"+data.Client[i].RHR+" BPM</td>");
                            linha = linha.concat("<td class=text-center><img style='width:25px' src='../View/images/icons/pencil-square.svg'></i></td></tr>");
                            $("#tabelaResultadoPesquisa tbody").append(linha);
                        } 
                    }else{
                        linha = "<tr><th scope='row' class='text-center'>1</th><td class='text-center'>"+data.Client.DisplayName+"</td><td class='text-center'>"+data.Client.Email+"</td><td class='text-center'>"+data.Client.LevelName+"</td>";
                            linha = linha.concat("<td class='text-center'>"+data.Client.FTP+" BPM</td><td class='text-center'>"+data.Client.LTHR+" BPM</td><td class='text-center'>"+data.Client.RHR+" BPM</td>");
                            linha = linha.concat("<td class=text-center><img style='width:25px' src='../View/images/icons/pencil-square.svg'></i></td></tr>");
                            $("#tabelaResultadoPesquisa tbody").append(linha);
                    }
                    $("#divUsuariosDisponiveisPesquisa").show();
                }else{
                    console.log("Não encontrado.");
                }
            },
            error: function(xhr, status, error){
                console.log(xhr.responseText);
            }
        })
    });
    $(".deletaTimeUser").click(function(){
        let times = [];
        let idUsuario = 0;
        $(".timesUsuario:checked").each(function(){
            times.push($(this).val());
            idUsuario = $(this).attr("data-idU");
        });
        $.ajax({
            url: "index.php?tipo=usuarios&acao=deletaTimeUser",
            type: 'POST',
            data:{
                times: times,
                idUser: idUsuario
            },
            success: function(data){
                data = JSON.parse(data);
                location.reload();
            },
            error: function(data){
                console.log(data);
            }

        });
    });

    $("#btnPesquisaAluno").click(function(){
        let valor = $("#campoPesquisaAluno").val();
        $.ajax({
            type: "POST",
            url: "index.php?tipo=usuario&acao=pesquisaAluno",
            data: {
                valor: valor
            },
            success: function(data){
                console.log(data);
            },
            error: function(xhr, status, error){
                console.log(xhr.responseText);
            }
        });
    });
});