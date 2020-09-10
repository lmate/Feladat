// INIT
$(window).on("load" ,function()
{
    $(".addmember").hide();
    $("#statistics").hide();
    $("#option").hide();
    $("#company_site_num").val(0);
    $("#company_branch_num").val(0);
    $("#company_boss_num").val(0);
    $("#company_manager_num").val(0);
    $("#company_member_num").val(1);
    $("#company_main_place").val("seat");
    $("#day").prop("disabled", true);
    $("#month").prop("disabled", true);
    $("#mem").text("Tag");

    for (let index = 1; index < 32; index++) // Setting day nums for January
    {
        $("#day").append($("<option></option>").attr("value", index).text(index));
    }

    MemberCollapser();
});

$(document).ready(function()
{
    // not let user to submit with enter key (2020.08.30) Attila
    $(document).on("keydown", "form", function(event)
    { 
        return event.key != "Enter";
    });

    // clean anything that is not needed (2020.08.30) Attila
    $.ajax({
        url: "cleaner.php"
    });

    $(".mul-select").select2({
        placeholder: "Keresés", //placeholder
        tags: true,
        tokenSeparators: ['/',',',';'," "] 
    });

    $("#company_member_pay_afterstart_time").datetimepicker({
        locale: "hu",
        minDate: moment(),
        format: "L"
    });
    $( "#company_member_pay_afterstart_time" ).keypress(function(e){
        e.preventDefault();
    });

    ////
    $("#company_time1").datetimepicker({
        locale: "hu",
        minDate: moment(),
        format: "L"
    });
    $( "#company_time1" ).keypress(function(e){
        e.preventDefault();
    });

    $("#company_time2").datetimepicker({
        locale: "hu",
        minDate: moment(),
        useCurrent: false, //Important! See issue #1075
        format: "L"
    });
    $( "#company_time2" ).keypress(function(e){
        e.preventDefault();
    });

    $("#company_time1").on("dp.change", function (e){
        $("#company_time2").data("DateTimePicker").minDate(e.date);
    });
    $("#company_time2").on("dp.change", function (e){
        $("#company_time1").data("DateTimePicker").maxDate(e.date);
    });
    ////

    $("#company_member_money_payment_time").datetimepicker({
        locale: "hu",
        minDate: moment(),
        format: "L"
    });
    $( "#company_member_money_payment_time" ).keypress(function(e){
        e.preventDefault();
    });

    $("#company_member_date").datetimepicker({
        locale: "hu",
        maxDate: moment(),
        viewMode: "years",
        format: "L"
    });
    $( "#company_member_date" ).keypress(function(e){
        e.preventDefault();
    });

    ////
    $("#company_member_boss_time_knowndate").datetimepicker({
        locale: "hu",
        minDate: moment(),
        format: "L"
    });
    $( "#company_member_boss_time_knowndate" ).keypress(function(e){
        e.preventDefault();
    });

    $("#company_member_boss_time_knowndate2").datetimepicker({
        locale: "hu",
        minDate: moment(),
        useCurrent: false, //Important! See issue #1075
        format: "L"
    });
    $( "#company_member_boss_time_knowndate2" ).keypress(function(e){
        e.preventDefault();
    });

    $("#company_member_boss_time_knowndate").on("dp.change", function (e){
        $("#company_member_boss_time_knowndate2").data("DateTimePicker").minDate(e.date);
    });
    $("#company_member_boss_time_knowndate2").on("dp.change", function (e){
        $("#company_member_boss_time_knowndate").data("DateTimePicker").maxDate(e.date);
    });
    ////

    ////
    $("#company_supervisor_time1").datetimepicker({
        locale: "hu",
        minDate: moment(),
        format: "L"
    });
    $( "#company_supervisor_time1" ).keypress(function(e){
        e.preventDefault();
    });

    $("#company_supervisor_time2").datetimepicker({
        locale: "hu",
        minDate: moment(),
        useCurrent: false, //Important! See issue #1075
        format: "L"
    });
    $( "#company_supervisor_time2" ).keypress(function(e){
        e.preventDefault();
    });

    $("#company_supervisor_time1").on("dp.change", function (e){
        $("#company_supervisor_time2").data("DateTimePicker").minDate(e.date);
    });
    $("#company_supervisor_time2").on("dp.change", function (e){
        $("#company_supervisor_time1").data("DateTimePicker").maxDate(e.date);
    });
    ////

    $( "#appointment_date_1" ).datetimepicker({
        locale: "hu",
        stepping: 5,
        minDate: moment()
    });
    $( "#appointment_date_1" ).keypress(function(e){
        e.preventDefault();
    });

    $( "#appointment_date_2" ).datetimepicker({
        locale: "hu",
        stepping: 5,
        minDate: moment()
    });
    $( "#appointment_date_2" ).keypress(function(e){
        e.preventDefault();
    });

    $( "#appointment_date_3" ).datetimepicker({
        locale: "hu",
        stepping: 5,
        minDate: moment()
    });
    $( "#appointment_date_3" ).keypress(function(e){
        e.preventDefault();
    });
});
////

// Preview of company names (2020.08.30) Attila
$(document).on("change", "#company_name", function()
{
    var inputVal = $(this).val();

    if (inputVal == "")
    {
        $(this).parent().find("#name_prev").text("Korlátolt Felelősségű Társaság");
    }
    else
    {
        $(this).parent().find("#name_prev").text(inputVal + " " + "Korlátolt Felelősségű Társaság");
    }
});

$(document).on("change", "#company_short_name", function()
{
    var inputVal = $(this).val();

    if (inputVal == "")
    {
        $(this).parent().find("#name_prev").text("Kft.");
    }
    else
    {
        $(this).parent().find("#name_prev").text(inputVal + " " + "Kft.");
    }
});
////

// for setting the main place
$(document).on("change", ".main-place", function()
{
    if ($(this).is(":checked"))
    {
        var name = $(this).parent().parent().parent().find("input[id*=zip]").attr("name");
        var split_id = name.split("_");
        var index = Number(split_id[split_id.length - 1]);

        if (name.includes("seat"))
        {
            $("#company_main_place").val("seat");
        }
        else if (name.includes("site"))
        {
            $("#company_main_place").val("site_"+index);
        }
        else if (name.includes("branch"))
        {
            $("#company_main_place").val("branch_"+index);
        }
    }
});
////

// company type select change detect
$(document).on("change","#company_type",function()
{
    var selectValue = $(this).val();

    if (selectValue.includes("Egyszemélyes"))
    {
        $(".addmember").hide();
        $("#statistics").hide();
        $("#mem").text("Tag");
    }
    else
    {
        $(".addmember").show();
        $("#statistics").show();
        $("#mem").text("Tagok");
    }
});
////

// member type select change detect
$(document).on("change","#company_member_type",function()
{
    var selectValue = $(this).val();

    if (selectValue.includes("Magánszemély"))
    {
        $(this).parent().parent().parent().find("#type2").hide();
        $(this).parent().parent().parent().find("#type1").show();
        InputValidation();
    }
    else
    {

        $(this).parent().parent().parent().find("#type2").show();
        $(this).parent().parent().parent().find("#type1").hide();
        InputValidation();
    }
});
////

// manager type select change detect
$(document).on("change","#manager_type",function()
{
    var selectValue = $(this).val();

    if (selectValue.includes("Magánszemély"))
    {
        $(this).parent().parent().parent().find("#manager-type2").hide();
        $(this).parent().parent().parent().find("#manager-type1").show();
        InputValidation();
    }
    else
    {

        $(this).parent().parent().parent().find("#manager-type2").show();
        $(this).parent().parent().parent().find("#manager-type1").hide();
        InputValidation();
    }
});
////

// Id option change
$(document).on("change","#company_member_id",function()
{
    var selectValue = $(this).val();

    if (selectValue.includes("Személyi"))
    {
        $(this).parent().parent().find("#company_member_idnumber").prop("placeholder", "123456AB");
        $("#id-upload").text("Töltsd fel a személyi igazolványod elő- és hátlapját!");
    }
    else
    {
        $(this).parent().parent().find("#company_member_idnumber").prop("placeholder", "AB1234567");
        $("#id-upload").text("Töltsd fel az útleveled elő- és hátlapját!");
    }

    $(this).parent().parent().find("label[for=company_member_birthplace]").text($(this).val());
});
////

// evidence document dowloading and filling (2020.08.04) Attila
$(".getEviDoc").on("click", function(e)
{
    var attr = $(this).parent().parent().parent().attr("id");
    var zip = "";
    var city = "";
    var address = "";
    var address2 = "";
    var name = "";
    var type = "";

    if (attr == "seat-group")
    {
        zip = $("#company_seat_zip").val();
        city = $("#company_seat_city").val();
        address = $("#company_seat_address").val();
        address2 = $("#company_seat_address2").val();
        name = $("#company_name").val();
        type = "székhelyeként";
    }
    else if (attr == "sites-group")
    {
        zip = $(this).parent().parent().parent().find("#company_site_zip").val();
        city = $(this).parent().parent().parent().find("#company_site_city").val();
        address = $(this).parent().parent().parent().find("#company_site_address").val();
        address2 = $(this).parent().parent().parent().find("#company_site_address2").val();
        name = $("#company_name").val();
        type = "telephelyeként";
    }
    else if (attr == "branch-group")
    {
        zip = $(this).parent().parent().parent().find("#company_branch_zip").val();
        city = $(this).parent().parent().parent().find("#company_branch_city").val();
        address = $(this).parent().parent().parent().find("#company_branch_address").val();
        address2 = $(this).parent().parent().parent().find("#company_branch_address2").val();
        name = $("#company_name").val();
        type = "fióktelepeként";
    }

    if (zip == "" || city == "" || address == "" || address2 == "" || name == "")
    {
        alert("Töltsd ki a cégnév és cím adatokat az igazoló dokumentum letöltéséhez!");
    }
    else
    {
        var data = [
            { "type": "evidence" },
            { "company_name": name,
            "company_zip": zip,
            "company_city": city,
            "company_address": address,
            "company_second": address2,
            "place_type": type }
        ];

        $.ajax({
            url: "ajax.php",
            type: "POST",
            data: JSON.stringify(data),
            contentType: "application/json",
            success: HandleFiller
        });
    }
});
////

// Manager approval document filling and downloading (2020.08.07) Attila
$(".getManagerDoc").on("click", function(e)
{
    InputValidation();
    var manager = "";
    var invalid = 0;
    manager = $(this).parent().parent().attr("id");

    if ($(this).parent().parent().find("#company_member_boss").is(":checked") || manager.includes("manager_container"))
    {
        console.log(manager);
        invalid = $(this).parent().parent().find(".is-invalid").length;

        if (manager != "")
        {
            if (invalid == 0)
            {
                if (manager.includes("manager_container"))
                {
                    var company = $("#company_name").val();
                    var seat = $("#company_seat_zip").val() + " " + $("#company_seat_city").val() + " " + $("#company_seat_address").val() + " " + $("#company_seat_address2").val();
                    var fulladress = $("#"+manager).find("#manager_country").val() + " " + $("#"+manager).find("#manager_zip").val() + " " + $("#"+manager).find("#manager_city").val() + " " + $("#"+manager).find("#manager_address").val() + " " + $("#"+manager).find("#manager_address2").val();
                    var name = $("#"+manager).find("#manager_firstname").val() + " " + $("#"+manager).find("#manager_lastname").val();
                    //var mothername = $("#"+manager).find("#company_member_mothername").val();
                    var mothername = "....................";
                    //var birth = $("#"+manager).find("#company_member_date").val() + " " + $("#"+manager).find("#company_member_birthplace").val();
                    var birth = "....................";
                    //var vatnum = $("#"+manager).find("#company_member_vatnumber").val();
                    var vatnum = "....................";
                    var time = "";

                    if (seat == "   ")
                    {
                        alert("A cég székhelye nincs kitöltve kérlek töltsd ki!");
                    }
                    else
                    {
                        /*if ($("#"+manager).find("#company_member_boss_time_unknown").is(":checked"))
                        {
                            time = "határozatlan";
                        }
                        else
                        {
                            time = $("#"+manager).find("#company_member_boss_time_knowndate2").val() + " napig tartó határozott";
                        }*/

                        var date = new Date().toISOString().slice(0,10);
                        date = date.replace(/-/g, "/");

                        alert(fulladress);

                        var data = [
                            { "type": "manager" },
                            { "company_name": company,
                            "company_member_fulladdress": fulladress,
                            "company_member_name": name,
                            "company_member_mothername": mothername,
                            "company_member_birth": birth,
                            "company_member_vatnumber": vatnum,
                            "current_date": date,
                            "company_member_time": time,
                            "company_seat_address": seat }
                        ];

                        $.ajax({
                            url: "ajax.php",
                            type: "POST",
                            data: JSON.stringify(data),
                            contentType: "application/json",
                            success: HandleFiller
                        });
                    }
                }
                else
                {
                    var company = $("#company_name").val();
                    var seat = $("#company_seat_zip").val() + " " + $("#company_seat_city").val() + " " + $("#company_seat_address").val() + " " + $("#company_seat_address2").val();
                    var fulladress = $("#"+manager).find("#company_member_country").val() + " " + $("#"+manager).find("#company_member_zip").val() + " " + $("#"+manager).find("#company_member_city").val() + " " + $("#"+manager).find("#company_member_address").val() + " " + $("#"+manager).find("#company_member_address2").val();
                    var name = $("#"+manager).find("#company_member_firstname").val() + " " + $("#"+manager).find("#company_member_lastname").val();
                    var mothername = $("#"+manager).find("#company_member_mothername").val();
                    var birth = $("#"+manager).find("#company_member_date").val() + " " + $("#"+manager).find("#company_member_birthplace").val();
                    var vatnum = $("#"+manager).find("#company_member_vatnumber").val();
                    var time = "";

                    if (seat == "   ")
                    {
                        alert("A cég székhelye nincs kitöltve kérlek töltsd ki!");
                    }
                    else
                    {
                        if ($("#"+manager).find("#company_member_boss_time_unknown").is(":checked"))
                        {
                            time = "határozatlan";
                        }
                        else
                        {
                            time = $("#"+manager).find("#company_member_boss_time_knowndate2").val() + " napig tartó határozott";
                        }

                        var date = new Date().toISOString().slice(0,10);
                        date = date.replace(/-/g, "/");

                        var data = [
                            { "type": "manager" },
                            { "company_name": company,
                            "company_member_fulladdress": fulladress,
                            "company_member_name": name,
                            "company_member_mothername": mothername,
                            "company_member_birth": birth,
                            "company_member_vatnumber": vatnum,
                            "current_date": date,
                            "company_member_time": time,
                            "company_seat_address": seat }
                        ];

                        $.ajax({
                            url: "ajax.php",
                            type: "POST",
                            data: JSON.stringify(data),
                            contentType: "application/json",
                            success: HandleFiller
                        });
                    }
                }
            }
            else
            {
                alert("Hibás mező értékeket találtam a kijelölt ügyvezetőnél!");
            }
        }
    }
});
////

// Select change detect for months
$(document).on("change","#month",function()
{
    var selectValue = $(this).val();

    if (selectValue == "Január" || selectValue == "Március" || selectValue == "Május" || selectValue == "Július" || selectValue == "Augusztus" || selectValue == "Október" || selectValue == "December")
    {
        for (let index = 1; index < 32; index++) // 31
        {
            $("#day").append($("<option></option>").attr("value", index).text(index));
        }
    }
    else if (selectValue == "Április" || selectValue == "Június" || selectValue == "Szeptember" || selectValue == "November")
    {
        for (let index = 1; index < 31; index++) // 30
        {
            $("#day").append($("<option></option>").attr("value", index).text(index));
        }
    }
    else
    {
        for (let index = 1; index < 29; index++) // 28
        {
            $("#day").append($("<option></option>").attr("value", index).text(index));
        }
    }
});
////

// File upload drag and drop
Dropzone.autoDiscover = false;

// Modified dropzone to remove files on remove link click (2020.07.30) Attila
// And also fixed the dynamic duplication issue
new Dropzone("#dropzone", {
    previewTemplate: document.querySelector("#preview-template").innerHTML,
    url: "upload.php",
    acceptedFiles: ".png, .jpg, .jpeg, .pdf, .docx, .doc, .odt",
    parallelUploads: 2, // the amount of file uploads at the same time
    thumbnailHeight: 120, // px
    thumbnailWidth: 120, // px
    maxFilesize: 15, // 15 mb
    params: { "type": "bizonyíték", "name": "none" },
    addRemoveLinks: true,
    sending: function(file, xhr, formData)
    {
        var zip = $("#company_seat_zip").val();
        var city = $("#company_seat_city").val();
        var address = $("#company_seat_address").val();
        var address2 = $("#company_seat_address2").val();
        var name = $("#company_name").val();

        var data = {
            0: zip,
            1: city,
            2: address,
            3: address2 };

        formData.append("address", JSON.stringify(data));
        formData.append("company_name", name);
    },
    success: function(file, response)
    {
        HandleAjax(response);
    },
    removedfile: function(file)
    {
        var filename = file.name;
        var zip = $("#company_seat_zip").val();
        var city = $("#company_seat_city").val();
        var address = $("#company_seat_address").val();
        var address2 = $("#company_seat_address2").val();
        var name = $("#company_name").val();

        $.ajax({
            url: "remove.php",
            data: { 
                filename: filename, 
                type: "bizonyíték", 
                name: "none", 
                address:  JSON.stringify({
                0: zip,
                1: city,
                2: address,
                3: address2 }), 
                company_name: name 
            },
            type: "POST",
            success: function()
            {
                console.log("Removed");
            }
        })
        var _ref;
        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0; // this needs to be returned to remove the thumbnail from the container
    },
    
    filesizeBase: 1000,
    thumbnail: function(file, dataUrl) {
      if (file.previewElement) {
        file.previewElement.classList.remove("dz-file-preview");
        var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
        for (var i = 0; i < images.length; i++) {
          var thumbnailElement = images[i];
          thumbnailElement.alt = file.name;
          thumbnailElement.src = dataUrl;
        }
        setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 1);
      }
    }
  
});

new Dropzone("#dropzone_1", {
    previewTemplate: document.querySelector("#preview-template").innerHTML,
    url: "upload.php",
    acceptedFiles: ".png, .jpg, .jpeg, .pdf, .docx, .doc, .odt",
    parallelUploads: 2,
    thumbnailHeight: 120,
    thumbnailWidth: 120,
    maxFilesize: 5,
    params: { "type": "azonosítóokmány", "address": "none" },
    addRemoveLinks: true,
    sending: function(file, xhr, formData)
    {
        formData.append("name", $("#company_member_firstname").val() + "-" + $("#company_member_lastname").val());
        formData.append("company_name", $("#company_name").val());
    },
    success: function(file, response)
    {
        HandleAjax(response);
    },
    removedfile: function(file)
    {
        var filename = file.name; 

        $.ajax({
            url: "remove.php",
            data: { filename: filename, type: "azonosítóokmány", name: $("#company_member_firstname").val() + "-" + $("#company_member_lastname").val(), company_name: $("#company_name").val(), address: "none" },
            type: "POST",
            success: function()
            {
                console.log("Removed");
            }
        })
        var _ref;
        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0; // this needs to be returned to remove the thumbnail from the container
    },
    
    filesizeBase: 1000,
    thumbnail: function(file, dataUrl) {
      if (file.previewElement) {
        file.previewElement.classList.remove("dz-file-preview");
        var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
        for (var i = 0; i < images.length; i++) {
          var thumbnailElement = images[i];
          thumbnailElement.alt = file.name;
          thumbnailElement.src = dataUrl;
        }
        setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 1);
      }
    }
  
});

new Dropzone("#dropzone_2", {
    previewTemplate: document.querySelector("#preview-template").innerHTML,
    url: "upload.php",
    acceptedFiles: ".png, .jpg, .jpeg, .pdf, .docx, .doc, .odt",
    parallelUploads: 2,
    thumbnailHeight: 120,
    thumbnailWidth: 120,
    maxFilesize: 5,
    params: { "type": "lakcímkártya", "address": "none" },
    addRemoveLinks: true,
    sending: function(file, xhr, formData)
    {
        formData.append("name", $("#company_member_firstname").val() + "-" + $("#company_member_lastname").val());
        formData.append("company_name", $("#company_name").val());
    },
    success: function(file, response)
    {
        HandleAjax(response);
    },
    removedfile: function(file)
    {
        var filename = file.name; 

        $.ajax({
            url: "remove.php",
            data: { filename: filename, type: "lakcímkártya", name: $("#company_member_firstname").val() + "-" + $("#company_member_lastname").val(), company_name: $("#company_name").val(), address: "none" },
            type: "POST",
            success: function()
            {
                console.log("Removed");
            }
        })
        var _ref;
        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0; // this needs to be returned to remove the thumbnail from the container
    },
    
    filesizeBase: 1000,
    thumbnail: function(file, dataUrl) {
      if (file.previewElement) {
        file.previewElement.classList.remove("dz-file-preview");
        var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
        for (var i = 0; i < images.length; i++) {
          var thumbnailElement = images[i];
          thumbnailElement.alt = file.name;
          thumbnailElement.src = dataUrl;
        }
        setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 1);
      }
    }
  
});

new Dropzone("#dropzone_3", {
    previewTemplate: document.querySelector("#preview-template").innerHTML,
    url: "upload.php",
    acceptedFiles: ".png, .jpg, .jpeg, .pdf, .docx, .doc, .odt",
    parallelUploads: 2,
    thumbnailHeight: 120,
    thumbnailWidth: 120,
    maxFilesize: 5,
    params: { "type": "adókártya", "address": "none" },
    addRemoveLinks: true,
    sending: function(file, xhr, formData)
    {
        formData.append("name", $("#company_member_firstname").val() + "-" + $("#company_member_lastname").val());
        formData.append("company_name", $("#company_name").val());
    },
    success: function(file, response)
    {
        HandleAjax(response);
    },
    removedfile: function(file)
    {
        var filename = file.name; 

        $.ajax({
            url: "remove.php",
            data: { filename: filename, type: "adókártya", name: $("#company_member_firstname").val() + "-" + $("#company_member_lastname").val(), company_name: $("#company_name").val(), address: "none" },
            type: "POST",
            success: function()
            {
                console.log("Removed");
            }
        })
        var _ref;
        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0; // this needs to be returned to remove the thumbnail from the container
    },
    
    filesizeBase: 1000,
    thumbnail: function(file, dataUrl) {
      if (file.previewElement) {
        file.previewElement.classList.remove("dz-file-preview");
        var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
        for (var i = 0; i < images.length; i++) {
          var thumbnailElement = images[i];
          thumbnailElement.alt = file.name;
          thumbnailElement.src = dataUrl;
        }
        setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 1);
      }
    }
  
});

new Dropzone("#dropzone_4", {
    previewTemplate: document.querySelector("#preview-template").innerHTML,
    url: "upload.php",
    acceptedFiles: ".png, .jpg, .jpeg, .pdf, .docx, .doc, .odt",
    parallelUploads: 2,
    thumbnailHeight: 120,
    thumbnailWidth: 120,
    maxFilesize: 5,
    params: { "type": "lakcímkártya", "address": "none" },
    addRemoveLinks: true,
    sending: function(file, xhr, formData)
    {
        formData.append("name", $("#company_member_type2_firstname").val() + "-" + $("#company_member_type2_lastname").val());
        formData.append("company_name", $("#company_name").val());
    },
    success: function(file, response)
    {
        HandleAjax(response);
    },
    removedfile: function(file)
    {
        var filename = file.name; 

        $.ajax({
            url: "remove.php",
            data: { filename: filename, type: "lakcímkártya", name: $("#company_member_type2_firstname").val() + "-" + $("#company_member_type2_lastname").val(), company_name: $("#company_name").val(), address: "none" },
            type: "POST",
            success: function()
            {
                console.log("Removed");
            }
        })
        var _ref;
        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0; // this needs to be returned to remove the thumbnail from the container
    },
    
    filesizeBase: 1000,
    thumbnail: function(file, dataUrl) {
      if (file.previewElement) {
        file.previewElement.classList.remove("dz-file-preview");
        var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
        for (var i = 0; i < images.length; i++) {
          var thumbnailElement = images[i];
          thumbnailElement.alt = file.name;
          thumbnailElement.src = dataUrl;
        }
        setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 1);
      }
    }
  
});

new Dropzone("#dropzone_5", {
    previewTemplate: document.querySelector("#preview-template").innerHTML,
    url: "upload.php",
    acceptedFiles: ".png, .jpg, .jpeg, .pdf, .docx, .doc, .odt",
    parallelUploads: 2,
    thumbnailHeight: 120,
    thumbnailWidth: 120,
    maxFilesize: 5,
    params: { "type": "ügyvezetőnyilatkozat", "address": "none" },
    addRemoveLinks: true,
    sending: function(file, xhr, formData)
    {
        formData.append("name", "ügyvezető");
        formData.append("company_name", $("#company_name").val());
    },
    success: function(file, response)
    {
        HandleAjax(response);
    },
    removedfile: function(file)
    {
        var filename = file.name; 

        $.ajax({
            url: "remove.php",
            data: { filename: filename, type: "ügyvezetőnyilatkozat", name: "ügyvezető", company_name: $("#company_name").val(), address: "none" },
            type: "POST",
            success: function()
            {
                console.log("Removed");
            }
        })
        var _ref;
        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0; // this needs to be returned to remove the thumbnail from the container
    },
    
    filesizeBase: 1000,
    thumbnail: function(file, dataUrl) {
      if (file.previewElement) {
        file.previewElement.classList.remove("dz-file-preview");
        var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
        for (var i = 0; i < images.length; i++) {
          var thumbnailElement = images[i];
          thumbnailElement.alt = file.name;
          thumbnailElement.src = dataUrl;
        }
        setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 1);
      }
    }
  
});
////

// Remove link on click send to backend to delete (2020.07.30) Attila
$(document).ready(function()
{
    $("a.dz-remove").on("click", function (e)
    {
        alert("clicked");
        e.preventDefault();
        e.stopPropagation();

        var filename = $(this).parent().parent().find(".dz-filename > span").text();

        $.ajax({
            url: "remove.php",
            data: { filename: filename},
            type: "POST"
        })

    });
});
////

// Add new boss
$(document).on("click", ".addboss", function (e) 
{
    var newBoss = $("#boss").clone(true);
    $(newBoss).find("input").val(""); // Reset input values on clone

    var $newButtons = "<button type='button' class='btn btn-primary removeboss' style='width: 50px;'>&#10060;</button>";

    var last_id = $("#boss input[id=boss_firstname]").last().attr("name");
    var split_id = last_id.split("_");

    // New index
    var newIndex = Number(split_id[split_id.length - 1]) + 1;

    // Set new id for the new elements
    $(newBoss).find("#boss_id").text("#"+newIndex);
    $(newBoss).find("input[id=boss_firstname]").attr("name","boss_firstname_"+newIndex);
    $(newBoss).find("input[id=boss_lastname]").attr("name","boss_lastname_"+newIndex);
    $(newBoss).find("input[id=boss_fullname]").attr("name","boss_fullname_"+newIndex);
    $(newBoss).find("input[id=boss_country]").attr("name","boss_country_"+newIndex);
    $(newBoss).find("input[id=boss_zip]").attr("name","boss_zip_"+newIndex);
    $(newBoss).find("input[id=boss_city]").attr("name","boss_city_"+newIndex);
    $(newBoss).find("input[id=boss_address]").attr("name","boss_address_"+newIndex);
    $(newBoss).find("input[id=boss_address2]").attr("name","boss_address2_"+newIndex);
    $(newBoss).find("input[id=boss_time]").attr("name","boss_time_"+newIndex);
    $(newBoss).find("input[id=boss_time2]").attr("name","boss_time2_"+newIndex);

    $(newBoss).find("input[id=boss_time]").datetimepicker({
        locale: "hu",
        minDate: moment(),
        format: "L"
    });
    $(newBoss).find("input[id=boss_time]").keypress(function(e){
        e.preventDefault();
    });

    $(newBoss).find("input[id=boss_time2]").datetimepicker({
        locale: "hu",
        minDate: moment(),
        format: "L"
    });
    $(newBoss).find("input[id=boss_time2]").keypress(function(e){
        e.preventDefault();
    });

    $(newBoss).removeAttr("style");
    $(newBoss).find(".btn-here").html($newButtons).end().appendTo($("#newbossappendhere"));
    var num = $("#company_boss_num").val();
    $("#company_boss_num").val(parseInt(num) + 1);

    InputValidation();
});

$(document).on("click", ".removeboss", function () 
{
    if (confirm("Biztosan törlöd?"))
    {
        var num = $("#company_boss_num").val();
        $("#company_boss_num").val(parseInt(num) - 1);
        $(this).parent().parent().parent().remove(); // onclick we remove the instance that was created
    }
});
////

// Add new manager
$(document).on("click", ".addmanager", function (e) 
{
    var newManager = $("#manager").clone(true);
    $(newManager).find("input").val(""); // Reset input values on clone

    var $newButtons = "<button type='button' class='btn btn-primary removemanager' style='width: 50px;'>&#10060;</button>";

    var last_id = $("#manager select[id=manager_type]").last().attr("name");
    var split_id = last_id.split("_");

    // New index
    var newIndex = Number(split_id[split_id.length - 1]) + 1;

    // Set new id for the new elements
    $(newManager).find("#manager_id").text("#"+newIndex);
    $(newManager).find("select[id=manager_type]").attr("name","manager_type_"+newIndex);
    $(newManager).find("input[id=manager_company_number]").attr("name","manager_company_number_"+newIndex);
    $(newManager).find("input[id=manager_seat_type2_zip]").attr("name","manager_seat_type2_zip_"+newIndex);
    $(newManager).find("input[id=manager_seat_type2_city]").attr("name","manager_seat_type2_city_"+newIndex);
    $(newManager).find("input[id=manager_seat_type2_address]").attr("name","manager_seat_type2_address_"+newIndex);
    $(newManager).find("input[id=manager_seat_type2_address2]").attr("name","manager_seat_type2_address2_"+newIndex);
    $(newManager).find("input[id=manager_type2_firstname]").attr("name","manager_type2_firstname_"+newIndex);
    $(newManager).find("input[id=manager_type2_lastname]").attr("name","manager_type2_lastname_"+newIndex);
    $(newManager).find("input[id=manager_type2_fullname]").attr("name","manager_type2_fullname_"+newIndex);
    $(newManager).find("input[id=manager_type2_country]").attr("name","manager_type2_country_"+newIndex);
    $(newManager).find("input[id=manager_type2_zip]").attr("name","manager_type2_zip_"+newIndex);
    $(newManager).find("input[id=manager_type2_city]").attr("name","manager_type2_city_"+newIndex);
    $(newManager).find("input[id=manager_type2_address]").attr("name","manager_type2_address_"+newIndex);
    $(newManager).find("input[id=manager_type2_address2]").attr("name","manager_type2_address2_"+newIndex);
    $(newManager).find("input[id=manager_firstname]").attr("name","manager_firstname_"+newIndex);
    $(newManager).find("input[id=manager_lastname]").attr("name","manager_lastname_"+newIndex);
    $(newManager).find("input[id=manager_fullname]").attr("name","manager_fullname_"+newIndex);
    $(newManager).find("input[id=manager_country]").attr("name","manager_country_"+newIndex);
    $(newManager).find("input[id=manager_zip]").attr("name","manager_zip_"+newIndex);
    $(newManager).find("input[id=manager_city]").attr("name","manager_city_"+newIndex);
    $(newManager).find("input[id=manager_address]").attr("name","manager_address_"+newIndex);
    $(newManager).find("input[id=manager_address2]").attr("name","manager_address2_"+newIndex);

    $(newManager).removeAttr("style");
    $(newManager).find(".btn-here").html($newButtons).end().appendTo($("#newmanagerappendhere"));
    var num = $("#company_manager_num").val();
    $("#company_manager_num").val(parseInt(num) + 1);

    var drop = $("div.dropzone").length;

    var newDropId = drop;
    $(newManager).find("div.dropzone").each(function()
    {
        newDropId++;
        $(this).find("div.dz-preview").remove();
        $(this).removeClass("dz-started");
        $(this).attr("id", "dropzone_"+newDropId);
    });

    new Dropzone("#dropzone_"+newDropId, {
        previewTemplate: document.querySelector("#preview-template").innerHTML,
        url: "upload.php",
        acceptedFiles: ".png, .jpg, .jpeg, .pdf, .docx, .doc, .odt",
        parallelUploads: 2,
        thumbnailHeight: 120,
        thumbnailWidth: 120,
        maxFilesize: 5,
        params: { "type": "ügyvezetőnyilatkozat", "address": "none" },
        addRemoveLinks: true,
        sending: function(file, xhr, formData)
        {
            formData.append("name", "ügyvezető");
            formData.append("company_name", $("#company_name").val());
        },
        success: function(file, response)
        {
            HandleAjax(response);
        },
        removedfile: function(file)
        {
            var filename = file.name;
    
            $.ajax({
                url: "remove.php",
                data: { filename: filename, type: "ügyvezetőnyilatkozat", name: "ügyvezető", company_name: $("#company_name").val(), address: "none" },
                type: "POST",
                success: function()
                {
                    console.log("Removed");
                }
            })
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0; // this needs to be returned to remove the thumbnail from the container
        },
        
        filesizeBase: 1000,
        thumbnail: function(file, dataUrl) {
          if (file.previewElement) {
            file.previewElement.classList.remove("dz-file-preview");
            var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
            for (var i = 0; i < images.length; i++) {
              var thumbnailElement = images[i];
              thumbnailElement.alt = file.name;
              thumbnailElement.src = dataUrl;
            }
            setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 1);
          }
        }
      
    });

    InputValidation();
});

$(document).on("click", ".removemanager", function () 
{
    if (confirm("Biztosan törlöd?"))
    {
        var num = $("#company_manager_num").val();
        $("#company_manager_num").val(parseInt(num) - 1);
        $(this).parent().parent().parent().remove(); // onclick we remove the instance that was created
    }
});
////

// Add new site
$(document).on("click", ".addsite", function (e) 
{
    $(".main-place").prop("disabled", false);

    var newSite = $("#site").clone(true);
    var downloadBtn = $(newSite).find(".getEviDoc").val();
    $(newSite).find("input").val(""); // Reset input values on clone
    $(newSite).find(".getEviDoc").val(downloadBtn);

    var $newButtons = "<button type='button' class='btn btn-primary removesite' style='width: 50px;'>&#10060;</button>";

    var last_id = $("#sites-group input[id=company_site_zip]").last().attr("name");
    var split_id = last_id.split("_");

    // New index
    var newIndex = Number(split_id[split_id.length - 1]) + 1;

    // Set new id for the new elements
    $(newSite).find("#site-tag").html("<strong>"+"Telephely #"+newIndex+"</strong>");
    $(newSite).find("input[id=company_site_zip]").attr("name","company_site_zip_"+newIndex);
    $(newSite).find("input[id=company_site_city]").attr("name","company_site_city_"+newIndex);
    $(newSite).find("input[id=company_site_address]").attr("name","company_site_address_"+newIndex);
    $(newSite).find("input[id=company_site_address2]").attr("name","company_site_address2_"+newIndex);

    $(newSite).removeAttr("style");
    $(newSite).find(".btn-here").html($newButtons).end().appendTo($("#newsiteappendhere"));
    var num = $("#company_site_num").val();
    $("#company_site_num").val(parseInt(num) + 1);

    var drop = $("div.dropzone").length;

    var newDropId = drop;
    $(newSite).find("div.dropzone").each(function()
    {
        newDropId++;
        $(this).find("div.dz-preview").remove();
        $(this).removeClass("dz-started");
        $(this).attr("id", "dropzone_"+newDropId);
    });

    new Dropzone("#dropzone_"+newDropId, {
        previewTemplate: document.querySelector("#preview-template").innerHTML,
        url: "upload.php",
        acceptedFiles: ".png, .jpg, .jpeg, .pdf, .docx, .doc, .odt",
        parallelUploads: 2, // the amount of file uploads at the same time
        thumbnailHeight: 120, // px
        thumbnailWidth: 120, // px
        maxFilesize: 15, // 15 mb
        params: { "type": "bizonyíték", "name": "none" },
        addRemoveLinks: true,
        sending: function(file, xhr, formData)
        {
            var zip = $(newSite).find("#company_site_zip").val();
            var city = $(newSite).find("#company_site_city").val();
            var address = $(newSite).find("#company_site_address").val();
            var address2 = $(newSite).find("#company_site_address2").val();
            var name = $("#company_name").val();

            var data = {
                0: zip,
                1: city,
                2: address,
                3: address2 };

            formData.append("address", JSON.stringify(data));
            formData.append("company_name", name);
        },
        success: function(file, response)
        {
            HandleAjax(response);
        },
        removedfile: function(file)
        {
            var filename = file.name;
            var zip = $(newSite).find("#company_site_zip").val();
            var city = $(newSite).find("#company_site_city").val();
            var address = $(newSite).find("#company_site_address").val();
            var address2 = $(newSite).find("#company_site_address2").val();
            var name = $("#company_name").val();

            $.ajax({
                url: "remove.php",
                data: { 
                    filename: filename, 
                    type: "bizonyíték", 
                    name: "none", 
                    address:  JSON.stringify({
                    0: zip,
                    1: city,
                    2: address,
                    3: address2 }), 
                    company_name: name 
                },
                type: "POST",
                success: function()
                {
                    console.log("Removed");
                }
            })
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0; // this needs to be returned to remove the thumbnail from the container
        },
        
        filesizeBase: 1000,
        thumbnail: function(file, dataUrl) {
          if (file.previewElement) {
            file.previewElement.classList.remove("dz-file-preview");
            var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
            for (var i = 0; i < images.length; i++) {
              var thumbnailElement = images[i];
              thumbnailElement.alt = file.name;
              thumbnailElement.src = dataUrl;
            }
            setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 1);
          }
        }
      
    });

    InputValidation();
});

$(document).on("click", ".removesite", function () 
{
    if (confirm("Biztosan törlöd?")) 
    {
        var num = $("#company_site_num").val();
        var num2 = $("#company_branch_num").val();
        $("#company_site_num").val(parseInt(num) - 1);
        var numAfter = $("#company_site_num").val();
        if (numAfter == 0 && num2 == 0)
        {
            $(".main-place").prop("disabled", true);
        }

        $(this).parent().parent().parent().parent().parent().remove(); // onclick we remove the instance that was created
    }
});
////

// Add new branch
$(document).on("click", ".addbranch", function (e) 
{
    $(".main-place").prop("disabled", false);

    var newBranch = $("#branch").clone(true);
    var downloadBtn = $(newBranch).find(".getEviDoc").val();
    $(newBranch).find("input").val(""); // Reset input values on clone
    $(newBranch).find(".getEviDoc").val(downloadBtn);

    var $newButtons = "<button type='button' class='btn btn-primary removebranch' style='width: 50px;'>&#10060;</button>";

    var last_id = $("#branch-group input[id=company_branch_zip]").last().attr("name");
    var split_id = last_id.split("_");

    // New index
    var newIndex = Number(split_id[split_id.length - 1]) + 1;

    // Set new id for the new elements
    $(newBranch).find("#branch-tag").html("<strong>"+"Fióktelep #"+newIndex+"</strong>");
    $(newBranch).find("input[id=company_branch_zip]").attr("name","company_branch_zip_"+newIndex);
    $(newBranch).find("input[id=company_branch_city]").attr("name","company_branch_city_"+newIndex);
    $(newBranch).find("input[id=company_branch_address]").attr("name","company_branch_address_"+newIndex);
    $(newBranch).find("input[id=company_branch_address2]").attr("name","company_branch_address2_"+newIndex);

    $(newBranch).removeAttr("style");
    $(newBranch).find(".btn-here").html($newButtons).end().appendTo($("#newbranchappendhere"));
    var num = $("#company_branch_num").val();
    $("#company_branch_num").val(parseInt(num) + 1);

    var drop = $("div.dropzone").length;

    var newDropId = drop;
    $(newBranch).find("div.dropzone").each(function()
    {
        newDropId++;
        $(this).find("div.dz-preview").remove();
        $(this).removeClass("dz-started");
        $(this).attr("id", "dropzone_"+newDropId);
    });

    new Dropzone("#dropzone_"+newDropId, {
        previewTemplate: document.querySelector("#preview-template").innerHTML,
        url: "upload.php",
        acceptedFiles: ".png, .jpg, .jpeg, .pdf, .docx, .doc, .odt",
        parallelUploads: 2, // the amount of file uploads at the same time
        thumbnailHeight: 120, // px
        thumbnailWidth: 120, // px
        maxFilesize: 15, // 15 mb
        params: { "type": "bizonyíték", "name": "none" },
        addRemoveLinks: true,
        sending: function(file, xhr, formData)
        {
            var zip = $(newBranch).find("#company_branch_zip").val();
            var city = $(newBranch).find("#company_branch_city").val();
            var address = $(newBranch).find("#company_branch_address").val();
            var address2 = $(newBranch).find("#company_branch_address2").val();
            var name = $("#company_name").val();

            var data = {
                0: zip,
                1: city,
                2: address,
                3: address2 };

            formData.append("address", JSON.stringify(data));
            formData.append("company_name", name);
        },
        success: function(file, response)
        {
            HandleAjax(response);
        },
        removedfile: function(file)
        {
            var filename = file.name;
            var zip = $(newBranch).find("#company_branch_zip").val();
            var city = $(newBranch).find("#company_branch_city").val();
            var address = $(newBranch).find("#company_branch_address").val();
            var address2 = $(newBranch).find("#company_branch_address2").val();
            var name = $("#company_name").val();
    
            $.ajax({
                url: "remove.php",
                data: {
                    filename: filename,
                    type: "bizonyíték",
                    name: "none",
                    address:  JSON.stringify({
                    0: zip,
                    1: city,
                    2: address,
                    3: address2 }),
                    company_name: name
                },
                type: "POST",
                success: function()
                {
                    console.log("Removed");
                }
            })
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0; // this needs to be returned to remove the thumbnail from the container
        },
        
        filesizeBase: 1000,
        thumbnail: function(file, dataUrl) {
          if (file.previewElement) {
            file.previewElement.classList.remove("dz-file-preview");
            var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
            for (var i = 0; i < images.length; i++) {
              var thumbnailElement = images[i];
              thumbnailElement.alt = file.name;
              thumbnailElement.src = dataUrl;
            }
            setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 1);
          }
        }
      
    });

    InputValidation();
});

$(document).on("click", ".removebranch", function () 
{
    if (confirm("Biztosan törlöd?")) 
    {
        var num = $("#company_branch_num").val();
        var num2 = $("#company_site_num").val();
        $("#company_branch_num").val(parseInt(num) - 1);
        var numAfter = $("#company_branch_num").val();
        if (numAfter == 0 && num2 == 0)
        {
            $(".main-place").prop("disabled", true);
        }

        $(this).parent().parent().parent().parent().parent().remove(); // onclick we remove the instance that was created
    }
});
////

// Member section collapser
function MemberCollapser()
{
    var coll = document.getElementsByClassName("collapsible"); // search for all the collapsible class name
    var i;

    for (i = 0; i < coll.length; i++)
    {
        coll[i].addEventListener("click", function() 
        {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.display === "block")
            {
                content.style.display = "none";
            } 
            else 
            {
                content.style.display = "block";
            }
        });
    }

    document.getElementById("company_member_number").value = $("div[id=member]").length; // Count added members for counter
}
////

// Add new member
$(document).on("click", ".addmember", function (e) 
{
    MemberCollapser();
    var newMember = $("#member").clone(true);
    $(newMember).find(".collapsible").html("<?php echo $messages['company-member']; ?><span name='member_id'>#1</span>"); // Reset name on clone
    $(newMember).find("#member-name").html("<?php echo $messages['company-member']; ?><span name='member_id'>#1</span>"); // Reset name on clone
    $(newMember).find("input").val(""); // Reset input values on clone
    $(newMember).find(".phone").val("+36");
    $(newMember).find(".currency").val("forint");

    var $newbuttons = "<button type='button' class='btn btn-primary removemember' style='width: 50px;'>&#10060;</button>";

    var last_id = $("#member select[id=company_member_type]").last().attr("name");
    var split_id = last_id.split("_");

    // New index
    var newIndex = Number(split_id[split_id.length - 1]) + 1;

    // Set new id for the new elements // Fixed it now it works just in they it needs to (2020.07.30) Attila
    $(newMember).find("div[class=member-container]").attr("id","member_container_"+newIndex)
    $(newMember).find("span[name=member_id]:nth-child(1)").attr("id","member_id_"+newIndex);// the datalist source doesn"t need to be changed
    $(newMember).find("span[name=member_id]:nth-child(2)").attr("id","member_id_"+newIndex);
    $(newMember).find("span[name=member_id]:nth-child(1)").text("#"+newIndex);
    $(newMember).find("span[name=member_id]:nth-child(2)").text("#"+newIndex);
    $(newMember).find("select[id=company_member_type]").attr("name","company_member_type_"+newIndex);
    $(newMember).find("input[id=company_member_boss]").attr("name","company_member_boss_"+newIndex);
    $(newMember).find("input[id=company_member_boss]").prop("checked", false);
    $(newMember).find("#time").hide();
    $(newMember).find("#managerDoc").hide();
    $(newMember).find("input[id=company_member_boss_manager]").attr("name","company_member_boss_manager_"+newIndex);
    $(newMember).find("input[id=company_member_boss_manager_self]").attr("name","company_member_boss_manager_self_"+newIndex);
    $(newMember).find("input[id=company_member_boss_time_unknown]").attr("name","company_member_boss_time_unknown_"+newIndex);
    $(newMember).find("input[id=company_member_internal]").attr("name","company_member_internal_"+newIndex);
    $(newMember).find("input[id=company_member_external]").attr("name","company_member_external_"+newIndex);
    $(newMember).find("input[id=company_member_boss_time_known]").attr("name","company_member_boss_time_known_"+newIndex);
    $(newMember).find("input[id=company_member_boss_lead_type1]").attr("name","company_member_boss_lead_type1_"+newIndex);
    $(newMember).find("input[id=company_member_boss_lead_type2]").attr("name","company_member_boss_lead_type2_"+newIndex);
    $(newMember).find("input[id=company_member_boss_time_knowndate]").attr("name","company_member_boss_time_knowndate_"+newIndex);
    $(newMember).find("input[id=company_member_boss_time_knowndate2]").attr("name","company_member_boss_time_knowndate2_"+newIndex);
    $(newMember).find("input[id=company_member_firstname]").attr("name","company_member_firstname_"+newIndex);
    $(newMember).find("input[id=company_member_lastname]").attr("name","company_member_lastname_"+newIndex);
    $(newMember).find("input[id=company_member_fullname]").attr("name","company_member_fullname_"+newIndex);
    $(newMember).find("input[id=company_member_date]").attr("name","company_member_date_"+newIndex);
    $(newMember).find("input[id=company_member_birthplace]").attr("name","company_member_birthplace_"+newIndex);
    $(newMember).find("select[id=company_member_id]").attr("name","company_member_id_"+newIndex);
    $(newMember).find("input[id=company_member_idnumber]").attr("name","company_member_idnumber_"+newIndex);
    $(newMember).find("input[id=company_member_country]").attr("name","company_member_country_"+newIndex);
    $(newMember).find("input[id=company_member_zip]").attr("name","company_member_zip_"+newIndex);
    $(newMember).find("input[id=company_member_city]").attr("name","company_member_city_"+newIndex);
    $(newMember).find("input[id=company_member_address]").attr("name","company_member_address_"+newIndex);
    $(newMember).find("input[id=company_member_address2]").attr("name","company_member_address2_"+newIndex);
    $(newMember).find("input[id=company_member_email]").attr("name","company_member_email_"+newIndex);
    $(newMember).find("input[id=company_member_email2]").attr("name","company_member_email2_"+newIndex);
    $(newMember).find("input[id=company_member_phone]").attr("name","company_member_phone_"+newIndex);
    $(newMember).find("input[id=company_member_money]").attr("name","company_member_money_"+newIndex);
    $(newMember).find("input[id=company_member_money2]").attr("name","company_member_money2_"+newIndex);
    $(newMember).find("input[id=company_member_money2_name]").attr("name","company_member_money2_name_"+newIndex);
    $(newMember).find("input[id=company_member_vatnumber]").attr("name","company_member_vatnumber_"+newIndex);
    $(newMember).find("input[id=company_member_mothername]").attr("name","company_member_mothername_"+newIndex);
    $(newMember).find("input[id=company_member_money_half]").attr("name","company_member_money_half_"+newIndex);
    $(newMember).find("input[id=company_member_pay_bank]").attr("name","company_member_pay_bank_"+newIndex);
    $(newMember).find("input[id=company_member_pay_notbank]").attr("name","company_member_pay_notbank_"+newIndex);
    $(newMember).find("input[id=company_member_money_payment_time]").attr("name","company_member_money_payment_time_"+newIndex);
    $(newMember).find("input[id=company_member_money_pay_atstart]").attr("name","company_member_money_pay_atstart_"+newIndex);
    $(newMember).find("input[id=company_member_money_pay_afterstart]").attr("name","company_member_money_pay_afterstart_"+newIndex);
    $(newMember).find("input[id=company_member_money_pay_afterstart_time]").attr("name","company_member_money_pay_afterstart_time_"+newIndex);
    $(newMember).find("input[id=company_member_email]").attr("name","company_member_email_"+newIndex);
    $(newMember).find("input[id=company_member_money_percent]").attr("name","company_member_money_percent_"+newIndex);
    $(newMember).find("input[id=company_member_company_number]").attr("name","company_member_company_number_"+newIndex);
    $(newMember).find("input[id=company_member_type2_firstname]").attr("name","company_member_type2_firstname_"+newIndex);
    $(newMember).find("input[id=company_member_type2_lastname]").attr("name","company_member_type2_lastname_"+newIndex);
    $(newMember).find("input[id=company_member_type2_fullname]").attr("name","company_member_type2_fullname_"+newIndex);
    $(newMember).find("input[id=company_seat_type2_zip]").attr("name","company_seat_type2_zip_"+newIndex);
    $(newMember).find("input[id=company_seat_type2_city]").attr("name","company_seat_type2_city_"+newIndex);
    $(newMember).find("input[id=company_seat_type2_address]").attr("name","company_seat_type2_address_"+newIndex);
    $(newMember).find("input[id=company_seat_type2_address2]").attr("name","company_seat_type2_address2_"+newIndex);
    $(newMember).find("input[id=company_member_type2_country]").attr("name","company_member_type2_country_"+newIndex);
    $(newMember).find("input[id=company_member_type2_zip]").attr("name","company_member_type2_zip_"+newIndex);
    $(newMember).find("input[id=company_member_type2_city]").attr("name","company_member_type2_city_"+newIndex);
    $(newMember).find("input[id=company_member_type2_address]").attr("name","company_member_type2_address_"+newIndex);
    $(newMember).find("input[id=company_member_type2_address2]").attr("name","company_member_type2_address2_"+newIndex);

    $(newMember).find("input[id=company_member_date]").datetimepicker({
        locale: "hu",
        minDate: moment(),
        format: "L"
    });
    $(newMember).find("input[id=company_member_date]").keypress(function(e){
        e.preventDefault();
    });

    var drop = $(document).find("div.dropzone").length;

    var newDropId = drop;
    $(newMember).find("div.dropzone").each(function()
    {
        newDropId++;
        $(this).find("div.dz-preview").remove();
        $(this).removeClass("dz-started");
        $(this).attr("id", "dropzone_"+newDropId);
    });

    $(newMember).find(".btn-here").html($newbuttons).end().appendTo($("#newmemberappendhere")); // creating new elements

    newDropId -= 3;
    new Dropzone("#dropzone_"+newDropId, {
        previewTemplate: document.querySelector("#preview-template").innerHTML,
        url: "upload.php",
        acceptedFiles: ".png, .jpg, .jpeg, .pdf, .docx, .doc, .odt",
        parallelUploads: 2,
        thumbnailHeight: 120,
        thumbnailWidth: 120,
        maxFilesize: 5,
        params: { "type": "lakcímkártya", "address": "none" },
        addRemoveLinks: true,
        sending: function(file, xhr, formData)
        {
            formData.append("name", $(newMember).find("input[id=company_member_type2_firstname]").val() + "-" + $(newMember).find("input[id=company_member_type2_lastname]").val());
            formData.append("company_name", $("#company_name").val());
        },
        success: function(file, response)
        {
            HandleAjax(response);
        },
        removedfile: function(file)
        {
            var filename = file.name; 
    
            $.ajax({
                url: "remove.php",
                data: { filename: filename, type: "lakcímkártya", name: $(newMember).find("input[id=company_member_type2_firstname]").val() + "-" + $(newMember).find("input[id=company_member_type2_lastname]").val(), company_name: $("#company_name").val(), address: "none" },
                type: "POST",
                success: function()
                {
                    console.log("Removed");
                }
            })
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0; // this needs to be returned to remove the thumbnail from the container
        },
        
        filesizeBase: 1000,
        thumbnail: function(file, dataUrl) {
          if (file.previewElement) {
            file.previewElement.classList.remove("dz-file-preview");
            var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
            for (var i = 0; i < images.length; i++) {
              var thumbnailElement = images[i];
              thumbnailElement.alt = file.name;
              thumbnailElement.src = dataUrl;
            }
            setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 1);
          }
        }
      
    });

    newDropId += 1;
    new Dropzone("#dropzone_"+newDropId, {
        previewTemplate: document.querySelector("#preview-template").innerHTML,
        url: "upload.php",
        acceptedFiles: ".png, .jpg, .jpeg, .pdf, .docx, .doc, .odt",
        parallelUploads: 2,
        thumbnailHeight: 120,
        thumbnailWidth: 120,
        maxFilesize: 5,
        params: { "type": "azonosítóokmány", "address": "none" },
        addRemoveLinks: true,
        sending: function(file, xhr, formData)
        {
            formData.append("name", $(newMember).find("input[id=company_member_firstname]").val() + "-" + $(newMember).find("input[id=company_member_lastname]").val());
            formData.append("company_name", $("#company_name").val());
        },
        success: function(file, response)
        {
            HandleAjax(response);
        },
        removedfile: function(file)
        {
            var filename = file.name; 
    
            $.ajax({
                url: "remove.php",
                data: { filename: filename, type: "azonosítóokmány", name: $(newMember).find("input[id=company_member_firstname]").val() + "-" + $(newMember).find("input[id=company_member_lastname]").val(), company_name: $("#company_name").val(), address: "none" },
                type: "POST",
                success: function()
                {
                    console.log("Removed");
                }
            })
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0; // this needs to be returned to remove the thumbnail from the container
        },
        
        filesizeBase: 1000,
        thumbnail: function(file, dataUrl) {
          if (file.previewElement) {
            file.previewElement.classList.remove("dz-file-preview");
            var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
            for (var i = 0; i < images.length; i++) {
              var thumbnailElement = images[i];
              thumbnailElement.alt = file.name;
              thumbnailElement.src = dataUrl;
            }
            setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 1);
          }
        }
      
    });
    
    newDropId += 1;
    new Dropzone("#dropzone_"+newDropId, {
        previewTemplate: document.querySelector("#preview-template").innerHTML,
        url: "upload.php",
        acceptedFiles: ".png, .jpg, .jpeg, .pdf, .docx, .doc, .odt",
        parallelUploads: 2,
        thumbnailHeight: 120,
        thumbnailWidth: 120,
        maxFilesize: 5,
        params: { "type": "lakcímkártya", "address": "none" },
        addRemoveLinks: true,
        sending: function(file, xhr, formData)
        {
            formData.append("name", $(newMember).find("input[id=company_member_firstname]").val() + "-" + $(newMember).find("input[id=company_member_lastname]").val());
            formData.append("company_name", $("#company_name").val());
        },
        success: function(file, response)
        {
            HandleAjax(response);
        },
        removedfile: function(file)
        {
            var filename = file.name; 
    
            $.ajax({
                url: "remove.php",
                data: { filename: filename, type: "lakcímkártya", name: $(newMember).find("input[id=company_member_firstname]").val() + "-" + $(newMember).find("input[id=company_member_lastname]").val(), company_name: $("#company_name").val(), address: "none" },
                type: "POST",
                success: function()
                {
                    console.log("Removed");
                }
            })
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0; // this needs to be returned to remove the thumbnail from the container
        },
        
        filesizeBase: 1000,
        thumbnail: function(file, dataUrl) {
          if (file.previewElement) {
            file.previewElement.classList.remove("dz-file-preview");
            var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
            for (var i = 0; i < images.length; i++) {
              var thumbnailElement = images[i];
              thumbnailElement.alt = file.name;
              thumbnailElement.src = dataUrl;
            }
            setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 1);
          }
        }
      
    });
    
    newDropId += 1;
    new Dropzone("#dropzone_"+newDropId, {
        previewTemplate: document.querySelector("#preview-template").innerHTML,
        url: "upload.php",
        acceptedFiles: ".png, .jpg, .jpeg, .pdf, .docx, .doc, .odt",
        parallelUploads: 2,
        thumbnailHeight: 120,
        thumbnailWidth: 120,
        maxFilesize: 5,
        params: { "type": "adókártya", "address": "none" },
        addRemoveLinks: true,
        sending: function(file, xhr, formData)
        {
            formData.append("name", $(newMember).find("input[id=company_member_firstname]").val() + "-" + $(newMember).find("input[id=company_member_lastname]").val());
            formData.append("company_name", $("#company_name").val());
        },
        success: function(file, response)
        {
            HandleAjax(response);
        },
        removedfile: function(file)
        {
            var filename = file.name; 
    
            $.ajax({
                url: "remove.php",
                data: { filename: filename, type: "adókártya", name: $(newMember).find("input[id=company_member_firstname]").val() + "-" + $(newMember).find("input[id=company_member_lastname]").val(), company_name: $("#company_name").val(), address: "none" },
                type: "POST",
                success: function()
                {
                    console.log("Removed");
                }
            })
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0; // this needs to be returned to remove the thumbnail from the container
        },
        
        filesizeBase: 1000,
        thumbnail: function(file, dataUrl) {
          if (file.previewElement) {
            file.previewElement.classList.remove("dz-file-preview");
            var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
            for (var i = 0; i < images.length; i++) {
              var thumbnailElement = images[i];
              thumbnailElement.alt = file.name;
              thumbnailElement.src = dataUrl;
            }
            setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 1);
          }
        }
      
    });

    // dynamic field mobile number input with realtime validaiton (2020.08.05) Attila
    var input = document.querySelectorAll("#company_member_phone");
    
    for (let index = 0; index < input.length; index++)
    {
        // initialise plugin
        var iti = window.intlTelInput(input[index],{
            utilsScript: "js/vendor/intlTelInput/utils.js?1585994360633",
            preferredCountries: ["hu"]
        });

        var reset = function()
        {
            input[index].classList.remove("is-invalid");
        };

        // on blur: validate
        input[index].addEventListener("blur", function() {
            reset();
            $(this).parent().parent().parent().find(".invalid-phone").hide();
            if (input[index].value.trim())
            {
                if (iti.isValidNumber())
                {
                    input[index].classList.add("is-valid");
                }
                else
                {
                    input[index].classList.add("is-invalid");
                    var errorCode = iti.getValidationError();
                    if (errorCode == -99)
                    {
                        //errorMsg.innerHTML = "Hibás telefonszám";
                        input[index].classList.add("is-invalid");
                        $(this).parent().parent().parent().find(".invalid-phone").show();
                    }
                    else if (intlTelInputUtils.validationError.INVALID_COUNTRY_CODE)
                    {
                        //errorMsg.innerHTML = "Hibás hívószám";
                        input[index].classList.add("is-invalid");
                        $(this).parent().parent().parent().find(".invalid-phone").show();
                    }
                }
            }
        });

        // on keyup / change flag: reset
        input[index].addEventListener("change", reset);
        input[index].addEventListener("keyup", reset);
    }
    ////

    // dynamic money formatting (2020.08.05) Attila
    $(newMember).find("#company_member_money").on("change", function(){
        $(newMember).find("#company_member_money").val(FormatMoney($(newMember).find("#company_member_money").val()));
    });

    $(newMember).find("#company_member_money2").on("change", function(){
        $(newMember).find("#company_member_money2").val(FormatMoney($(newMember).find("#company_member_money2").val()));
    });
    ////

    var num = $("#company_member_num").val();
    $("#company_member_num").val(parseInt(num) + 1);

    MemberCollapser();
    InputValidation();
});

$(document).on("click", ".removemember", function () 
{
    MemberCollapser();
    if (confirm('Biztosan törlöd?'))
    {
        var num = $("#company_boss_num").val();
        $("#company_boss_num").val(parseInt(num) - 1);
        $(this).parent().parent().remove(); // onclick we remove the instance that was created
        MemberCollapser();
    }
    else
    {
        MemberCollapser();
    }
});
////

// Detect checked state (2020.08.01) Attila
$("#company_meeting_additional_payment_yes").change( function()
{
    if ($("#company_meeting_additional_payment_yes").is(":checked"))
    {
        $("#company_meeting_additional_payment_no").prop("checked", false);
        $("#second-option-meeting").show();
        $("#additional-payment").show();
        InputValidation();
    }
});

$("#company_meeting_additional_payment_no").change( function()
{
    if ($("#company_meeting_additional_payment_no").is(":checked"))
    {
        $("#company_meeting_additional_payment_yes").prop("checked", false);
        $("#second-option-meeting").hide();
        $("#additional-payment").hide();
        $("#company_meeting_additional_payment_time").prop("disabled", true);
        $("#company_meeting_additional_payment_yes_once").prop("checked", true);
        $("#company_meeting_additional_payment_yes_time").prop("checked", false);
        InputValidation();
    }
});

$("#company_meeting_additional_payment_yes_time").change( function()
{
    if ($("#company_meeting_additional_payment_yes_time").is(":checked"))
    {
        $("#company_meeting_additional_payment_yes_once").prop("checked", false);
        $("#company_meeting_additional_payment_time").prop("disabled", false);
        InputValidation();
    }
});

$("#company_meeting_additional_payment_yes_once").change( function()
{
    if ($("#company_meeting_additional_payment_yes_once").is(":checked"))
    {
        $("#company_meeting_additional_payment_yes_time").prop("checked", false);
        $("#company_meeting_additional_payment_time").prop("disabled", true);
        InputValidation();
    }
});

$("#permission_granted_yes").change( function()
{
    if ($("#permission_granted_yes").is(":checked"))
    {
        $("#permission_granted_no").prop("checked", false);
    }
});

$("#permission_granted_no").change( function()
{
    if ($("#permission_granted_no").is(":checked"))
    {
        $("#permission_granted_yes").prop("checked", false);
    }
});

$("#dividend_payment").change( function()
{
    if ($("#dividend_payment").is(":checked"))
    {
        $("#current_year").prop("checked", false);
    }
});

$("#current_year").change( function()
{
    if ($("#current_year").is(":checked"))
    {
        $("#dividend_payment").prop("checked", false);
    }
});

$("#company_member_boss_time_unknown").change( function()
{
    if ($("#company_member_boss_time_unknown").is(":checked"))
    {
        $("#boss-time").hide();
        $("#company_member_boss_time_known").prop("checked", false);
        InputValidation();
    }
});

$("#company_member_boss_time_known").change( function()
{
    if ($("#company_member_boss_time_known").is(":checked"))
    {
        $("#boss-time").show();
        $("#company_member_boss_time_unknown").prop("checked", false);
        InputValidation();
    }
});

$("#company_member_boss_lead_type1").change( function()
{
    if ($("#company_member_boss_lead_type1").is(":checked"))
    {
        $("#company_member_boss_lead_type2").prop("checked", false);
    }
});

$("#company_member_boss_lead_type2").change( function()
{
    if ($("#company_member_boss_lead_type2").is(":checked"))
    {
        $("#company_member_boss_lead_type1").prop("checked", false);
    }
});

$("#company_member_external").change( function()
{
    if ($("#company_member_external").is(":checked"))
    {
        $("#company_member_internal").prop("checked", false);
    }
});

$("#company_member_internal").change( function()
{
    if ($("#company_member_internal").is(":checked"))
    {
        $("#company_member_external").prop("checked", false);
    }
});

$("#dividend_payment_permission_yes").change( function()
{
    if ($("#dividend_payment_permission_yes").is(":checked"))
    {
        $("#dividend_payment_permission_no").prop("checked", false);
    }
});

$("#dividend_payment_permission_no").change( function()
{
    if ($("#dividend_payment_permission_no").is(":checked"))
    {
        $("#dividend_payment_permission_yes").prop("checked", false);
    }
});

$("#company-option3").change( function()
{
    if ($("#company-option3").is(":checked"))
    {
        $("#monthly-occurence").prop("disabled", true);
        $("#company-option4").prop("checked", false);
        InputValidation();
    }
});

$("#company-option4").change( function()
{
    if ($("#company-option4").is(":checked"))
    {
        $("#monthly-occurence").prop("disabled", false);
        $("#company-option3").prop("checked", false);
        InputValidation();
    }
});

$("#company-option5").change( function()
{
    if ($("#company-option5").is(":checked"))
    {
        $("#another-address").hide();
        $("#company-option6").prop("checked", false);
        InputValidation();
    }
});

$("#company-option6").change( function()
{
    if ($("#company-option6").is(":checked"))
    {
        $("#another-address").show();
        $("#company-option5").prop("checked", false);
        InputValidation();
    }
});

$("#company-option7").change( function()
{
    if ($("#company-option7").is(":checked"))
    {
        $("#option").show();
        $("#company-option8").prop("checked", false);
        $("#boss-btn").show();
    }
});

$("#company-option8").change( function()
{
    if ($("#company-option8").is(":checked"))
    {
        $("#option").hide();
        $("#company-option7").prop("checked", false);
        $("#boss-btn").hide();

        $(".removeboss").each(function()
        {
            $(this).click();
        });
    }
});

$("#company-option9").change( function()
{
    if ($("#company-option9").is(":checked"))
    {
        $("#company-option10").prop("checked", false);
    }
});

$("#company-option10").change( function()
{
    if ($("#company-option10").is(":checked"))
    {
        $("#company-option9").prop("checked", false);
    }
});

$("#company-option11").change( function()
{
    if ($("#company-option11").is(":checked"))
    {
        $("#company-option12").prop("checked", false);
        $("#supervisor").show();
    }
});

$("#company-option12").change( function()
{
    if ($("#company-option12").is(":checked"))
    {
        $("#company-option11").prop("checked", false);
        $("#supervisor").hide();
    }
});

$("#company-option13").change( function()
{
    if ($("#company-option13").is(":checked"))
    {
        $("#company-option14").prop("checked", false);
    }
});

$("#company-option14").change( function()
{
    if ($("#company-option14").is(":checked"))
    {
        $("#company-option13").prop("checked", false);
    }
});

$("#company_member_pay_bank").change( function()
{
    if ($(this).is(":checked"))
    {
        $(this).parent().parent().find("#company_member_pay_notbank").prop("checked", false);
    }
});

$("#company_member_pay_notbank").change( function()
{
    if ($(this).is(":checked"))
    {
        $(this).parent().parent().find("#company_member_pay_bank").prop("checked", false);
    }
});

$("#company_member_pay_atstart").change( function()
{
    if ($(this).is(":checked"))
    {
        $(this).parent().parent().parent().find("#company_member_pay_afterstart_time").prop("disabled", true);
        $(this).parent().parent().find("#company_member_pay_afterstart").prop("checked", false);
        InputValidation();
    }
});

$("#company_member_pay_afterstart").change( function()
{
    if ($(this).is(":checked"))
    {
        $(this).parent().parent().parent().find("#company_member_pay_afterstart_time").prop("disabled", false);
        $(this).parent().parent().find("#company_member_pay_atstart").prop("checked", false);
        InputValidation();
    }
});

$("#company_member_boss").change( function()
{
    var id = $(this).parent().parent().parent().parent().attr("id");

    if ($(this).is(":checked"))
    {
        $("#"+id).find("#time").show();
        $("#"+id).find("#managerDoc").show();
    }
    else
    {
        $("#"+id).find("#time").hide();
        $("#"+id).find("#managerDoc").hide();
    }
});

$("#dividend_payment").change( function()
{
    if ($(this).is(":checked"))
    {
        $(this).parent().parent().find("#month").prop("disabled", true);
        $(this).parent().parent().find("#day").prop("disabled", true);
        $(this).parent().parent().find("#current_year").prop("checked", false);
    }
});

$("#current_year").change( function()
{
    if ($(this).is(":checked"))
    {
        $(this).parent().parent().find("#month").prop("disabled", false);
        $(this).parent().parent().find("#day").prop("disabled", false);
        $(this).parent().parent().find("#dividend_payment").prop("checked", false);
    }
});

$("#company_time_unknown").change( function()
{
    if ($("#company_time_unknown").is(":checked"))
    {
        $("#company-time").hide();
        $("#company_time_known").prop("checked", false);
        InputValidation();
    }
});

$("#company_time_known").change( function()
{
    if ($("#company_time_known").is(":checked"))
    {
        $("#company-time").show();
        $("#company_time_unknown").prop("checked", false);
        InputValidation();
    }
});

// lets prevent the user from unchecking a checked box
$(".preventUncheck").on("change", function(e)
{
    if ($(".preventUncheck:checked").length == 0 && !this.checked)
    	this.checked = true;
});

$(".preventUncheck2").on("change", function(e)
{
    if ($(".preventUncheck2:checked").length == 0 && !this.checked)
    	this.checked = true;
});

$(".preventUncheck3").on("change", function(e)
{
    if ($(".preventUncheck3:checked").length == 0 && !this.checked)
    	this.checked = true;
});

$(".preventUncheck4").on("change", function(e)
{
    if ($(".preventUncheck4:checked").length == 0 && !this.checked)
    	this.checked = true;
});

$(".preventUncheck5").on("change", function(e)
{
    if ($(".preventUncheck5:checked").length == 0 && !this.checked)
    	this.checked = true;
});

$(".preventUncheck6").on("change", function(e)
{
    if ($(".preventUncheck6:checked").length == 0 && !this.checked)
    	this.checked = true;
});

$(".preventUncheck7").on("change", function(e)
{
    if ($(".preventUncheck7:checked").length == 0 && !this.checked)
    	this.checked = true;
});

$(".preventUncheck8").on("change", function(e)
{
    if ($(".preventUncheck8:checked").length == 0 && !this.checked)
    	this.checked = true;
});

$(".preventUncheck9").on("change", function(e)
{
    if ($(".preventUncheck9:checked").length == 0 && !this.checked)
    	this.checked = true;
});

$(".preventUncheck10").on("change", function(e)
{
    if ($(".preventUncheck10:checked").length == 0 && !this.checked)
    	this.checked = true;
});

$(".preventUncheck11").on("change", function(e)
{
    if ($(".preventUncheck11:checked").length == 0 && !this.checked)
    	this.checked = true;
});

$(".preventUncheck12").on("change", function(e)
{
    if ($(".preventUncheck12:checked").length == 0 && !this.checked)
    	this.checked = true;
});

$(".preventUncheck13").on("change", function(e)
{
    if ($(".preventUncheck13:checked").length == 0 && !this.checked)
    	this.checked = true;
});

$(".preventUncheck14").on("change", function(e)
{
    if ($(".preventUncheck14:checked").length == 0 && !this.checked)
    	this.checked = true;
});

$(".preventUncheck15").on("change", function(e)
{
    if ($(".preventUncheck15:checked").length == 0 && !this.checked)
    	this.checked = true;
});

$(".preventUncheck16").on("change", function(e)
{
    if ($(".preventUncheck16:checked").length == 0 && !this.checked)
    	this.checked = true;
});

$(".preventUncheck17").on("change", function(e)
{
    if ($(".preventUncheck17:checked").length == 0 && !this.checked)
    	this.checked = true;
});

$(".preventUncheck18").on("change", function(e)
{
    if ($(".preventUncheck18:checked").length == 0 && !this.checked)
    	this.checked = true;
});

$(".preventUncheck19").on("change", function(e)
{
    if ($(".preventUncheck19:checked").length == 0 && !this.checked)
    {
        this.checked = true;
    }
    else
    {
        $(".preventUncheck19:checked").each(function()
        {
            this.checked = false;
        });

        this.checked = true;
    }
});
////

// Function to handle errors and responses
function HandleFiller(resp) 
{

    if(typeof(resp) == "string")
        resp = JSON.parse(resp);

    if (resp.error)
    {
        alert(resp.error + " " + resp.errorMessage);
    }
    else
    {
        window.open(resp.message, "_blank");
    }
}

function HandleAjax(resp) 
{

    if(typeof(resp) == "string")
        resp = JSON.parse(resp);

    if (resp.error)
    {
        alert(resp.error + " " + resp.errorMessage);
    }
    else if (resp.error == "companyExist")
    {
        //$("#company_name").attr("value", ""); This is not working :c
        alert(resp.error + " " + resp.errorMessage);
    }
    else
    {
        alert(resp.message);
    }
}
////

// Form validation
$(function ()
{

    //alert("Kérlek jelölj ki legalább egy darab ügyvezetőt!"); need this for manager num validation
    // When the form submits we make an AJAX call
    $("#main").on("submit", function(e)
    {
        InputValidation(true);

        e.preventDefault();

        var invalidNum = $(".is-invalid").length;
        var validNum = $(".is-valid").length;

        alert(invalidNum);

        if (invalidNum == 0 && validNum != 0)
        {
            var zip = $("#company_seat_zip").val();
            var city = $("#company_seat_city").val();
            var address = $("#company_seat_address").val();
            var address2 = $("#company_seat_address2").val();

            var address = zip + " " + city + " " + address + " " + address2;

            $.ajax({
                url: "https://maps.googleapis.com/maps/api/geocode/json",
                type: "GET",
                data: { address: address, key: "AIzaSyDUUlEBDWUW9kEECyPB6EyZslf8wObNvag" },
                success: function(resp)
                {
                    var isHu = false;
                    if (resp.status == "ZERO_RESULTS")
                    {
                        alert("Ez a cím " + address + " nem található! Kérlek adj meg egy másikat!");
                    }
                    else
                    {
                        resp.results[0].address_components.forEach(obj => {
                            Object.entries(obj).forEach(([key, value]) => {
                                if (key == "long_name" && value == "Hungary")
                                {
                                    isHu = true;
                                }
                            });
                        });
                    }

                    var mainPlace = $(".main-place:checked").length;
                    var manager = $("#company_member_boss:checked").length;
                    var moneySum = MoneySum();
                    
                    if(!isHu)
                    {
                        alert("A székhely címnek Magyarnak kell lennie!");
                    }
                    else if(mainPlace == 0)
                    {
                        alert("Nincs kijelölve az ügyintézés központja! Kérlek jelöld ki!");
                    }
                    else if(manager == 0)
                    {
                        alert("Nincs kijelölve ügyvezető legalább egyet kérlek jelölj ki!");
                    }
                    else if(moneySum < 3000000)
                    {
                        alert("A minimum vagyoni hozzájárulás 3 millió forint!");
                    }
                    else
                    {
                        if (NotCashSum() >= 50)
                        {
                            alert("Mivel a nem vagyoni hozzájárulás meghaladja/eléri az 50%-ot ezért alapításkor kell rendelkezésre bocsátani!");
                        }

                        alert("Validation success");

                        var form = $("#main").serialize();

                        var business = $("#company_business").val();
                        var businessOther = $("#company_other_business").val();

                        var data = [
                            { "type": "submit" },
                            { "args": form + "&company_business=" + business + "&company_other_business=" + businessOther + "&money_sum=" + FormatMoney(moneySum),
                            "company_name": $("#company_name").val() }
                        ];

                        $.ajax({
                            url: "ajax.php",
                            type: "POST",
                            data: JSON.stringify(data),
                            contentType: "application/json",
                            success: HandleAjax
                        });
                    }
                }
            });

        }
        else
        {
            alert("A küldés sikertelen mivel vannak hibás mező értékek!");
        }

    });
    ////
});
////

// Member name update for the collapser
$(".detect").on("change", function()
{
    var id = $(this).parent().parent().parent().parent().attr("id");
    var firstname = $("#"+id).find("input[id=company_member_firstname]").val();
    var lastname =  $("#"+id).find("input[id=company_member_lastname]").val();

    if (lastname == "")
    {
        MemberCollapser();
        $("#"+id).parent().find(".collapsible").html("<?php echo $messages['company-member']; ?><span name='member_id'>#1</span>");
        $("#"+id).find("#member-name").html("<?php echo $messages['company-member']; ?><span name='member_id'>#1</span>");
        MemberCollapser();
    }
    else
    {
        var name = firstname + " " + lastname;
        $("#"+id).find("#member-name").html(name);
        $("#"+id).parent().find(".collapsible").html(name);
        $(this).parent().parent().find("#company_member_fullname").val(name);
    }
});
////

// update fullname value
$(".detect2").on("change", function()
{
    var firstname = $(this).parent().parent().find("input[id*=firstname]").val();
    var lastname =  $(this).val();

    $(this).parent().parent().find("input[id*=fullname]").val(firstname + " " + lastname);
});
////

// Money percent for member (2020.08.11) Attila
$("#company_member_money_half").on("change", function()
{
    var inputVal = $("#company_member_money").val(); // getting the input value of member_money
    var inputVal2 = $(this).val(); // getting the input value of member_money

    inputVal = inputVal.replace(/ /g, "");

    var percent = Percentage(inputVal2, inputVal);
    $("#company_member_money_percent").val(percent);

    if (percent != 100 && percent != 0)
    {
        $(document).find("#company_member_money_payment_time").prop("disabled", false);
        InputValidation();    
    }
    else
    {
        $(document).find("#company_member_money_payment_time").prop("disabled", true);
        InputValidation(); 
    }
});

$("#company_member_money").on("change", function()
{
    var inputVal = $(this).val(); // getting the input value of member_money
    var inputVal2 = $("#company_member_money_half").val(); // getting the input value of member_money

    inputVal2 = inputVal2.replace(/ /g, "");

    var percent = Percentage(inputVal2, inputVal);
    $("#company_member_money_percent").val(percent);

    if (percent != 100 && percent != 0)
    {
        $(document).find("#company_member_money_payment_time").prop("disabled", false);
        InputValidation();    
    }
    else
    {
        $(document).find("#company_member_money_payment_time").prop("disabled", true);
        InputValidation(); 
    }
});

$("#company_member_money2").on("change", function()
{
    var inputVal = $(this).val(); // getting the input value of member_money

    if (inputVal == "")
    {
        $(document).find("#company_member_money2_name").prop("disabled", true);
        InputValidation();    
    }
    else
    {
        $(document).find("#company_member_money2_name").prop("disabled", false);
        InputValidation(); 
    }
});
////

// function for calculating percentage (2020.08.11) Attila
function Percentage(num1, num2)
{
    var percentage = 0;
    if(isNaN(num1) || isNaN(num2) || num1 == "" || num2 == "")
    {
        percentage = 0;
    }
    else
    {
        percentage = ((num1/num2) * 100).toFixed(0);

        if (percentage < 0)
        {
            percentage = 0;
        }
        else if(percentage > 100)
        {
            percentage = 0;
        }
    }
    
    return percentage;
}
////

// Check if the company_name is already exist in db (2020.08.11) Attila
$("#company_name").on("change", function()
{
    var company_name = $("#company_name").val();

    var data = [
        { "type": "nameCheck" },
        { "company_name": company_name }
    ];

    console.log(data);

    $.ajax({
        url: "ajax.php",
        type: "POST",
        data: JSON.stringify(data),
        contentType: "application/json",
        success: HandleAjax
    });
});
////

// function for getting that juicy money sum (2020.08.17) Attila
function MoneySum()
{
    var moneySum = 0;
    $("#company_member_money").each(function()
    {
        var moneyAmount = $(this).val();
        moneyAmount = moneyAmount.replace(/ /g, "");

        if (moneyAmount != "")
        {
            moneySum += parseInt(moneyAmount);
        }
    });

    $("#company_member_money2").each(function()
    {
        var moneyAmount = $(this).val();
        moneyAmount = moneyAmount.replace(/ /g, "");

        if (moneyAmount != "")
        {
            moneySum += parseInt(moneyAmount);
        }
    });

    return moneySum;
}
////

// function for not cash money (2020.08.20) Attila
function NotCashSum()
{
    var moneySum = MoneySum();
    var notCash = 0;
    $("#company_member_money2").each(function()
    {
        var moneyAmount = $(this).val();
        moneyAmount = moneyAmount.replace(/ /g, "");

        if (moneyAmount != "")
        {
            notCash += parseInt(moneyAmount);
        }
    });

    var notCashPercent = Percentage(notCash, moneySum);
    if (notCashPercent >= 50)
    {
        $("#company_member_money2").each(function()
        {
            $(this).parent().parent().parent().parent().find().attr("checked", true);
        });

        return notCashPercent;
    }

    return notCashPercent;
}
////