function generic_medication(formulate_concentration_id)
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
              $('select#concentration_id').append('<option value="" selected="selected"></option>');
              $.each(data, function(index, element){
                    $('select#concentration_id').append('<option value="'+index+'" class="presentationItems">'+element+'</option>');
              });
              if(formulate_concentration_id != ""){
                document.getElementById('concentration_id').value = formulate_concentration_id;
              } 
            }
    });
}

function save (url,method) {
 $("[id^=error]").html("");
 $.ajax({
      data:  {
          'generic_medication_id':    returnValueSelect ($('#generic_medication_id').val()),
          'concentration_id':         returnValueSelect ($('#concentration_id').val()),
          'administration_route_id':  returnValueSelect ($('#administration_route_id').val()),
          'dose':                     $('#dose').val(),
          'interval':                 $('#interval').val(),
          'limit':                    $('#limit').val(),
      },
      url:   url,
      type:  method,
      beforeSend: function(request) {
          return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
      },
      success:  function (data) {
        load_url(data.url_formulate);
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