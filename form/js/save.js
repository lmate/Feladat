// Auto save function which is storing the data in localstorage this is needed in case of an refresh which was not on purpose (2020.07.30) Attila
/*$(function() // A function for the actual saving and also this is not quite ready yet but it does the job (2020.07.30) Attila
{
    $(".auto-save").savy("load");
});

function DestroySave() // After submit we and the user dont really need the saved data so we are destroying it (2020.07.30) Attila
{
    $(".auto-save").savy("destroy");
} OLD SHIT NOBODY LIKES IT*/
////
/*console.log(document.readyState);
if (document.readyState == 'loading')
{
  Load();
}*/

/*window.onload = function()
{
  Load();

  setInterval(function()
  {
    Save();
    alert("saved");
  }, 60000);
};*/

/*$(document).ready(function()
{
  Load();

  setInterval(function()
  {
    Save();
    alert("saved");
  }, 60000);
});*/

// New save method (2020.08.30) Attila

function Save()
{
  if(GetCookie("saveId") == "")
  {
    var page = document.getElementById("main").innerHTML;
    var uuid = CreateUUID();

    SetCookie("saveId", uuid, 36500);

    var data = [
      { "type": "save" },
      { "id": uuid, "page": page }
    ];

    $.ajax({
      url: "ajax.php",
      type: "POST",
      data: JSON.stringify(data),
      contentType: "application/json"
    });
  }
  else
  {
    var page = document.getElementById("main").innerHTML;
    var uuid = GetCookie("saveId");

    var data = [
      { "type": "save" },
      { "id": uuid, "page": page }
    ];

    $.ajax({
      url: "ajax.php",
      type: "POST",
      data: JSON.stringify(data),
      contentType: "application/json"
    });
  }
}

function Load()
{
  if(GetCookie("saveId") == "")
  {
    Save();
  }
  else
  {
    var uuid = GetCookie("saveId");

    var data = [
      { "type": "load" },
      { "id": uuid }
    ];

    console.log(data);

    $.ajax({
      url: "ajax.php",
      type: "POST",
      data: JSON.stringify(data),
      contentType: "application/json",
      success: function(resp)
      {
        alert(resp.title);
        $("#main").html(resp.message);
      }
    });
  }
}

function CreateUUID()
{
  var dt = new Date().getTime();
  var uuid = "xxxxxxxxxxxx4xxxyxxxxxxxxxxxxxxx".replace(/[xy]/g, function(c)
  {
    var r = (dt + Math.random()*16)%16 | 0;
    dt = Math.floor(dt/16);
    return (c=='x' ? r :(r&0x3|0x8)).toString(16);
  });

  return uuid;
}

/*for (let index = 0; index < 20; index++)
{
  console.log(CreateUUID());
}*/
////