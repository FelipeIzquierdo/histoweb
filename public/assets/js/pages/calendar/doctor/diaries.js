/*
 *  Document   : compCalendar.js
 *  Author     : pixelcave
 *  Description: Custom javascript code used in Calendar page
 */

function changeTest(){
    doctorId = $('#doctorSelect').val();
    url = '/admin/company/doctors/' + doctorId + '/diaries-json';
    //alert(url,doctorId);
    $("#calendar").fullCalendar('removeEvents');
    $("#calendar").fullCalendar('addEventSource', url)
    $("#calendar").fullCalendar('rerenderEvents');
}


function cancelDiaries (event)
{
    $.ajax({
        data:  {

        },
        url:   'reception/cancel-diary/'+ event.id,
        type:  'post',
        beforeSend: function(request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
        },
        success:  function (data) {
            $('#calendar').fullCalendar('removeEvents', event.id);
            console.log(data.message);            
        }
    });
}


function activatePatient (event)
{
    $.ajax({
        data:  {

        },
        url:   'reception/activate-diary/'+ event.id,
        type:  'post',
        beforeSend: function(request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
        },
        success:  function (data) {
            console.log(data.entered_at);
            event.entered_at = data.entered_at;
        }
    });
}

function updateDiary (event)
{
    $.ajax({
        data:  {
            'start': event.start.format('YYYY-MM-DD H:mm:ss'),
            'end': event.end.format('YYYY-MM-DD H:mm:ss')
        },
        url:   '/admin/company/doctors/' + event.doctor_id + '/diaries/'+ event.id,
        type:  'PUT',
        beforeSend: function(request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
        },
        success:  function (data) {
            console.log(data.message);
        }
    });
}

function deleteAvailability(event)
{
    $.ajax({
        url:   '/histoweb5/public/doctors/' + event.doctor_id + '/availabilities/' + event.id,
        type:  'DELETE',
        beforeSend: function(request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
        },
        success:  function (data) {
            $('#calendar').fullCalendar('removeEvents', event.id);
            console.log('evento ' + event.id + ' eliminado');
        }
    });
}

function findPatient(patientDoc)
{
    $.ajax({
        url:   '/admin/company/patients/' + patientDoc + '/find',
        type:  'GET',
        success:  function (data) {
            $('.help-block').html('');
            $('#patient').val("");
            $('#doc').val(patientDoc);
            $('#first_name').val(data.first_name);
            $('#last_name').val(data.last_name);
            $('#email').val(data.email);
            $('#tel').val(data.tel);
            $('#address').val(data.address);
            $("#sex option[value=" + data.sex + "]").attr('selected', true);
            $('#date_birth').val(data.date_birth);
            $("#doc_type_id option[value=" + data.doc_type_id + "]").attr('selected', true);
            $("#occupation_id option[value=" + data.occupation_id + "]").attr('selected', true);
            $("#membershipTypes option[value=" + data.membership_types_id + "]").attr('selected', true);
            $("#eps option[value=" + data.eps_id + "]").attr('selected', true);

            if(data != "")
            {
                $("#eventUpdate").show();
                $("#eventCreate").hide();
                $("#eventUpdate").unbind("click");
                $("#eventUpdate").click(function(e) {
                    e.preventDefault();
                    var url = '/admin/company/patients/'+ data.id;
                    var type = 'PUT';
                    createUpdatePatient(url,type);
                });
            }else
            {
                $("#eventCreate").show();
                $("#eventUpdate").hide();
                $("#eventCreate").unbind("click");
                $("#eventCreate").click(function(e) {
                    e.preventDefault();
                    var url = '/admin/company/patients';
                    var type = 'POST';
                    createUpdatePatient(url, type);
                });
            }
            $('#modalFade').modal('show');
        }
    });
}
function createUpdatePatient(url, type)
{
   var diaryTypeId = $('#diaryTypes').val();
    $.ajax({
        data:  {
            'doc':          $('#doc').val(),
            'first_name':   $('#first_name').val(),
            'last_name':    $('#last_name').val(),
            'email':        $('#email').val(),
            'tel':          $('#tel').val(),
            'address':      $('#address').val(),
            'sex':          $('#sex').val(),
            'date_birth':   $('#date_birth').val(),
            'doc_type_id':  parseInt($("#doc_type_id").val()),
            'occupation_id':parseInt($('#occupation_id').val())
        },
        url:   url,
        type:  type,
        beforeSend: function(request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
        },
        success:  function (data) {
            newDiary(doctorId, data.id, diaryTypeId);
        },
        error: function(data) {
            // Error...
            var errors = data.responseJSON;
            $.each(errors, function (index, value) {
                $('#error-'+ index +'').html(
                    '<p>' + value + '</p>'
                );
            });
            $('#modalFade').modal('show');
        }
    });
}

function newDiary(doctorId, patientId, diaryTypeId)
{
    var eps = $('#eps').val();
    var membership = $('#membershipTypes').val();
    $.ajax({
        url:   '/admin/company/doctors/' + doctorId + '/new-diary/' + patientId + '/' + diaryTypeId,
        type:  'GET',
        success:  function (data) {
            $('#external-events').prepend('<li class="animation-fadeInQuick2Inv" data-duration="' + data.time + '" data-eps="' + eps + '" data-membership="' + membership + '" data-time="' + data.diary_type_time + '" data-type-diary="' + diaryTypeId + '" data-patient-id="' + patientId + '" ><i class="fa fa-calendar"></i> '+ data.patient_name +'</li>');
            initializeExternalEvent();
        }
    });
}

function createDiary(copiedEventObject, dropEvent)
{
    $.ajax({
        data: {
            'patient_id': parseInt(copiedEventObject.patientId),
            'type_id': parseInt(copiedEventObject.typeDiary),
            'start': copiedEventObject.start.format('YYYY-MM-DD hh:mm:ss'),
            'end': copiedEventObject.time,
            'eps_id': copiedEventObject.eps,
            'membership_types_id': copiedEventObject.membership
        },
        url:   '/admin/company/doctors/' + doctorId + '/diaries',
        type:  'POST',
        beforeSend: function(request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
        },
        success:  function (data) {
            $("#calendar").fullCalendar("renderEvent",data,!0);
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
            $("#external-events").append(dropEvent);
            initializeExternalEvent();
            console.log('El envento solo puede ser asignado en la disponibilidad correcta');
        }
    });
}


function initializeExternalEvent ()
{
    $('#external-events .animation-fadeInQuick2Inv').each(function()
    {
        var eventObject =
        {
            typeDiary:  $.trim($(this).data('type-diary')),
            title:      $.trim($(this).text()),
            time:       $.trim($(this).data('time')),
            patientId:  $.trim($(this).data('patient-id')),
            eps:        $.trim($(this).data('eps')),
            membership: $.trim($(this).data('membership')),
            color:      "#3F94D4",
            type:       'diary',
            constraint: 'availableForMeeting',
            start:       null,
            end:         null
        };
        $(this).data("eventObject", eventObject),
            $(this).draggable({
                zIndex:999,
                revert:true,
                revertDuration:10})
    })
};

var CompCalendar = function()
{
    return {
        init: function()
        {
            /* Initialize FullCalendar */

            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            /* initialize the external events
             -----------------------------------------------------------------*/

            initializeExternalEvent();
            $("#add-event-btn").on("click",function()
            {
                var patientDoc = $("#patient").val();
                if (patientDoc!= '')
                {
                    findPatient(patientDoc);
                }else{
                    $('#error-patient_id').html(
                        '<p> El campo paciente es requerido </p>'
                    );
                }
                return false;
            });
            /* initialize the calendar
             -----------------------------------------------------------------*/
            $('#calendar').fullCalendar({
                header: {
                    left: 'title',
                    center: '',
                    right: 'today month,agendaWeek,agendaDay prev,next'
                },
                defaultView: 'agendaWeek',
                events: url,
                lang: 'es',
                firstDay: 1,
                editable: true,
                droppable: true,
                startEditable: true,
                eventDurationEditable: false,
                defaultTimedEventDuration: '00:15:00',
                minTime: '06:00:00',
                maxTime: '22:00:00',
                slotDuration: '00:15:00',
                timeFormat: 'h(:mm)a',
                selectOverlap: function(event) {
                    return event.rendering === 'background';
                },
                eventOverlap: function(stillEvent) {
                    return stillEvent.rendering === 'background';
                },
                drop:function(date, jsEvent, ui)
                {
                    var ret = new Date(date.format('YYYY-MM-DD H:mm:ss'));
                    var originalEventObject  = $(this).data("eventObject");
                    var copiedEventObject  = $.extend({}, originalEventObject );
                    ret.setTime(ret.getTime() + copiedEventObject.time*60000);
                    copiedEventObject.start = date;
                    copiedEventObject.end = ret;
                    var cloned = $(this);
                    createDiary(copiedEventObject, cloned);
                    $(this).remove();
                },
                eventClick: function(event, delta, jsEvent, view) {                    
                    $("#eventPatient").html(event.title);
                    $("#eventDoctor").html(event.nameDoctor);
                    $("#eventDiaryType").html(event.diaryType);
                    $("#eventId").html(event.id);
                    $("#eventDate").html(event.start.format('DD / MM / YYYY'));
                    $("#eventStart").html(event.start.format('hh : mm a'));
                    $("#eventEnd").html(event.end.format('hh : mm a'));
                    $('#modalDataEvent .modal-dialog') .css({
                        width: '450px'
                    });
                    $("#eventActivate").unbind("click");                         
                    if(event.start.format('DD / MM / YYYY')  == moment().format('DD / MM / YYYY')){  
                        if(event.entered_at == null){
                            $("#eventActivate").removeAttr('disabled');                            
                        }else{
                            $("#eventActivate").attr('disabled','disabled');
                        } 
                        console.log(event.entered_at );       
                        $("#eventActivate").click(function() {                            
                            activatePatient(event);
                        });                                              
                    }
                    else{
                        $("#eventActivate").attr('disabled','disabled');                        
                    }
                    $("#eventCancel").unbind("click");
                    $("#eventCancel").click(function() {                            
                            cancelDiaries(event);
                        }); 
                    $('#modalDataEvent').modal('show');                     
                },
                eventDrop: function(event, delta, revertFunc) {
                    updateDiary(event);
                }
            });
        }
    };
}();