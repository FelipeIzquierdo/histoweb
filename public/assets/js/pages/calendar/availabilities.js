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
        url:   '/admin/company/doctors/' + event.doctor_id + '/availabilities/' + event.id,
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
        url:   '/admin/company/doctors/' + event.doctor_id + '/availabilities/' + event.id,
        type:  'DELETE',
        beforeSend: function(request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
        },
        success:  function (data) {
            if(data.result)
            {
                $('#calendar').fullCalendar('removeEvents', event.id);
            }
            console.log(data.message);
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
            var types = {'personal':'Presencial', 'telemedicine':'Telemedicina'};

            $('#calendar').fullCalendar({
                header: {
                    left: 'title',
                    center: '',
                    right: 'today month,agendaWeek,agendaDay prev,next'
                },
                views: {
                    month: {
                        displayEventEnd: true,
                        editable: false
                    }
                },
                events: url,
                lang: 'es',
                firstDay: 1,
                editable: true,
                droppable: true,
                defaultTimedEventDuration: '01:00:00',
                minTime: '06:00:00',
                maxTime: '22:00:00',
                slotDuration: '01:00:00',
                timeFormat: 'h(:mm)a',
                startEditable: true,
                eventDurationEditable: true,
                eventOverlap: false,
                eventDrop: function(event, delta, revertFunc) {
                    updateAvailability(event);
                }, 
                eventResize: function(event, delta, revertFunc) {
                    updateAvailability(event);
                },
                eventClick: function(event, delta, jsEvent, view) {
                    $("#eventId").html(event.id);
                    $("#eventDate").html(event.start.format('YYYY-MM-DD'));
                    $("#eventStart").html(event.start.format('h(:mm)a'));
                    $("#eventType").html(types[event.type]);
                    if(event.end)
                    {
                        $("#eventEnd").html(event.end.format('h(:mm)a'));    
                    }
                    else
                    {
                        $("#eventEnd").html(event.start.format('h(:mm)a'));       
                    }
                    if(event.surgery_id)
                    {
                        $("#eventDelete").attr('disabled','disabled');
                    }
                    else
                    {
                        $("#eventDelete").unbind("click");
                        $("#eventDelete").click(function() {
                          deleteAvailability(event);
                        });
                        $("#eventDelete").removeAttr('disabled');   
                    }
                    
                    $('#modalFade').modal('show');
                }       
            });
        }


    };
}();