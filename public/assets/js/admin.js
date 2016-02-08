function deleteModel(button_id) 
{
   var button = $('#'+button_id);
   var id = button.data('id');
   button.parents('tr').fadeOut(1000);
   var form = $('#form-delete');
   var action = form.attr('action').replace('USER_ID', id);
   var row =  button.parents('tr');
   
   row.fadeOut(1000);
   
   $.post(action, form.serialize(), function(result) {
      if (result.success) 
      {
         setTimeout (function () {
            row.delay(1000).remove();
            var result_html = '<div class="col-md-12"> <div class="alert alert-success alert-dismissable"> <i class="fa fa-check"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+result.msg+'</div></div>';
            $('#title_page').append(result_html);
         }, 1000);                
      } else 
      {
         row.show();
         var result_html = '<div class="col-md-12"> <div class="alert alert-danger alert-dismissable"> <i class="fa fa-check"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> El registro no pudo ser eliminado'+result.msg+'</div> </div>';
         $('#title_page').append(result_html);
      }
   }, 'json');
}

function load_url (url) {
    $('#page-content').load(url, function (response, status, xhr) {
      $(this).hide().fadeIn();
      if(status == "error"){
        alert('Error en cargar la página');
      }
    });
}

function returnValueSelect (data) {
    if( data != null ){
        return data;
    }
    return [];
}

$(document).ready(function () {
    $(document).mousemove(function (e){
      if(($(window).width()/2) < e.pageX){
        $('#toTop').fadeIn();
      }
      else{
        $('#toTop').fadeOut();
      }
    });
});