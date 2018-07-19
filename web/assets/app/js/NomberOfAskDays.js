
var nomberOfDays
var isset=function isset(variable)
{
    if ( typeof( window[variable] ) != "undefined" ) 
    {
         return true;
    }
    else 
    {
         return false;
    }
}

if (isset(startDate) && isset(endDate))
{
    
    document.getElementById(nomberOfDays).innerText = dateDiff(startDate, endDate)
}



