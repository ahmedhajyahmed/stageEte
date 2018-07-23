$('#calendar').fullCalendar({
    events: function(start, end, timezone, callback) {
        $.ajax({
            url: 'ILANEO\CongeBundle\Entity\AskVacation.php',
            dataType: 'xml',
            data: {
                // our hypothetical feed requires UNIX timestamps
                start: start.unix(),
                end: end.unix()
            },
            success: function(doc) {
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