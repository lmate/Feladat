// cookie handler (2020.08.11) Attila
/*if(GetCookie("acceptcookie") != "yes")
$('#cookiePopup').fadeIn();
$('#cookiePopup .accept').on('click', () => {
$("#cookiePopup").fadeOut();
SetCookie("acceptcookie", "yes", 36500);
});
$('#cookiePopup .reject').on('click', () => {
window.location = "https://google.com/";
});*/

function SetCookie(cname, cvalue, exdays)
{
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function GetCookie(cname)
{
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(";");
  for(var i = 0; i <ca.length; i++)
  {
    var c = ca[i];
    while (c.charAt(0) == " ")
    {
      c = c.substring(1);
    }

    if (c.indexOf(name) == 0)
    {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}