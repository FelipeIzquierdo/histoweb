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
    var e = $(".calendar-events"), t = function()
    {
        e.find("li").each(function()
        {
            var e =
            {
                title:$.trim($(this).text()), color:$(this).css("background-color"),
                type:'diary',
                constraint: 'availableForMeeting'
            };
            $(this).data("eventObject", e),
                $(this).draggable({zIndex:999,revert:!0,revertDuration:0})
        })
    };
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

            $('#external-events .fc-event').each(function() {

                // store data so the calendar knows to render an event upon drop
                $(this).data('event', {
                    title: $.trim($(this).text()), // use the element's text as the event title
                    stick: true // maintain when user navigates (see docs on the renderEvent method)
                });

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 999,
                    revert: true,      // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });

            });


            /* initialize the calendar
             -----------------------------------------------------------------*/
            t();
            var a = $("#add-event"), n = "";
            $("#add-event-btn").on("click",function()
            {
                return n = a.prop("value"),
                n&&(e.prepend('<li class="animation-fadeInQuick2Inv"><i class="fa fa-calendar"></i> '+$("<div />").text(n).html()+"</li>"),a.prop("value",""),t(),a.focus()),!1
            });

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

                defaultTimedEventDuration: '01:00:00',
                minTime: '06:00:00',
                maxTime: '22:00:00',
                slotDuration: '00:15:00',
                timeFormat: 'h(:mm)a',
                drop:function(e)
                {
                    var t =
                        $(this).data("eventObject"),
                        a = $.extend({}, t);
                        a.start = e,
                        $("#calendar").fullCalendar("renderEvent",a,!0),
                        $(this).remove()
                },
                eventOverlap: function(stillEvent, movingEvent) {

                    if(stillEvent.type == movingEvent.type){
                        return false;
                    }

                    return true;
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