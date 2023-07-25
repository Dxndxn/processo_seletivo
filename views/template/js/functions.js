$(document).ready(function() {
    $("#CLIENTE_CEP").mask("99.999-999");
    $("#CLIENTE_CPF").mask("999.999.999-99");
    console.log("Aplicando mascaras")
});

function check() {
    if ($( "#nav-toggle" ).hasClass( "rotate-icon" )) {
        $("#logoSquare").css("display", "block");
    } else {
        $("#logoSquare").css("display", "none");
    }
}

$(document).ready(function() {
    $('#CLIENTE_CPF').blur(function()
    {
        var CPF = $('#CLIENTE_CPF').val().replace(/[^0-9]/g, '').toString();
        if(CPF.length == 11 )
        {
            var v = [];
            v[0] = 1 * CPF[0] + 2 * CPF[1] + 3 * CPF[2];
            v[0] += 4 * CPF[3] + 5 * CPF[4] + 6 * CPF[5];
            v[0] += 7 * CPF[6] + 8 * CPF[7] + 9 * CPF[8];
            v[0] = v[0] % 11;
            v[0] = v[0] % 10;
            v[1] = 1 * CPF[1] + 2 * CPF[2] + 3 * CPF[3];
            v[1] += 4 * CPF[4] + 5 * CPF[5] + 6 * CPF[6];
            v[1] += 7 * CPF[7] + 8 * CPF[8] + 9 * v[0];
            v[1] = v[1] % 11;
            v[1] = v[1] % 10;
            if ( (v[0] != CPF[9]) || (v[1] != CPF[10]) )
            {
                alert('CPF inválido: ' + CPF);

                $('#CLIENTE_CPF').val('');
            }
        }
        else
        {
            alert('CPF inválido:' + CPF);
            $('#CLIENTE_CPF').val('');
        }
    });
});

$(document).ready(function() {
    $("#CLIENTE_CEP").blur(function() {
        var CEP = $(this).val().replace(/[^0-9]/, '');
        if (CEP) {
            var url = 'https://viacep.com.br/ws/' + CEP + '/json/';
            $.ajax({
                url: url,
                dataType: 'jsonp',
                crossDomain: true,
                contentType: "application/json",
                success: function(json) {
                    if (json.logradouro) {
                        $("#CLIENTE_ENDERECO").val(json.logradouro);
                        $("#CLIENTE_BAIRRO").val(json.bairro);
                        $("#CLIENTE_CIDADE").val(json.localidade);
                        $("#CLIENTE_ESTADO").val(json.uf);
                    }
                },
                error: function (json) {
                    alert("O CEP digitado não foi encontrado.");
                }
            });
        }
    });
});


