
function cambioGrupo() {
    var $grupo = $('#unam_appbundle_pago_grupo');
    var params = '?grupoId=' + $grupo.val();
    $.ajax({
        url: '/curso/precio' + params,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            var json = data;
            if (json.status == 'Ok') {
                var $precio = $('#unam_appbundle_pago_precio');
                var $cursoLeyenda = $('#grupo_curso');
                $precio.val(json.precio);
                $cursoLeyenda.text('Curso: ' + json.curso);
                cambioPrecioOPago();
            } else {
                alert('No se pudo recuperar datos');
            }
        },
        error: function (err) {
            alert('No se pudo recuperar datos');
            console.log(err);
        }
    });
}

function cambioPrecioOPago() {
    var $precio = $('#unam_appbundle_pago_precio');
    var $pago = $('#unam_appbundle_pago_pago');
    var $descuento = $('#unam_appbundle_pago_descuento');
    var $adeudo = $('#unam_appbundle_pago_adeudo');
    var descuento = 1.00 - ($descuento.val() / 100)
    var adeudo = ($precio.val() * descuento) - $pago.val();

    $adeudo.val(adeudo);

    $('#adeudo_curso').text('Adeuda: ' + number_format(adeudo,2));

}

function number_format(amount, decimals) {

    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

    decimals = decimals || 0; // por si la variable no fue fue pasada

    // si no es un numero o es igual a cero retorno el mismo cero
    if (isNaN(amount) || amount === 0)
        return parseFloat(0).toFixed(decimals);

    // si es mayor o menor que cero retorno el valor formateado como numero
    amount = '' + amount.toFixed(decimals);

    var amount_parts = amount.split('.'),
            regexp = /(\d+)(\d{3})/;

    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

    return amount_parts.join('.');
}

