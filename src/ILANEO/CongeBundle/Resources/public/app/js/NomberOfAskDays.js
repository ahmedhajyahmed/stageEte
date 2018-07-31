
$(document).ready(function () {
$("#ilaneo_congebundle_authorizationvacation_endDate").on('change',function(){

    console.log('test');
    if ( $("#ilaneo_congebundle_authorizationvacation_startDate").val() == "" ) 
    {   
        
        alert("remplir la date de debut");
        $("#ilaneo_congebundle_authorizationvacation_endDate").val("");
    }

    else 

    {  
        var startForm= $("#ilaneo_congebundle_authorizationvacation_startDate").val();
        var endForm = $("#ilaneo_congebundle_authorizationvacation_endDate").val();
        
        var start = moment(startForm).startOf('day');
        var end= moment(endForm).startOf('day');

        if (end - start < 0) {
            $("#ilaneo_congebundle_authorizationvacation_startDate").val("");
            $("#ilaneo_congebundle_authorizationvacation_endDate").val("");
        }

        var diff= Math.abs(moment.duration(start.diff(end)).asDays());
        
        $("#diff").val(diff);
        
    }
});    




$("#ilaneo_congebundle_Sickvacation_endDate").on('change',function(){

    console.log('test');
    if ( $("#ilaneo_congebundle_Sickvacation_startDate").val() == "" ) 
    {   
        
        alert("remplir la date de debut");
        $("#ilaneo_congebundle_Sickvacation_endDate").val("");
    }

    else 

    {  
        var startForm= $("#ilaneo_congebundle_Sickvacation_startDate").val();
        var endForm = $("#ilaneo_congebundle_Sickvacation_endDate").val();
        
        var start = moment(startForm).startOf('day');
        var end= moment(endForm).startOf('day');

        if (end - start < 0) {
            $("#ilaneo_congebundle_Sickvacation_startDate").val("");
            $("#ilaneo_congebundle_Sickvacation_endDate").val("");
        }

        var diff= Math.abs(moment.duration(start.diff(end)).asDays());
        
        $("#diff").val(diff);
        
    }
}); 


$("#ilaneo_congebundle_unpaidvacation_endDate").on('change',function(){

    console.log('test');
    if ( $("#ilaneo_congebundle_unpaidvacation_startDate").val() == "" ) 
    {   
        
        alert("remplir la date de debut");
        $("#ilaneo_congebundle_unpaidvacation_startDate").val("");
    }

    else 

    {  
        var startForm= $("#ilaneo_congebundle_unpaidvacation_startDate").val();
        var endForm = $("#ilaneo_congebundle_unpaidvacation_endDate").val();
        
        var start = moment(startForm).startOf('day');
        var end= moment(endForm).startOf('day');

        if (end - start < 0) {
            $("#ilaneo_congebundle_unpaidvacation_startDate").val("");
            $("#ilaneo_congebundle_unpaidvacation_endDate").val("");
        }

        var diff= Math.abs(moment.duration(start.diff(end)).asDays());
        
        $("#diff").val(diff);
        
    }
}); 


$("#ilaneo_congebundle_exceptionalvacation_endDate").on('change',function(){

    console.log('test');
    if ( $("#ilaneo_congebundle_exceptionalvacation_startDate").val() == "" ) 
    {   
        
        alert("remplir la date de debut");
        $("#ilaneo_congebundle_exceptionalvacation_startDate").val("");
    }

    else 

    {  
        var startForm= $("#ilaneo_congebundle_exceptionalvacation_startDate").val();
        var endForm = $("#ilaneo_congebundle_exceptionalvacation_endDate").val();
        
        var start = moment(startForm).startOf('day');
        var end= moment(endForm).startOf('day');

        if (end - start < 0) {
            $("#ilaneo_congebundle_exceptionalvacation_startDate").val("");
            $("#ilaneo_congebundle_exceptionalvacation_endDate").val("");
        }

        var diff= Math.abs(moment.duration(start.diff(end)).asDays());
        
        $("#diff").val(diff);
        
    }
}); 


$("#ilaneo_congebundle_askvacation_endDate").on('change',function(){

    console.log('test');
    if ( $("#ilaneo_congebundle_askvacation_startDate").val() == "" ) 
    {   
        
        alert("remplir la date de debut");
        $("#ilaneo_congebundle_askvacation_startDate").val("");
    }

    else 

    {  
        var startForm= $("#ilaneo_congebundle_askvacation_startDate").val();
        var endForm = $("#ilaneo_congebundle_askvacation_endDate").val();
        
        var start = moment(startForm).startOf('day');
        var end= moment(endForm).startOf('day');

        if (end - start < 0) {
            $("#ilaneo_congebundle_askvacation_startDate").val("");
            $("#ilaneo_congebundle_askvacation_endDate").val("");
        }

        var diff= Math.abs(moment.duration(start.diff(end)).asDays());
        
        $("#diff").val(diff);
        
    }
}); 


});