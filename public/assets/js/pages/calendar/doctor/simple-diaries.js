/*
 *  Document   : compCalendar.js
 *  Author     : pixelcave
 *  Description: Custom javascript code used in Calendar page
 */


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
                editable: false,
                droppable: false,
                startEditable: false,
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
                    $('#modalDataEvent').modal('show');
                },
                eventDrop: function(event, delta, revertFunc) {
                        updateDiary(event);
                }
            });
        }
    };
}();