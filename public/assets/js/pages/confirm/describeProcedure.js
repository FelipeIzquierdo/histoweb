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
                $form.trigger('submit'); // submit the form
            });
    });
});