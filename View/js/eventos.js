
function formataData(data){
    let dataA = data.split("-");
    let horaA = dataA[2].split("T");
    let horaF = "";
    if(parseInt(horaA[1]) <= 9){
        horaF= "0"+horaA[1];
    }else{
        horaF = horaA[1];
    }
    let dataFormatada = ""+horaA[0]+"-"+dataA[1]+"-"+dataA[0]+"T"+horaF;
    return dataFormatada;
}

function atualizaTabela(data,idEvent){
    let dataIni = formataData(data.Event.StartDateTime);
    let dataFim = formataData(data.Event.EndDateTime);
    let nomeEvento = "";
    if(jQuery.isEmptyObject(data.Event.Title)){
        data.Event.Title = "";
        nomeEvento = data.Event.Description
    }
    if(jQuery.isEmptyObject(data.Event.InstructorName)){
        data.Event.InstructorName = "";
    }
    if(jQuery.isEmptyObject(data.Event.Description)){
        data.Event.Description = "";
        nomeEvento = data.Event.Title
    }
    let linha = "";
    if(!jQuery.isEmptyObject(data.Event.BookedClients.BookedClient)){
        if(data.Event.BookedClients.BookedClient.length > 1){
            for(let c = 0; c < data.Event.BookedClients.BookedClient.length; c++){
                linha = "<tr><th scope='row' class='text-center'>" + c + "</th><td class='text-center'>" + data.Event.BookedClients.BookedClient[c].ClientName + "</td><td class='text-center'>" + data.Event.BookedClients.BookedClient[c].UserName + "</td>";
                linha = linha.concat("<td class='text-center'>" + data.Event.BookedClients.BookedClient[c].SeatID + "</td>");
                linha = linha.concat("<td class=text-center><button type='button' data-value='"+data.Event.BookedClients.BookedClient[c].ClientID+"' class='btn-sm btn btn-outline-danger btnRemoverAlunoEvento'>Remover</button></td></tr>");
                $("#tabelaVagas tbody").append(linha);

            }
        }else{
            linha = "<tr><th scope='row' class='text-center'> 1 </th><td class='text-center'>" + data.Event.BookedClients.BookedClient.ClientName + "</td><td class='text-center'>" + data.Event.BookedClients.BookedClient.UserName + "</td>";
                linha = linha.concat("<td class='text-center'>" + data.Event.BookedClients.BookedClient.SeatID + "</td>");
                linha = linha.concat("<td class=text-center><button type='button' data-value='"+data.Event.BookedClients.BookedClient.ClientID+"' class='btn-sm btn btn-outline-danger btnRemoverAlunoEvento'>Remover</button></td></tr>");
                $("#tabelaVagas tbody").append(linha);
        }
    }
    $("#eventoID").val(idEvent);
    $("#spivi-evento-edita-nome").val(nomeEvento);
    $("#spivi-evento-edita-data-inicio").val(dataIni);
    $("#spivi-evento-edita-data-fim").val(dataFim);
    $("#spivi-evento-edita-professor").val(data.Event.InstructorName);
    $("#labelVagas").html("Vagas disponíveis: "+data.Event.AvailableSeats.AvailableSeat.length);
}

$(document).ready(function () {
    var clientes = [];

    $("#spivi-evento-data-inicial").change(function () {
        if ($(this).val().length > 0) {
            $(this).removeClass("is-invalid");
        }else{
            $(this).addClass("is-invalid");
        }
    });

    $("#spivi-evento-data-final").change(function () {
        if ($(this).val().length > 0) {
            $(this).removeClass("is-invalid");
        }else{
            $(this).addClass("is-invalid");
        }
    });

    
    $("#modal-adiciona-evento").on("show.bs.modal", function (e) {
        $("#spivi-evento-professor").empty()
        $.ajax({
            url: "usuarios/pesquisa_professor",
            type: "GET",
            beforeSend: function () {
                document.getElementById("loadingModel").className = "loading_v";
            },
            success: function (data) {
                data = JSON.parse(data);
                console.log(data);
                if (data.Client.length > 1) {
                    for (let i = 0; i < data.Client.length; i++) {
                        $('#spivi-evento-professor').append($('<option>', {
                            value: data.Client[i].Email,
                            text: data.Client[i].DisplayName
                        }));
                    }
                } else {
                    $('#spivi-evento-professor').append($('<option>', {
                        value: data.Client.Email,
                        text: data.Client.DisplayName
                    }));
                }
                document.getElementById("loadingModel").className = "loading_b";
            },
            error: function (xhr, status, error) {
                document.getElementById("loadingModel").className = "loading_b";
                console.log(xhr.responseText);
            }
        });
    });

    $("#botaoPesquisaUsuario").click(function () {
        $("#tabelaResultadoPesquisa tbody").html("");
        const DATA_INI = $("#pesquisaDataInicio").val();
        const DATA_FIM = $("#pesquisaDataFim").val();
        let url = "eventos/pesquisa_evento";
        $.ajax({
            url: url,
            type: "GET",
            data: {
                data_ini: DATA_INI,
                data_fim: DATA_FIM
            },
            beforeSend: function () {
                document.getElementById("loading").className = "loading_v";
            },
            success: function (data) {
                data = JSON.parse(data);
                console.log(data);
                let linha = ""
                if(!jQuery.isEmptyObject(data.Event)){
                    if(data.Event.length > 1){
                        for(let i = 0; i < data.Event.length; i++){
                            let nomeEvento = "";
                            if(jQuery.isEmptyObject(data.Event[i].Title)){
                                data.Event[i].Title = "";
                                nomeEvento = data.Event[i].Description; 
                            }
                            if(jQuery.isEmptyObject(data.Event[i].InstructorName)){
                                data.Event[i].InstructorName = "";
                            }
                            if(jQuery.isEmptyObject(data.Event[i].Description)){
                                data.Event[i].Description = "";
                                nomeEvento = data.Event[i].Title; 
                            }

                            let dataIni = new Date(formataData(data.Event[i].StartDateTime));
                            let dataFim = new Date(formataData(data.Event[i].EndDateTime));

                            if(data.Event[i].IsCancelled == 0){
                                linha = "<tr><th scope='row' class='text-center'>" + i + "</th><td class='text-center'>" + nomeEvento + "</td><td class='text-center'>" + data.Event[i].InstructorName + "</td>";
                                linha = linha.concat("<td class='text-center'>" + dataIni.toLocaleDateString("pt-BR")+" "+dataIni.toLocaleTimeString("pt-BR",{hour: '2-digit', minute:'2-digit'}) + "</td><td class='text-center'>" + dataFim.toLocaleDateString("pt-BR")+" "+dataFim.toLocaleTimeString("pt-BR",{hour: '2-digit', minute:'2-digit'}) + "</td>");
                                linha = linha.concat("<td class=text-center><img data-bs-toggle='modal' data-value='"+data.Event[i].EventID+"' data-bs-target='#modal-edita-aluno' style='width:25px;cursor:pointer' src='../View/images/icons/pencil-square.svg'></i></td></tr>");
                                $("#tabelaResultadoPesquisa tbody").append(linha);
                            }                           
                        }
                    }else{
                        let nomeEvento = "";
                        if(jQuery.isEmptyObject(data.Event.Title)){
                            data.Event.Title = "";
                            nomeEvento = data.Event.Description; 
                        }
                        if(jQuery.isEmptyObject(data.Event.InstructorName)){
                            data.Event.InstructorName = "";
                        }
                        if(jQuery.isEmptyObject(data.Event.Description)){
                            data.Event.Description = "";
                            nomeEvento = data.Event.Title; 
                        }

                        let dataIni = new Date(formataData(data.Event.StartDateTime));
                        let dataFim = new Date(formataData(data.Event.EndDateTime));

                        if(data.Event.IsCancelled == 0){
                            linha = "<tr><th scope='row' class='text-center'>" + i + "</th><td class='text-center'>" + nomeEvento + "</td><td class='text-center'>" + data.Event.InstructorName + "</td>";
                            linha = linha.concat("<td class='text-center'>" + dataIni.toLocaleDateString("pt-BR")+" "+dataIni.toLocaleTimeString("pt-BR",{hour: '2-digit', minute:'2-digit'}) + "</td><td class='text-center'>" + dataFim.toLocaleDateString("pt-BR")+" "+dataFim.toLocaleTimeString("pt-BR",{hour: '2-digit', minute:'2-digit'}) + "</td>");
                            linha = linha.concat("<td class=text-center><img data-bs-toggle='modal' data-value='"+data.Event.EventID+"' data-bs-target='#modal-edita-aluno' style='width:25px;cursor:pointer' src='../View/images/icons/pencil-square.svg'></i></td></tr>");
                            $("#tabelaResultadoPesquisa tbody").append(linha);
                        }
                    }
            }

                    document.getElementById("loading").className = "loading_b";
            },
            error: function (xhr, status, error) {
                document.getElementById("loading").className = "loading_b";
                console.log(xhr.responseText);
            }
        })
    });

    $("#btnProcuraCliente").click(function(){
        $("#autocompleteClient").css("visibility","visible");
    });

    $("#autocompleteClient").keydown(function(){
        var clientes = [];
        if($(this).val().length >= 3){
            $.ajax({
                url: 'usuarios/pesquisa_nome',
                type: 'GET',
                data: {
                    valor: $(this).val()
                },
                success: function(data){
                    console.log(data);
                    data = JSON.parse(data);
                    clientes.push(data);
                },
                complete: function(){
                    
                    $("#autocompleteClient").autocomplete({
                        source: clientes
                    });
                }
                
            })
        }
    });

    $("#btn-adiciona-evento").click(function () {
        if (($("#spivi-evento-data-inicial").val().length <= 0 || $("#spivi-evento-data-final").val().length <= 0) && $("#selectEvento :selected").val() == 0) {
            $("#spivi-evento-data-inicial").addClass("is-invalid");
            $("#spivi-evento-data-final").addClass("is-invalid");
        } else {
            if ($("#spivi-evento-professor :selected").val() == 0) {
                $("#spivi-evento-professor").addClass("is-invalid");
            } else {
                const NOME = $("#spivi-evento-nome").val();
                const DATA_INI = $("#spivi-evento-data-inicial").val();
                const DATA_FIM = $("#spivi-evento-data-final").val();
                const PROFESSOR = $("#spivi-evento-professor :selected").val();
                const DESCRICAO = $("#spivi-evento-descricao").val();
                $.ajax({
                    type: "POST",
                    url: "eventos/insere_evento",
                    data: {
                        nome: NOME,
                        data_inicial: DATA_INI,
                        data_fim: DATA_FIM,
                        professor: PROFESSOR,
                        descricao: DESCRICAO
                    },
                    beforeSend: function () {
                        document.getElementById("loadingModel").className = "loading_v";
                    },
                    success: function (data) {
                        data = JSON.parse(data);
                        $(".div-retorno").show(function () {
                            if (data.ErrorCode) {
                                $(".mensagem-retorno").text(data.message);
                            }else{
                                $(".mensagem-retorno").text("Evento criado com sucesso.");

                            }
                            $(".div-retorno").fadeIn("slow", function () {
                                $(".div-retorno").delay(4000).fadeOut('slow');
                            });
                        });
                        document.getElementById("loadingModel").className = "loading_b";
                    },
                    error: function (xhr, status, error) {
                        document.getElementById("loadingModel").className = "loading_b";
                        console.log(xhr.responseText);
                    }
                });
            }
        }
    });

    $("#modal-edita-aluno").on("show.bs.modal", function (e) {
        let idEvent = $(e.relatedTarget).data('value');
        console.log(idEvent);
        $.ajax({
            url: 'eventos/pesquisa_evento_id',
            type: 'GET',
            data:{
                valor: idEvent
            },
            beforeSend: function () {
                document.getElementById("loadingModel2").className = "loading_v";
            },
            success: function(data){
                data = JSON.parse(data);
                $("#tabelaVagas tbody").html("");
                console.log(data);
                atualizaTabela(data,idEvent);
                document.getElementById("loadingModel2").className = "loading_b";
            },
            error: function (xhr, status, error) {
                document.getElementById("loadingModel2").className = "loading_b";
                console.log(xhr.responseText);
            },complete: function(){
                $(".btnRemoverAlunoEvento").click(function(){
                    let idCliente = $(this).data("value");
                    $.ajax({
                        url: 'eventos/remove_usuario_evento',
                        type: 'POST',
                        data:{
                            idCliente: idCliente,
                            idEvento: idEvent
                        },
                        success: function(data){
                            console.log(data);
                        },
                        error: function(xhr,status,error){
                            console.log(xhr.responseText);
                        }
                    })
                });
            }
        })
    });

    // $("input[name^='spivi'], select[name^='spivi']").change(function () {
    //     if(
    //         $("#spivi-evento-nome").val().length > 0 && 
    //         $("#spivi-evento-data-inicial").val().length > 0 &&
    //         $("#spivi-evento-data-final").val().length > 0 &&
    //         $("#spivi-evento-professor :selected").val() != 0
    //     ){
    //         $("#btn-adiciona-evento").attr("disabled", false);
    //     }
    // });
    // $("#campoPesquisaAluno").keyup(function () {
    //     if ($("#campoPesquisaAluno").val().length > 0) {
    //         $("#btnPesquisaAluno").attr("disabled", false);
    //     } else {
    //         $("#btnPesquisaAluno").attr("disabled", true);
    //     }
    // });

    $("#btn-aplica-atualizacao").click(function () {
        const NOME = $("#spivi-nome").val();
        const ENDERECO = $("#spivi-endereco").val();
        const EMAIL = $("#spivi-email").val();
        const FTP = $("#spivi-ftp").val();
        const LTHR = $("#spivi-lthr").val();
        const PESO = $("#spivi-peso").val();
        const ALTURA = $("#spivi-altura").val();
        const RHR = $("#spivi-rhr").val();
        const PST = $("#spivi-pst").val();
        const CIDADE = $("#spivi-cidade").val();
        const CEL = $("#spivi-cel").val();
        const DEVICE_ID = $("#spivi-device-id").val();
        $.ajax({
            url: "usuarios/atualiza_aluno",
            type: "POST",
            data: {
                nome: NOME,
                endereco: ENDERECO,
                email: EMAIL,
                FTP: FTP,
                LTHR: LTHR,
                peso: PESO,
                altura: ALTURA,
                RHR: RHR,
                PST: PST,
                cidade: CIDADE,
                celular: CEL,
                device_id: DEVICE_ID
            },
            beforeSend: function () {
                document.getElementById("loadingModel2").className = "loading_v";
            },
            success: function (data) {
                data = JSON.parse(data);
                document.getElementById("loadingModel2").className = "loading_b";
                $(".div-retorno").show(function () {
                    if (data.Code[0]) {
                        $(".mensagem-retorno").text(data.Message[0]);
                    } else {
                        $(".mensagem-retorno").text(data.Message);
                    }
                    $(".div-retorno").fadeIn("slow", function () {
                        $(".div-retorno").delay(4000).fadeOut('slow');
                    });
                });
            },
            error: function (xhr, status, error) {
                document.getElementById("loadingModel2").className = "loading_b";
                console.log(xhr.responseText);
            }
        });
    });
    $("#deleta-evento").click(function () {
        const idEvento = $("#eventoID").val();
        $.ajax({
            url: "eventos/deleta_evento",
            type: "POST",
            data: {
                idEvento: idEvento
            },
            beforeSend: function () {
                document.getElementById("loadingModel2").className = "loading_v";
            },
            success: function (data) {
                data = JSON.parse(data);
                $(".div-retorno").show(function () {
                    if (data.Code[0]) {
                        $(".mensagem-retorno").text(data.Message[0]);
                    } else {
                        $(".mensagem-retorno").text(data.Message);
                    }
                    $(".div-retorno").fadeIn("slow", function () {
                        $(".div-retorno").delay(3000).fadeOut('slow',function(){
                            location.reload();
                        });
                    });
                });
                document.getElementById("loadingModel2").className = "loading_b";
            },
            error: function (xhr, status, error) {
                document.getElementById("loadingModel2").className = "loading_b";
                console.log(xhr.responseText);
            }
        })
    });
});