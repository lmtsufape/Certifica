var campoanexo = document.getElementById('anexo');
var campoArquivo = document.getElementById('arquivo');

campoanexo.addEventListener('change', (e) => {

    var string = e.target.value

    var dados = string.split(/[\\"]/g)

    campoArquivo.value = dados[dados.length - 1]
})

$('#select_natureza').change(function () {
    var natureza = $('#select_natureza').val();

    $.ajax({
        url: '/acao/get/tipo_natureza/' + natureza,
        type: 'GET',
        dataType: 'json',
        success: function (tipo_naturezas) {
            var select = $('#select_tipo_natureza');
            select.empty();

            $.each(tipo_naturezas, function (index, item) {
                select.append($('<option></option>').val(item.id).text(item.descricao));
            });
        }
    });
});

   
