$(document).ready(function () {
    $('button[id="submitOptions"]').on('click', function(e){
        var $form = $(this).closest('form');
        e.preventDefault();

        var value = $(this).val();
        $('[name="procedure"]').val(value);

        $('#entryModal').modal({ backdrop: 'static', keyboard: false })
                    .one('click', '#confirm', function() {
                    deleteOrderProcedure(form_data,method,value);
                    //$form.trigger('submit'); // submit the form
                });
    });
});

function deleteOrderProcedure (url, method, procedure_id) {
    $("[id^=error]").html("");
    $.ajax({
        data:  {
            'procedure_id':             procedure_id,
        },
        url:   url,
        type:  method,
        beforeSend: function(request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
        },
        success:  function (data) {
            load_url(data.url_options);
        },
        error: function(data) {
            // Error...
            alert('Error en eliminar solicitud de procedimientos');
        }
    });
}