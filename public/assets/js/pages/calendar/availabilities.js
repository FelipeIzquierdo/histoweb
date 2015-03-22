/*
 *  Document   : compCalendar.js
 *  Author     : pixelcave
 *  Description: Custom javascript code used in Calendar page
 */

var CompCalendar = function() {
    return {
        init: function() {

            /* Initialize FullCalendar */
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            var parametros = {
                'valor' : 1
            };

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
                eventDrop: function(event, delta, revertFunc) {
                    $.ajax({
                        data:  parametros,
                        url:   'gethint',
                        type:  'post',
                        beforeSend: function () {
                            console.log('enviando');
                        },
                        success:  function (data) {
                            console.log('exito');
                        }
                    });
                    console.log(event.title + " fue movido a " + event.start.format());
                }       
            });
        }
    };
}();