/*
 *  Document   : compCalendar.js
 *  Author     : pixelcave
 *  Description: Custom javascript code used in Calendar page
 */
function updateAvailability (event, state) {
    $.ajax({
        data:  {
            'start': event.start.format('YYYY-MM-DD H:mm:ss'),
            'end': event.end.format('YYYY-MM-DD H:mm:ss'),
            'state': state
        },
        url:   '/admin/company/doctors/' + event.doctor_id + '/availabilities/' + event.id.substring(4),
        type:  'PUT',
        beforeSend: function(request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
        },
        success:  function (data) {
            $('#calendar').fullCalendar( 'refetchEvents' )

        }
    });
}

function discard (event) {
    $.ajax({
        url:   '/admin/company/surgeries/' + surgery_id + '/availabilities/' + event.id.substring(4),
        type:  'POST',
        beforeSend: function(request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
        },
        success:  function (data) {
            $('#calendar').fullCalendar( 'removeEvents',event.id )

        }
    });
}

function createSchedule(event) {
    $.ajax({
        data:  {
            'start': event.start.format('YYYY-MM-DD H:mm:ss'),
            'end': event.end.format('YYYY-MM-DD H:mm:ss'),
            'doctor_id': event.doctor_id,
            'surgery_id':surgery_id
        },
        url:   '/admin/company/surgeries/' + surgery_id + '/schedules-massive',
        type:  'POST',
        beforeSend: function(request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
        },
        success:  function (data) {
            console.log(data.message);
        }
    });
}

function updateSchedule (event) {
    $.ajax({
        data:  {
            'start': event.start.format('YYYY-MM-DD H:mm:ss'),
            'end': event.end.format('YYYY-MM-DD H:mm:ss')
        },
        url:   '/admin/company/surgeries/' + event.surgery_id + '/schedules/' + event.id.substring(4),
        type:  'PUT',
        beforeSend: function(request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
        },
        success:  function (data) {
            console.log(data.message);
        }
    });
}

function deleteSchedule(event) {
    $.ajax({
        url:   '/admin/company/surgeries/' + event.surgery_id + '/schedules/' + event.id.substring(4),
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
                    if(event.type == 'schedule') {
                        updateSchedule(event);
                    }
                }, 
                eventResize: function(event, delta, revertFunc) {
                    if(event.type == 'schedule') {
                        updateSchedule(event);
                    }
                },
                eventClick: function(event, delta, jsEvent, view) {
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
                    if(event.type == 'schedule') {
                        $("#eventTitle").html('Horario Doctor '+ event.title);
                        $("#eventState").hide();
                        $("#eventCreate").hide();
                        $("#eventDiscarded").hide();
                        $("#eventDelete").show();
                        $("#eventDelete").unbind("click");
                        $("#eventDelete").click(function() {
                            deleteSchedule(event);
                        });
                    }else{
                        var color = {available:'Disponible',used:'Usado',discarded:'Descartado'};
                        $("#eventTitle").html('Disponibilidad Doctor '+ event.title);
                        $("#eventStateTex").html(color[event.state]);
                        $("#eventState").show();
                        $("#eventCreate").show();
                        $("#eventCreate").unbind("click");
                        $("#eventCreate").click(function() {
                            createSchedule(event);
                            updateAvailability(event,'used');
                        });
                        $("#eventDiscarded").show();
                        $("#eventDelete").hide();
                        $("#eventDiscarded").unbind("click");
                        $("#eventDiscarded").click(function() {
                            discard(event);
                        });
                    }
                    $('#modalFade').modal('show');
                }       
            });
        }
    };
}();