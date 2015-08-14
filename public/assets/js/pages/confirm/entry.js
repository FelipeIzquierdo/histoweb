$(document).ready(function () {
    
    $('#btn-video').on('click',function(){
      $('#videoconferencing').toggle('slow');
    });

    $('button[id="submitEntry"]').on('click', function(e){
        var $form = $(this).closest('form');
        e.preventDefault();

        var reasons = $('#reasons option:selected').map(function() {
            return $(this).text();
        }).get();

        reasons = reasons.concat($('input[name="new_reasons"]').val().split(','));

        var system_revisions = $('#system_revisions option:selected').map(function() {
            return $(this).text();
        }).get();

        system_revisions = system_revisions.concat($('input[name="new_system_revisions"]').val().split(','));

        var procedures = $('#procedures option:selected').map(function() {
            return $(this).text();
        }).get();

        var diseases = $('#diseases option:selected').map(function() {
            return $(this).text();
        }).get();

        var medical_history = $('#medical_history options:selected').map(function() {
            return $(this).text();
        });

        var surgical_history = $('#surgical_history options:selected').map(function() {
            return $(this).text();
        });

        var traumatic_history = $('#traumatic_history options:selected').map(function() {
            return $(this).text();
        });

        var toxic_allergic_history = $('#toxic_allergic_history options:selected').map(function() {
            return $(this).text();
        });

        var reproductive_history = $('#reproductive_history options:selected').map(function() {
            return $(this).text();
        });

        var hospitalizations = $('#hospitalizations options:selected').map(function() {
            return $(this).text();
        });
        
        $("#modal_reasons").html(reasons.join( ", " ));
        $("#modal_system_revisions").html(system_revisions.join( ", " ));
        $("#modal_procedures").html(procedures.join( ", " ));
        $("#modal_diseases").html(diseases.join( ", " ));

        $("#modal_present_illness").html($('textarea[name="present_illness"]').val());
        $("#modal_management_plan").html($('textarea[name="management_plan"]').val());
        

        $('#entryModal').modal({ backdrop: 'static', keyboard: false })
            .one('click', '#confirm', function() {
                $form.trigger('submit'); // submit the form
            });
    });
});