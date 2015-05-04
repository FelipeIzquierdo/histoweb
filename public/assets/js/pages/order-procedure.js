$(document).ready(function () {

    $('button[id="submitOrderProcedure"]').on('click', function(e){
        var $form = $(this).closest('form');
        e.preventDefault();

        var procedure_id = $('select[name="procedure_id[]"]').val();

        var procedure_types = '';
        $.ajax({
            url:   '/assistance/jsonProcedure/'+procedure_id,
            type:  'GET',
            beforeSend: function(request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
            },
            success:  function (data) {
               // console.log(data);
                $.each(data, function(index, element){
                      $( "#append" ).append('<div class="modal-body"> <div class="form-horizontal"> <div class="form-group"> <h4 class="col-md-3"><b>'+element.procedure_type.name+'</b></h4> </div> </div> <div class="form-group"><label class="col-md-4 control-label">'+element.name+'</label></div> </div>');
                });
        }
        });
        
        $('#entryModal').modal({ backdrop: 'static', keyboard: false })
            .one('click', '#confirm', function() {
                $form.trigger('submit'); // submit the form
            });
    });
});
