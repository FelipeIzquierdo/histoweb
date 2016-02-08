$(document).ready(function () {
    $('button[id="submitDescribeProcedure"]').on('click', function(e){
        var $form = $(this).closest('form');
        e.preventDefault();
        $("#dateStart").html($("#start_date").val());
        $("#timeEnd").html($("#end_time").val());
        $("#timeStart").html($("#start_time").val());
        $("#surgery").html($("#surgery_id option:selected").text()," ");
        $("#doctor").html($("#doctor_id option:selected").text()," ");
        $("#staff").html($("#staff_id option:selected").text()," ");
        $("#anesthesiaType").html($("#anesthesia_type_id option:selected").text()," ");
        $("#wayEntry").html($("#way_entry_id option:selected").text()," ");
        $("#stateWay").html($("#state_way_id option:selected").text()," ");
        $("#descriptionText").html($("#description").val());
        $("#complicationsText").html($("#complications").val());

        $('#entryModal').modal({ backdrop: 'static', keyboard: false })
            .one('click', '#confirm', function() {
                createDescribeProcedure(form_data,method);
                //$form.trigger('submit'); // submit the form
            });
    });
});

function createDescribeProcedure (url, method) {
    $("[id^=error]").html("");
    $.ajax({
        data:  {
            'start_date':               $("#start_date").val(),
            'end_time':                 $("#end_time").val(),
            'start_time':               $("#start_time").val(),
            'surgery_id':               returnValueSelect ($('#surgery_id').val()),
            'doctor_id':                returnValueSelect ($('#doctor_id').val()),
            'staff_id':                 returnValueSelect ($('#staff_id').val()),
            'anesthesia_type_id':       returnValueSelect ($('#anesthesia_type_id').val()),
            'way_entry_id':             returnValueSelect ($('#way_entry_id').val()),
            'state_way_id':             returnValueSelect ($('#state_way_id').val()),
            'description':              $("#description").val(),
            'complications':            $("#complications").val(),
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
            var errors = data.responseJSON;
            $.each(errors, function (index, value) {
                $('#error-'+ index +'').html(
                    '<p>' + value + '</p>'
                );
            });
        }
    });
}