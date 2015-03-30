
var CompCalendar = function() {
    return {
        init: function() {

            /* Initialize FullCalendar */
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            $('#calendar').fullCalendar({
                defaultDate: '2014-11-10',
                defaultView: 'agendaWeek',
                events: [
                    {
                        start: '2014-11-10T10:00:00',
                        end: '2014-11-10T16:00:00',
                        rendering: 'background',
                        backgroundColor: 'red'
                    }
                ]
            });
        }
    };
}();