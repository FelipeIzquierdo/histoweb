
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
                      $('select#presentation_id').append('<option value="'+element.presentation.id+'" class="presentationItems">'+element.presentation.name+'</option>')
                });
                }
        });

    }

    function presentation()
    {
        $('.routesItems').remove();
        var generic_medication_id = $('select[name="generic_medication_id"]').val();
        var presentation_id = $('select[name="presentation_id"]').val();
        $.ajax({
            url:   '/assistance/options/formulate/administration-routes/'+generic_medication_id+'/'+presentation_id,
            type:  'GET',
            beforeSend: function(request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
            },
            success:  function (data) {
                //console.log(JSON.parse(data));
                 $.each(data, function(index, element){
                    $('select#route_id').append('<option value="'+element.administration_route.id+'" class="presentationItems">'+element.administration_route.name+'</option>')
                });                
            }
        });
    }