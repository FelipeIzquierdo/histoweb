$(document).ready(function () {
    
    $('button[id="submitDescribeProcedure"]').on('click', function(e){
        var $form = $(this).closest('form');
        e.preventDefault();

        /*$("#modal_reasons").html(reasons.join( ", " ));
        $("#modal_system_revisions").html(system_revisions.join( ", " ));
        $("#modal_procedures").html(procedures.join( ", " ));
        $("#modal_diagnostics").html(diagnostics.join( ", " ));

        $("#modal_present_illness").html($('textarea[name="present_illness"]').val());
        $("#modal_management_plan").html($('textarea[name="management_plan"]').val());*/
        

        $('#entryModal').modal({ backdrop: 'static', keyboard: false })
            .one('click', '#confirm', function() {
                $form.trigger('submit'); // submit the form
            });
    });
});