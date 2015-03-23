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

var CompCalendar = function() {
    return {
        init: function() {

            /* Initialize FullCalendar */
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            $('#calendar').fullCalendar({
                header: {
                    left: 'title',
                    center: '',
                    right: 'today month,agendaWeek,agendaDay prev,next'
                },
                events: url,
                lang: 'es',
                firstDay: 1,
                editable: false,
                droppable: false,
                startEditable: false,
                eventDurationEditable: false,
                eventOverlap: false,
                defaultTimedEventDuration: '01:00:00',
                minTime: '06:00:00',
                maxTime: '22:00:00',
                slotDuration: '00:15:00',
                timeFormat: 'h(:mm)a',
                
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
                }       
            });
        }


    };
}();