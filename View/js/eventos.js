
$(document).ready(function () {

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
                let linha = ""
                if(data.Event.length > 1){
                    for(let i = 0; i < data.Event.length; i++){
                        linha = "<tr><th scope='row' class='text-center'>" + i + "</th><td class='text-center'>" + data.Event[i].Description + "</td><td class='text-center'>" + data.Event[i].InstructorName + "</td><td class='text-center'>" + data.Event[i].Description + "</td>";
                        linha = linha.concat("<td class='text-center'>" + data.Event[i].StartDateTime + "</td><td class='text-center'>" + data.Event[i].EndDateTime + "</td>");
                        //linha = linha.concat("<td class=text-center><img data-bs-toggle='modal' data-value='"+data.Event[i].EventID+"' data-bs-target='#modal-edita-aluno' style='width:25px;cursor:pointer' src='../View/images/icons/pencil-square.svg'></i></td></tr>");
                        $("#tabelaResultadoPesquisa tbody").append(linha);
                    }
                }else{
                    linha = "<tr><th scope='row' class='text-center'>" + i + "</th><td class='text-center'>" + data.Event.Description + "</td><td class='text-center'>" + data.Event.InstructorName + "</td><td class='text-center'>" + data.Event.Description + "</td>";
                    linha = linha.concat("<td class='text-center'>" + data.Event.StartDateTime + "</td><td class='text-center'>" + data.Event.EndDateTime + "</td>");
                    //linha = linha.concat("<td class=text-center><img data-bs-toggle='modal' data-value='"+data.Event.EventID+"' data-bs-target='#modal-edita-aluno' style='width:25px;cursor:pointer' src='../View/images/icons/pencil-square.svg'></i></td></tr>");
                    $("#tabelaResultadoPesquisa tbody").append(linha);
                }

                console.log(data);
                document.getElementById("loading").className = "loading_b";
            },
            error: function (xhr, status, error) {
                document.getElementById("loading").className = "loading_b";
                console.log(xhr.responseText);
            }
        })
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
                                $(".mensagem-retorno").text(data.Message);
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
    $("#modal-confirma-inclusao").on("shown.bs.modal", function (e) {
        let value = $(e.relatedTarget).data('value');
        $.ajax({
            type: "GET",
            url: "usuarios/pesquisa_aluno_ux",
            data: {
                valor: value,
                cod_unidade: $("#codUnidade").val()
            },
            beforeSend: function () {
                document.getElementById("loadingModel1").className = "loading_v";
            },
            success: function (data) {
                data = JSON.parse(data);
                //user001
                if ($("#codUnidade").val() == "00") {
                    $("#foto-conf").attr("src", "https://ux.ultrafit.com.br/ControlGym/View/fotos/user001.png")
                } else {
                    $("#foto-conf").attr("src", "https://ux.ultrafit.com.br/ControlGym/View/fotos/" + data[0].COD_ALUNO + ".png")
                }
                $("#cod_aluno_confirma").html("<b>Cód. Aluno:</b>" + data[0].COD_ALUNO);
                $("#nome_aluno_confirma").html("<b>Nome:</b>" + data[0].NOME_INICIAL + " " + data[0].NOME_FINAL);
                $("#email_aluno_confirma").html("<b>Email:</b>" + data[0].EMAIL);
                $("#cpf_aluno_confirma").html("<b>CPF:</b>" + data[0].CPF);
                let data_nasc = new Date(data[0].DATA_NASC);
                $("#data_nasc_aluno_confirma").html("<b>Data de nascimento:</b>" + data_nasc.toLocaleDateString("pt-BR"));
                $("#plano_aluno_confirma").html("<b>Plano:</b>" + data[0].PLVIG);
                $("#genero").val(data[0].SEXO);
                $("#endereco").val(data[0].ENDERECO);
                $("#cidade").val(data[0].CIDADE);
                $("#celular").val(data[0].CEL);
                document.getElementById("loadingModel1").className = "loading_b";
            },
            error: function (xhr, status, error) {
                document.getElementById("loadingModel1").className = "loading_b";
                console.log(xhr.responseText);
            }
        });
    });

    $("#btn-aplica-insercao").click(function () {
        let htmlCodAluno = $("#cod_aluno_confirma").html();
        htmlCodAluno = htmlCodAluno.split("</b>");
        let htmlNome = $("#nome_aluno_confirma").html();
        htmlNome = htmlNome.split("</b>");
        let htmlEmail = $("#email_aluno_confirma").html();
        htmlEmail = htmlEmail.split("</b>");
        let htmlCpf = $("#cpf_aluno_confirma").html();
        htmlCpf = htmlCpf.split("</b>");
        let htmlDataNasc = $("#data_nasc_aluno_confirma").html();
        htmlDataNasc = htmlDataNasc.split("</b>");
        let htmlPlano = $("#plano_aluno_confirma").html();
        htmlPlano = htmlPlano.split("</b>");

        const COD_ALUNO = htmlCodAluno[1];
        const NOME = htmlNome[1];
        const CPF = htmlCpf[1];
        const DATA_NASC = htmlDataNasc[1];
        const PLANO = htmlPlano[1];
        const EMAIL = htmlEmail[1];

        $.ajax({
            type: "POST",
            url: "usuarios/insere_usuario_spivi",
            data: {
                cod_aluno: COD_ALUNO,
                nome: NOME,
                cpf: CPF,
                data_nasc: DATA_NASC,
                plano: PLANO,
                email: EMAIL,
                genero: $("#genero").val(),
                endereco: $("#endereco").val(),
                cidade: $("#cidade").val(),
                celular: $("#celular").val(),
                device_id: $("#numberDeviceId").val()
            },
            beforeSend: function () {
                document.getElementById("loadingModel1").className = "loading_v";
            },
            success: function (data) {
                data = JSON.parse(data);
                document.getElementById("loadingModel1").className = "loading_b";
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
                document.getElementById("loadingModel1").className = "loading_b";
                console.log(xhr.responseText);
            }
        })
    });

    $("#modal-edita-aluno").on("show.bs.modal", function (e) {
        let email = $(e.relatedTarget).data('value');
        $.ajax({
            url: 'usuarios/pesquisa_email',
            type: 'GET',
            data: {
                valor: email
            },
            beforeSend: function () {
                document.getElementById("loadingModel2").className = "loading_v";
            },
            success: function (data) {
                data = JSON.parse(data);
                let cor = data.Client.LevelName == "Bronze" ? "#cd7f32" : data.Client.LevelName;
                if (jQuery.isEmptyObject(data.Client.Address)) {
                    data.Client.Address = "";
                }
                if (jQuery.isEmptyObject(data.Client.Phone)) {
                    data.Client.Phone = "";
                }
                if (jQuery.isEmptyObject(data.Client.City)) {
                    data.Client.City = "";
                }
                if (jQuery.isEmptyObject(data.Client.DeviceID)) {
                    data.Client.DeviceID = "";
                }
                $("#spivi-nome").val(data.Client.DisplayName);
                $("#spivi-endereco").val(data.Client.Address ? data.Client.Address : "");
                $("#spivi-email").val(data.Client.Email);
                $("#spivi-level").val(data.Client.LevelName);
                $("#spivi-level").css("background-color", cor)
                $("#spivi-level").css("border-color", cor)
                $("#spivi-ftp").val(data.Client.FTP);
                $("#spivi-lthr").val(data.Client.LTHR);
                $("#spivi-peso").val(data.Client.Weight);
                $("#spivi-altura").val(data.Client.Height);
                $("#spivi-rhr").val(data.Client.RHR);
                $("#spivi-pst").val(data.Client.PST);
                $("#spivi-cidade").val(data.Client.City);
                $("#spivi-cel").val(data.Client.Phone);
                $("#spivi-device-id").val(data.Client.DeviceID);
                document.getElementById("loadingModel2").className = "loading_b";
            },
            error: function (xhr, status, error) {
                document.getElementById("loadingModel2").className = "loading_b";
                console.log(xhr.responseText);
            }
        })
    });

    $("input[name^='spivi'], select[name^='spivi']").change(function () {
        if(
            $("#spivi-evento-nome").val().length > 0 && 
            $("#spivi-evento-data-inicial").val().length > 0 &&
            $("#spivi-evento-data-final").val().length > 0 &&
            $("#spivi-evento-professor :selected").val() != 0
        ){
            $("#btn-adiciona-evento").attr("disabled", false);
        }
    });
    $("#campoPesquisaAluno").keyup(function () {
        if ($("#campoPesquisaAluno").val().length > 0) {
            $("#btnPesquisaAluno").attr("disabled", false);
        } else {
            $("#btnPesquisaAluno").attr("disabled", true);
        }
    });

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
    $("#deleta-cliente").click(function () {
        const EMAIL = $("#spivi-email").val();
        $.ajax({
            url: "usuarios/deleta_aluno",
            type: "POST",
            data: {
                email: EMAIL
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
                        $(".div-retorno").delay(3000).fadeOut('slow');
                        location.reload();
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