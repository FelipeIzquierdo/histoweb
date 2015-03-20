/*
 *  Document   : compCalendar.js
 *  Author     : pixelcave
 *  Description: Custom javascript code used in Calendar page
 */

var CompCalendar = function() {
    var calendarEvents  = $('.calendar-events');

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
                lang: 'es',
                firstDay: 1,
                editable: false,
                droppable: false,
                defaultTimedEventDuration: '00:15:00',
                minTime: '06:00:00',
                maxTime: '22:00:00',
                slotDuration: '00:15:00',
                //contentHeight: 200,

                events: [
                    {
                        title: 'Medico 1',
                        start: new Date(y, m, 18 , 8, 0),
                        color: '#de815c'
                    },
                    {
                        title: 'Medico 2',
                        start: new Date(y, m, 18 , 8, 15),
                        color: '#555555'
                    },
                    {
                        title: 'Medico 3',
                        start: new Date(y, m, 18 , 8, 30),
                        color: '#555555'
                    },
                    {
                        title: 'Medico 4',
                        start: new Date(y, m, 18 , 8, 45),
                        color: '#555555'
                    },
                    {
                        title: 'Medico 5',
                        start: new Date(y, m, 18 , 9, 0),
                        color: '#555555'
                    }
                ]
            });
        }
    };
}();