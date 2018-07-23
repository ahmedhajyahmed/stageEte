var startForm= $("#ilaneo_congebundle_authorizationvacation_startDate").val();
var start = moment(startForm).startOf('day');

var endForm = $("#ilaneo_congebundle_authorizationvacation_endDate").val();
var end= moment(endForm).startOf('day');

var diff= Math.abs(moment.duration(start.diff(end)).asDays());
console.log(diff);

$("#diff").val(diff)


