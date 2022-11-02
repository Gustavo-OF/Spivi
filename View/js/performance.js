$(document).ready(function () {
    $("#pesquisaNomeUsuario").keyup(function(){
        var clientes = [];
        if($(this).val().length >= 3){
            $.ajax({
                url: 'usuarios/pesquisa_nome',
                type: 'GET',
                data: {
                    valor: $(this).val()
                },
                beforeSend:function(){
                    $("#pesquisaNomeUsuario").prop("disabled",true)
                },
                success: function(data){
                    data = JSON.parse(data);
                    console.log(data);
                    if(!jQuery.isEmptyObject(data.Client)){
                        for(let i = 0; i < data.Client.length;i++){
                            clientes.push({"label": data.Client[i].DisplayName+" - "+data.Client[i].Email,"value": data.Client[i].DisplayName,"email":data.Client[i].Email});
                        }
                    }
                },
                error: function(xhr,status,error){
                    $("#pesquisaNomeUsuario").prop("disabled",false);
                },
                complete: function(){
                    $("#pesquisaNomeUsuario").autocomplete({
                        source: clientes,
                        select: function(e, i){
                            $("#emailAluno").val(i.item.email);
                           //adicionaAluno(i.item.value,i.item.vaga,idEvento)
                        }
                    });
                    $("#pesquisaNomeUsuario").autocomplete("search");
                    $("#pesquisaNomeUsuario").prop("disabled",false);
                    $("#pesquisaNomeUsuario").focus();

                }   
                
            })
        }
    });


    $.ajax({
        url: 'eventos/pesquisa_evento',
        type: 'GET',
        data: {
            data_ini: "",
            data_fim: "",
        },
        success: function(data){
            data = JSON.parse(data);
            console.log(data);
            if(data.Event !== undefined){
                if(data.Event.length > 1){
                    for (let i = 0; i < data.Event.length; i++) {
                        if(jQuery.isEmptyObject(data.Event[i].Title)){
                            data.Event[i].Title = "SEM NOME"; 
                        }
                        $('#selectEvento').append($('<option>', {
                            value: data.Event[i].EventID,
                            text: data.Event[i].Title+" - "+data.Event[i].StartDateTime+" - "+data.Event[i].EndDateTime
                        }));
                    }
                }else{
                    if(jQuery.isEmptyObject(data.Event.Title)){
                        data.Event.Title = "SEM NOME"; 
                    }
                    $('#selectEvento').append($('<option>', {
                        value: data.Event.EventID,
                        text: data.Event.Title+" - "+data.Event.StartDateTime+" - "+data.Event.EndDateTime
                    }));
                }
            }

        },
        error: function(xhr,status,error){
            console.log(xhr.responseText);
        }
    })

    $("#selectEvento").change(function(){
        if($(this).val() != 0){
            $("#pesquisaDataInicio").attr("disabled",true);
            $("#pesquisaDataFim").attr("disabled",true);
        }else{
            $("#pesquisaDataInicio").attr("disabled",false);
            $("#pesquisaDataFim").attr("disabled",false);
        }
    });

    $("#pesquisaDataInicio,pesquisaDataFim").change(function(){
        if($("#pesquisaDataInicio").val().length > 0 || $("#pesquisaDataFim").val().length > 0){
            $("#selectEvento").attr("disabled",true)
        }else{
            $("#selectEvento").attr("disabled",false);
        }
    })

    $("#pesquisaDataInicio").change(function () {
        if ($(this).val().length > 0) {
            $(this).removeClass("is-invalid");
        }
    });

    $("#pesquisaDataFim").change(function () {
        if ($(this).val().length > 0) {
            $(this).removeClass("is-invalid");
        }
    });

    $("#selectAluno").change(function () {
        if ($(this).val() != 0) {
            $(this).removeClass("is-invalid");
        }
    });

    $("#botaoPesquisaUsuario").click(function () {
        if (($("#pesquisaDataInicio").val().length <= 0 || $("#pesquisaDataFim").val().length <= 0) && $("#selectEvento :selected").val() == 0) {
            $("#pesquisaDataInicio").addClass("is-invalid");
            $("#pesquisaDataFim").addClass("is-invalid");
        } else {
            if ($("#selectAluno :selected").val() == 0) {
                $("#selectAluno").addClass("is-invalid");
            } else {
                $("#tabelaResultadoPesquisa tbody").html("");
                const EMAIL = $("#emailAluno").val();
                const DATA_INICIO = $("#pesquisaDataInicio").val();
                const DATA_FIM = $("#pesquisaDataFim").val();
                const ID_EVENTO = $("#selectEvento :selected").val();
                const URL = "usuarios/pesquisa_performance";
                $.ajax({
                    url: URL,
                    type: "GET",
                    data: {
                        email: EMAIL,
                        data_inicio: DATA_INICIO,
                        data_fim: DATA_FIM,
                        idEvento: ID_EVENTO
                    },
                    beforeSend: function () {
                        document.getElementById("loading").className = "loading_v";
                    },
                    success: function (data) {
                        let nomeCliente = $("#pesquisaNomeUsuario").val();
                        data = JSON.parse(data);
                        console.log(data);
                        if (data.Workout !== undefined) {
                            let linha = "";
                            linha = "<tr><th scope='row' class='text-center'>1</th><td class='text-center'>" + nomeCliente + "</td><td class='text-center'>" + data.Workout.WorkoutName + "</td><td class='text-center'>" + data.Workout.Calories + "</td>";
                            linha = linha.concat("<td class='text-center'>" + data.Workout.TotalSEP + "</td><td class='text-center'>" + data.Workout.TotalWPP+ "</td>");
                            linha = linha.concat("<td class='text-center'>"+data.Workout.AvgHR+" BPM</td>")
                            //linha = linha.concat("<td class=text-center><img data-bs-toggle='modal' data-value='" + data.Client.Email + "' data-bs-target='#modal-edita-aluno' style='width:25px;cursor:pointer' src='../View/images/icons/pencil-square.svg'></i></td></tr>");
                            $("#tabelaResultadoPesquisa tbody").append(linha);

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
                });
            }
        }
    });
});