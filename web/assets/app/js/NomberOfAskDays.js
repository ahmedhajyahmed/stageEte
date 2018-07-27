console.log("farah");
var startForm= $("#ilaneo_congebundle_authorizationvacation_startDate").val();
var start = moment(startForm).startOf('day');

var endForm = $("#ilaneo_congebundle_authorizationvacation_endDate").val();
var end= moment(endForm).startOf('day');

var diff= Math.abs(moment.duration(start.diff(end)).asDays());
console.log(diff);

$("#diff").val(diff);

$("#ilaneo_congebundle_authorizationvacation_endDate").on('change',function(){
    if ($("#ilaneo_congebundle_authorizationvacation_startDate")==0 ) 
    {
        alert("remplir la date de debut");
    }

    else 

    {
        $("#diff").val(diff);
        //console.log(diff);
    }
});    