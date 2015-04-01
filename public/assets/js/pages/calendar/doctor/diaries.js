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
            var initializeExternalEvent = function(){
                $('#external-events .animation-fadeInQuick2Inv').each(function()
                {
                    var eventObject =
                    {
                        title:$.trim($(this).text()),
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
            initializeExternalEvent();
            $("#add-event-btn").on("click",function()
            {
                var type = $("#type"), valueType = "", patient = $("#patient"), valuePatient = "";
                valueType = type.prop("value");
                valuePatient = patient.prop("value");
                if(valuePatient != "" && valueType != ""){
                    $('#external-events').prepend('<li class="animation-fadeInQuick2Inv"><i class="fa fa-calendar"></i> '+$("<div />").text(valueType +' - '+ valuePatient).html()+"</li>");
                    type.prop("value","");
                    patient.prop("value","");
                    initializeExternalEvent();
                    type.focus();
                    patient.focus();
                }
                return !1;
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