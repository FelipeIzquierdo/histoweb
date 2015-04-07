/*
 *  Document   : compCalendar.js
 *  Author     : pixelcave
 *  Description: Custom javascript code used in Calendar page
 */

function updateAvailability (event) {
    $.ajax({
        data:  {
            'start': event.start.format('YYYY-MM-DD H:mm:ss'),
            'end': event.end.format('YYYY-MM-DD H:mm:ss')
        },
        url:   '/histoweb5/public/doctors/' + event.doctor_id + '/availabilities/' + event.id,
        type:  'PUT',
        beforeSend: function(request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
        },
        success:  function (data) {
            console.log(data.message);
        }
    });
}

function deleteAvailability(event) {
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

function findPatient(patientDoc) {
    $.ajax({
        url:   '/admin/company/patients/' + patientDoc + '/find',
        type:  'GET',
        success:  function (data) {
            $('#patient').val("");
            $('#doc').val(patientDoc);
            $('#first_name').val(data.first_name);
            $('#last_name').val(data.last_name);
            $('#email').val(data.email);
            $('#tel').val(data.tel);
            $("#sex option[value=" + data.sex + "]").attr('selected', true);
            $('#date_birth').val(data.date_birth);
            $("#doc_type_id option[value=" + data.doc_type_id + "]").attr('selected', true);
            $("#occupation_id option[value=" + data.occupation_id + "]").attr('selected', true);
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

function createUpdatePatient(url, type) {
   var diaryTypeId = $('#diaryTypes').val();
    $.ajax({
        data:  {
            'doc':          $('#doc').val(),
            'first_name':   $('#first_name').val(),
            'last_name':    $('#last_name').val(),
            'email':        $('#email').val(),
            'tel':          $('#tel').val(),
            'sex':          $('#sex').val(),
            'date_birth':   $('#date_birth').val(),
            'doc_type_id':  parseInt($("#doc_type_id").val()),
            'occupation_id':parseInt($('#occupation_id').val())
        },
        url:   url,
        type:  'POST',
        beforeSend: function(request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
        },
        success:  function (data) {
            newDiary(doctorId, data.id, diaryTypeId);
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
            if(jqXHR)
            {
                console.log(jqXHR);
            }
        }
    });
}

function newDiary(doctorId, patientId, diaryTypeId) {
    $.ajax({
        url:   '/admin/company/doctors/' + doctorId + '/new-diary/' + patientId + '/' + diaryTypeId,
        type:  'GET',
        success:  function (data) {
            $('#external-events').prepend('<li class="animation-fadeInQuick2Inv" data-time="' + data.diary_type_time + '" data-patient-id="' + patientId + '"><i class="fa fa-calendar"></i> '+ data.patient_name +'</li>');
            initializeExternalEvent();
        }
    });
}
function initializeExternalEvent () {
    $('#external-events .animation-fadeInQuick2Inv').each(function()
    {
        var eventObject =
        {
            title:$.trim($(this).text()),
            time:$.trim($(this).data('time')),
            patientId:$.trim($(this).data('patient-id')),
            color:$(this).css("background-color"),
            type:'diary',
            constraint: 'availableForMeeting'
        };
        $(this).data("eventObject", eventObject),
            $(this).draggable({
                zIndex:999,
                revert:!0,
                revertDuration:0})
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
                findPatient(patientDoc);

                //newDiary(doctorId, patientId, diaryTypeId);
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
                    var originalEventObject  = $(this).data("eventObject"),
                        copiedEventObject  = $.extend({}, originalEventObject );
                        copiedEventObject .start = date,
                        $("#calendar").fullCalendar("renderEvent",copiedEventObject ,!0),
                        $(this).remove()
                },
                eventClick: function(event, delta, jsEvent, view) {
                    $("#eventId").html(event.id);
                    $("#eventDate").html(event.start.format('YYYY-MM-DD'));
                    $("#eventStart").html(event.start.format('h(:mm)a'));
                    if(event.end)
                    {
                        $("#eventEnd").html(event.end.format('h(:mm)a'));
                    }
                    else
                    {
                        $("#eventEnd").html(event.start.format('h(:mm)a'));
                    }
                    $('#modalFade').modal('show');
                },
                eventDrop: function(event, delta, revertFunc) {
                    if(event.type == 'schedule') {
                        updateSchedule(event);
                    }
                },
                eventResize: function(event, delta, revertFunc) {
                    if(event.type == 'schedule') {
                        updateSchedule(event);
                    }
                },

                dayClick: function(date, jsEvent, view) {
                    if(view.name != 'month')
                    {
                        alert('Clicked on: ' + date.format());
                        //$(this).css('background-color', 'red');
                    }
                }
            });
        }
    };
}();