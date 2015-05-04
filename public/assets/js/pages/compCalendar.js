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

var CompCalendar = function()
{
    var e = $(".calendar-events"), t = function()
    {
        e.find("li").each(function()
        {
            var e =
            {
                title:$.trim($(this).text()), color:$(this).css("background-color")
            };
            $(this).data("eventObject", e),
                $(this).draggable({zIndex:999,revert:!0,revertDuration:0})
        })
    };
    return{
        init:function()
        {
            t();
            var a = $("#add-event"), n = "";
            $("#add-event-btn").on("click",function()
            {
                return n = a.prop("value"),
                n&&(e.prepend('<li class="animation-fadeInQuick2Inv"><i class="fa fa-calendar"></i> '+$("<div />").text(n).html()+"</li>"),a.prop("value",""),t(),a.focus()),!1
            });
            var r = new Date, l = r.getDate(), i = r.getMonth(), o = r.getFullYear();
            $("#calendar").fullCalendar(
                {
                    header:
                    {
                        left:"title",
                        center:"",
                        right:"today month,agendaWeek,agendaDay prev,next"
                    },
                    firstDay:1,
                    editable:!0,
                    droppable:!0,
                    drop:function(e)
                    {
                        var t = $(this).data("eventObject"), a = $.extend({}, t);
                        a.start=e,$("#calendar").fullCalendar("renderEvent",a,!0),
                            $(this).remove()
                    },
                    events:[
                        {title:"Cinema",start:new Date(o,i,2),allDay:!0,color:"#de815c"},
                        {title:"Live Conference",start:new Date(o,i,5)},
                        {title:"Secret Project",start:new Date(o,i,4),end:new Date(o,i,4),color:"#555555"},
                        {id:999,title:"Work (repeated)",start:new Date(o,i,l+3,8,0),allDay:!1,color:"#555555"},
                        {id:999,title:"Work (repeated)",start:new Date(o,i,l+5,8,0),allDay:!1,color:"#555555"},
                        {title:"Work meeting",start:new Date(o,i,l,10,0),allDay:!1,color:"#de815c"},
                        {title:"Bootstrap Tutorial",start:new Date(o,i,l+4,12,15),end:new Date(o,i,l+4,18,15),allDay:!1,color:"#deb25c"},
                        {title:"Admin Template",start:new Date(o,i,24),end:new Date(o,i,27),allDay:!0,color:"#afde5c"},
                        {title:"Trip to Asia",start:new Date(o,i,l+8,21,0),end:new Date(o,i,l+8,23,30),allDay:!1},
                        {title:"Follow me on Twitter",start:new Date(o,i,23),end:new Date(o,i,23),allDay:!0,url:"http://twitter.com/pixelcave"}
                    ]
                })
        }
    }
}();