$( document ).ready(function() {
    console.log( "ready!" );

    $('#calendar').fullCalendar({
    dayClick: function() {
        console.log("ahmedDayClick");
        alert('a day has been clicked!');
    },
    events: function(start, end, timezone, callback) {
        console.log("ahmedEvent");
        $.ajax({
            url: Routing.generate('ilaneo_conge_calculateDate'),
            dataType: 'json',
            data: {
                // our hypothetical feed requires UNIX timestamps
                start: start.unix(),
                end: end.unix()
            },
            success: function(doc) {
                console.log("ahmedSuccess");
                var events = [];
                $(doc).find('event').each(function() {
                    events.push({
                        title: $(this).attr('title'),
                        start: $(this).attr('start') // will be parsed
                    });
                });
                callback(events);
            }
        });
    }
});
});
