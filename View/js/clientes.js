$(document).ready(function () {
    $("#botaoPesquisaUsuario").click(function () {
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
            beforeSend: function () {
                document.getElementById("loading").className = "loading_v";
            },
            success: function (data) {
                data = JSON.parse(data);
                console.log(data);
                if (data.Client !== undefined) {
                    let linha = "";
                    if (data.Client.length > 1) {
                        for (let i = 0; i < data.Client.length; i++) {

                            linha = "<tr><th scope='row' class='text-center'>" + i + "</th><td class='text-center'>" + data.Client[i].DisplayName + "</td><td class='text-center'>" + data.Client[i].Email + "</td><td class='text-center'>" + data.Client[i].LevelName + "</td>";
                            linha = linha.concat("<td class='text-center'>" + data.Client[i].FTP + " BPM</td><td class='text-center'>" + data.Client[i].LTHR + " BPM</td><td class='text-center'>" + data.Client[i].RHR + " BPM</td>");
                            linha = linha.concat("<td class=text-center><img style='width:25px' src='../View/images/icons/pencil-square.svg'></i></td></tr>");
                            $("#tabelaResultadoPesquisa tbody").append(linha);
                        }
                    } else {
                        linha = "<tr><th scope='row' class='text-center'>1</th><td class='text-center'>" + data.Client.DisplayName + "</td><td class='text-center'>" + data.Client.Email + "</td><td class='text-center'>" + data.Client.LevelName + "</td>";
                        linha = linha.concat("<td class='text-center'>" + data.Client.FTP + " BPM</td><td class='text-center'>" + data.Client.LTHR + " BPM</td><td class='text-center'>" + data.Client.RHR + " BPM</td>");
                        linha = linha.concat("<td class=text-center><img style='width:25px' src='../View/images/icons/pencil-square.svg'></i></td></tr>");
                        $("#tabelaResultadoPesquisa tbody").append(linha);
                    }
                    $("#divUsuariosDisponiveisPesquisa").show();
                } else {
                    console.log("Não encontrado.");
                }
                document.getElementById("loading").className = "loading_b";
            },
            error: function (xhr, status, error) {
                document.getElementById("loading").className = "loading_b";
                console.log(xhr.responseText);
            }
        })
    });

    $("#btnPesquisaAluno").click(function () {
        let valor = $("#campoPesquisaAluno").val();
        $.ajax({
            type: "GET",
            url: "usuarios/pesquisa_aluno_ux",
            data: {
                valor: valor,
                cod_unidade: $("#codUnidade").val()
            },
            success: function (data) {
                data = JSON.parse(data);
                if (data.length > 0) {
                    for (let i = 0; i < data.length; i++) {
                        $("#tabela-convidado tbody").append(
                            "<tr data-dismiss='modal' data-toggle='modal' href='#modal-confirmar-convite' style='width:100%;table-layout:fixed;cursor: pointer' data-value=" + data[i].COD_ALUNO + ">" +
                            "<td>" + data[i].COD_ALUNO + "</td>" +
                            "<td>" + data[i].NOME_INICIAL + "<br/>" + data[i].NOME_FINAL + "</td>" +
                            "<td>" + data[i].CPF + "</td>" +
                            "<td>" + data[i].TIPO + "</td>" +
                            "</tr>"
                        );
                    }
                    if ($("#div-not-found").show()) {
                        $("#div-not-found").hide()
                    }
                    $("#tabela-convidado").show();
                } else {
                    if ($("#tabela-convidado").show()) {
                        $("#tabela-convidado").hide();
                    }
                    $("#div-not-found").show();
                }
                console.log(data);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });
});