$(document).ready(function () {
    $.ajax({
        url:"usuarios/pesquisa_nome",
        type: "GET",
        data:{
            valor: ""
        },
        beforeSend: function () {
            document.getElementById("loading").className = "loading_v";
        },
        success: function(data){
            data = JSON.parse(data);
            for(let i = 0;i < data.Client.length;i++){
                $('#selectAluno').append($('<option>', {
                    value: data.Client[i].Email,
                    text: data.Client[i].DisplayName
                }));
            } 
            document.getElementById("loading").className = "loading_b";
            console.log(data);
        },
        error: function(xhr,status,error){
            document.getElementById("loading").className = "loading_b";
            console.log(xhr.responseText);
        }
    })


    // testar  quando a parte de evento estiver pronta
    // $.ajax({
    //     url: 'evento/pesquisa_evento',
    //     type: 'GET',
    //     success: function(data){
    //         console.log(data);
    //     },
    //     error: function(xhr,status,error){
    //         console.log(xhr.responseText);
    //     }
    // })

    $("#pesquisaDataInicio").change(function(){
        if($(this).val().length > 0){
            $(this).removeClass("is-invalid");
        }
    });

    $("#pesquisaDataFim").change(function(){
        if($(this).val().length > 0){
            $(this).removeClass("is-invalid");
        }
    });

    $("#selectAluno").change(function(){
        if($(this).val() != 0){
            $(this).removeClass("is-invalid");
        }
    });

    $("#botaoPesquisaUsuario").click(function () {
        if($("#pesquisaDataInicio").val().length <= 0){
            $("#pesquisaDataInicio").addClass("is-invalid");
            $("#pesquisaDataFim").addClass("is-invalid");
        }else{
            if($("#selectAluno :selected").val() == 0){
                $("#selectAluno").addClass("is-invalid");
            }else{
                $("#tabelaResultadoPesquisa tbody").html("");
                const EMAIL = $("#selectAluno :selected").val();
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
                        data = JSON.parse(data);
                        console.log(data);
                        // let cor = "";
                        // if (data.Client !== undefined) {
                        //     let linha = "";
                        //     if (data.Client.length > 1) {
                        //         for (let i = 0; i < data.Client.length; i++) {
                        //             cor = data.Client[i].LevelName=="Bronze" ? "#cd7f32" : data.Client[i].LevelName;
                        //             linha = "<tr><th scope='row' class='text-center'>" + i + "</th><td class='text-center'>" + data.Client[i].DisplayName + "</td><td class='text-center'>" + data.Client[i].Email + "</td><td class='text-center' style='color:"+cor+"'>" + data.Client[i].LevelName + "</td>";
                        //             linha = linha.concat("<td class='text-center'>" + data.Client[i].FTP + " BPM</td><td class='text-center'>" + data.Client[i].LTHR + " BPM</td><td class='text-center'>" + data.Client[i].RHR + " BPM</td>");
                        //             linha = linha.concat("<td class=text-center><img data-bs-toggle='modal' data-value='"+data.Client[i].Email+"' data-bs-target='#modal-edita-aluno' style='width:25px;cursor:pointer' src='../View/images/icons/pencil-square.svg'></i></td></tr>");
                        //             $("#tabelaResultadoPesquisa tbody").append(linha);
                        //         }
                        //     } else {
                        //         cor = data.Client.LevelName=="Bronze" ? "#cd7f32" : data.Client.LevelName;
                        //         linha = "<tr><th scope='row' class='text-center'>1</th><td class='text-center'>" + data.Client.DisplayName + "</td><td class='text-center'>" + data.Client.Email + "</td><td class='text-center' style='color:"+cor+"'>" + data.Client.LevelName + "</td>";
                        //         linha = linha.concat("<td class='text-center'>" + data.Client.FTP + " BPM</td><td class='text-center'>" + data.Client.LTHR + " BPM</td><td class='text-center'>" + data.Client.RHR + " BPM</td>");
                        //         linha = linha.concat("<td class=text-center><img data-bs-toggle='modal' data-value='"+data.Client.Email+"' data-bs-target='#modal-edita-aluno' style='width:25px;cursor:pointer' src='../View/images/icons/pencil-square.svg'></i></td></tr>");
                        //         $("#tabelaResultadoPesquisa tbody").append(linha);
                        //     }
                        //     $("#divUsuariosDisponiveisPesquisa").show();
                        // } else {
                        //     console.log("Não encontrado.");
                        // }
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