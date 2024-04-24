$(document).ready(function () {
    // Define las horas de inicio y fin del horario
    var startHour = 9;
    var endHour = 18;

    // Obtiene el select de hora
    var timeSelect = $('#timeSelect');
    var plateInput = $('#plate');
    var buttomInput = $('#buttom-submit');

    // Cuando se selecciona una fecha...
    $('input[type="date"]').change(function () {
        // Obtiene la fecha seleccionada
        var selectedDate = this.value;

        // Habilita el select de hora
        timeSelect.prop('disabled', false);
        plateInput.prop('disabled', false);
        buttomInput.prop('disabled', false);

        // Envía una solicitud AJAX a citas.php para obtener las horas disponibles
        $.ajax({
            url: 'admin/funciones/citas.php',
            type: 'POST',
            data: { getAvailablesDates: true, date: selectedDate },
            dataType: 'json',
            success: function (data) {
                // Limpia el select de hora
                timeSelect.empty();
        
                // Llena el select de hora con las horas disponibles
                for (var i = startHour; i < endHour; i++) {
                    for (var j = 0; j < 60; j += 30) {
                        var hour = (i < 10 ? '0' : '') + i + ':' + (j < 10 ? '0' : '') + j;
                        // Convierte la hora a formato HH:MM
                        var formattedHour = hour + ':00';
                        if (!data.includes(formattedHour)) {
                            timeSelect.append('<option value="' + hour + '">' + hour + '</option>');
                        }
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error: ' + textStatus + ' - ' + errorThrown);
            }
        });
           
    });

    // Cuando se envía el formulario...
    $('form').submit(function (e) {
        // Previene el envío normal del formulario
        e.preventDefault();

        // Obtiene los datos del formulario
        var formData = {
            createDate: true,
            date: $('#date').val(),
            time: $('#timeSelect').val(),
            plate: $('#plate').val()
        };

        // Envía una solicitud AJAX a citas.php para crear la cita
        $.ajax({
            url: 'admin/funciones/citas.php',
            type: 'POST',
            data: formData,
            success: function (response) {

                $('#date').val('');
                $('#timeSelect').val('');
                $('#plate').val('');

                timeSelect.prop('disabled', true);
                plateInput.prop('disabled', true);
                buttomInput.prop('disabled', true);

                alert(response);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error: ' + textStatus + ' - ' + errorThrown);
            }
        });
    });
});
