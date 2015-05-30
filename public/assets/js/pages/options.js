$(document).ready(function () {

    $('button[id="submitOptions"]').on('click', function(e){
        var $form = $(this).closest('form');
        e.preventDefault();

        var value = $(this).val();
        $('[name="procedure"]').val(value);

        $('#entryModal').modal({ backdrop: 'static', keyboard: false })
                    .one('click', '#confirm', function() {
                    $form.trigger('submit'); // submit the form
                });

    });
});
