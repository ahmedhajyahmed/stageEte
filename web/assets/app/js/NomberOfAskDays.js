
var nomberOfDays=0
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
    
    document.write(dateDiff(startDate, endDate));
}



