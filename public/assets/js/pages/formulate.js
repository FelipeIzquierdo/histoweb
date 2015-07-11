
    function generic_medication()
    {
        $('.presentationItems').remove();
        var generic_medication_id = $('select[name="generic_medication_id"]').val();
        
        $.ajax({
            url:   '/assistance/options/formulate/presentations/'+generic_medication_id,
            type:  'GET',
            beforeSend: function(request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
            },
            success:  function (data) {
               // console.log(data);
                $.each(data, function(index, element){
                      $('select#presentation_id').append('<option value="'+element.id+'" class="presentationItems">'+element.presentation.name+'> '+element.unit_amount +' '+element.unit.name+' en '+element.diluent_amount+' '+element.diluent.name+'</option>')
                });
                }
        });

    }