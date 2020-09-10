// Navbar functions
function openNav()
{
    document.getElementById("mySidenav").style.width = "250px";
}
  
function closeNav()
{
    document.getElementById("mySidenav").style.width = "0";
}
////

$(document).ready(function()
{
    $("#response").hide();
	$("#loading").hide();
});

$(".cancel-btn").click(function(e)
{
    var confirmMe = confirm("Biztosan leteszel ennek a kérvénynek az átvizsgálásáról?");
    if (confirmMe == true)
    {
        $("#cancel-form").submit();
    }
});

$(".reject").click(function(e)
{
    var confirmMe = confirm("Biztosan vagy benne?");
	if (confirmMe == true)
    {
		var comment = $(".comment2").val();
		if (comment != "")
		{
			$("#reject-form").submit();
		}
		else
		{
			alert("Kérlek írj megjegyzést!");
		}
    }
});

$(".accept").click(function(e)
{
    var confirmMe = confirm("Biztosan vagy benne?");
    if (confirmMe == true)
    {
		var comment = $(".comment").val();
		if (comment != "")
		{
			$("#accept-form").submit();
		}
		else
		{
			alert("Kérlek írj megjegyzést!");
		}
    }
});

$(".invite").click(function(e)
{
	var html = `<label>Email</label><input type="email" class="form-control" id="email-invite">
	<div class="spinner-border" id="loading"></div>
	<div class="alert alert-warning" id="response">
  		Kérem várjon...
	</div>`;

	$("#modal-title").text("Meghívó küldése");
	$("#modal-body").html(html);
	$("#response").hide();
	$("#loading").hide();
	$("#type").text("invite");
	$(".ok").text("Oké");
});

$(".change-perm").click(function(e)
{
	var html = `<label>Válassz jogot</label>
	<select class="form-control" id="permission">
		<option value="1">1</option>
		<option value="2">2</option>
	</select>
	<input type="hidden" id="username">
	<div class="spinner-border" id="loading"></div>
	<div class="alert alert-warning" id="response">
  		Kérem várjon...
	</div>`;

	var username = $(this).parent().parent().find("#user").text();

	$("#modal-title").text("Jog módosítása");
	$("#modal-body").html(html);
	$("#response").hide();
	$("#loading").hide();
	$("#username").val(username);
	$("#type").text("perm-change");
	$(".ok").text("Oké");
});

$(".change-passwd").click(function(e)
{
	var html = `<label>Új jelszó</label>
	<input type="password" class="form-control" id="password">
	<input type="hidden" id="username">
	<div class="spinner-border" id="loading"></div>
	<div class="alert alert-warning" id="response">
  		Kérem várjon...
	</div>`;

	var username = $(this).parent().parent().find("#user").text();

	$("#modal-title").text("Jelszó változtatás");
	$("#modal-body").html(html);
	$("#response").hide();
	$("#loading").hide();
	$("#username").val(username);
	$("#type").text("passwd-change");
	$(".ok").text("Oké");
});

$(".remove").click(function(e)
{
	var html = `<label>Biztosan eltávolítod ezt a tagot?</label>
	<input type="hidden" id="username">
	<div class="spinner-border" id="loading"></div>
	<div class="alert alert-warning" id="response">
  		Kérem várjon...
	</div>`;

	var username = $(this).parent().parent().find("#user").text();

	$("#modal-title").text("Tag eltávolítása");
	$("#modal-body").html(html);
	$("#response").hide();
	$("#loading").hide();
	$("#username").val(username);
	$("#type").text("member-remove");
	$(".ok").text("Igen");
});

$(".ok").click(function(e)
{
	var type = $(this).parent().find("#type").text();

	if (type == "invite")
	{
		var email = $(this).parent().parent().find("#email-invite").val();
		$("#response").show();
		$("#loading").show();

		$.ajax({
			url: "/adminpanel/admin/SendInvite",
			type: "POST",
			data: { email: email },
			success: HandleResponse
		});
	}
	else if (type == "passwd-change")
	{
		var password = $(this).parent().parent().find("#password").val();
		var username = $(this).parent().parent().find("#username").val();
		$("#response").show();
		$("#loading").show();

		$.ajax({
			url: "/adminpanel/admin/ChangePassword",
			type: "POST",
			data: { username: username, password: password },
			success: HandleResponse
		});
	}
	else if (type == "member-remove")
	{
		var username = $(this).parent().parent().find("#username").val();
		$("#response").show();
		$("#loading").show();

		$.ajax({
			url: "/adminpanel/admin/DeleteMember",
			type: "POST",
			data: { username: username },
			success: HandleResponse
		});
	}
	else if (type == "perm-change")
	{
		var username = $(this).parent().parent().find("#username").val();
		var permission = $(this).parent().parent().find("#permission").val();
		console.log(permission);
		$("#response").show();
		$("#loading").show();

		$.ajax({
			url: "/adminpanel/admin/ChangePermission",
			type: "POST",
			data: { username: username, permission: permission },
			success: HandleResponse
		});
	}
});

$(".change").click(function(e)
{
	var username = $(this).parent().find("#username").val();
	var password = $(this).parent().find("#password").val();
	var password2 = $(this).parent().find("#password2").val();

	$("#loading").show();
	$("#response").show();

	if (password != password2)
	{
		$("#loading").hide();
		$("#response").text("A beírt jelszavak nem egyeznek!");
		setTimeout(function(){ $("#response").hide(); $("#response").text("Kérem várjon..."); }, 4000);
	}
	else if (password == "" || password2 == "")
	{
		$("#loading").hide();
		$("#response").text("Üresen hagytál egy jelszó mezőt!");
		setTimeout(function(){ $("#response").hide(); $("#response").text("Kérem várjon..."); }, 4000);
	}
	else
	{
		$.ajax({
			url: "/adminpanel/admin/ChangePassword",
			type: "POST",
			data: { username: username, password: password },
			success: HandleResponse
		});
	}
});

$(".phone").click(function(e)
{
	var phone = $(this).parent().find("#phone").val();

	$("#loading").show();
	$("#response").show();

	$.ajax({
		url: "/adminpanel/admin/ChangePhone",
		type: "POST",
		data: { phone: phone },
		success: HandleResponse
	});
});

$(".postAddress").click(function(e)
{
	var country = $(this).parent().find("#country").val();
	var zip = $(this).parent().find("#zip").val();
	var city = $(this).parent().find("#city").val();
	var address = $(this).parent().find("#address").val();
	var address2 = $(this).parent().find("#address2").val();

	$("#loading").show();
	$("#response").show();

	$.ajax({
		url: "/adminpanel/admin/ChangePostAddress",
		type: "POST",
		data: { address: country + " " + zip + " " + city + " " + address + " " + address2 },
		success: HandleResponse
	});
});

$(".download").click(function(e)
{
	$.ajax({
		url: "/adminpanel/admin/DownloadAttachments",
		type: "POST",
		success: function(resp)
		{
			window.open("/adminpanel/"+resp, "_blank");
		}
	});
});

function HandleResponse(resp) 
{
	if (resp == "inviteSuccess")
	{
		$("#loading").hide();
		$("#response").text("A meghívót sikeresen elküldtük!");
		setTimeout(function(){ $("#response").hide(); $(".cancel").click(); }, 4000);
	}
	else if (resp == "cantBeInvited")
	{
		$("#loading").hide();
		$("#response").text("Ezt a személyt sajnos nem lehet meghívni!");
		setTimeout(function(){ $("#response").hide(); $("#response").text("Kérem várjon..."); }, 4000);
	}
	else if (resp == "changeSuccess")
	{
		$("#loading").hide();
		$("#response").text("A változtatás sikeres volt!");
		setTimeout(function(){ $("#response").hide(); $(".cancel").click(); }, 4000);
	}
	else if (resp == "emptyPass")
	{
		$("#loading").hide();
		$("#response").text("Üresen hagytad a jelszó mezőt!");
		setTimeout(function(){ $("#response").hide(); $("#response").text("Kérem várjon..."); }, 4000);
	}
	else if (resp == "emptyEmail")
	{
		$("#loading").hide();
		$("#response").text("Üresen hagytad az email mezőt!");
		setTimeout(function(){ $("#response").hide(); $("#response").text("Kérem várjon..."); }, 4000);
	}
	else if (resp == "deleteSuccess")
	{
		$("#loading").hide();
		$("#response").text("Sikeresen törölted! Kérlek várj amíg az oldal frissül!");
		setTimeout(function(){ location.reload(); }, 3000);
	}
	else if (resp == "permSuccess")
	{
		$("#loading").hide();
		$("#response").text("A változtatás sikeres volt! Kérlek várj amíg az oldal frissül!");
		setTimeout(function(){ location.reload(); }, 3000);
	}
	else if (resp == "phoneSuccess")
	{
		$("#loading").hide();
		$("#response").text("A változtatás sikeres volt! Kérlek várj amíg az oldal frissül!");
		setTimeout(function(){ location.reload(); }, 3000);
	}
	else if (resp == "addressSuccess")
	{
		$("#loading").hide();
		$("#response").text("A változtatás sikeres volt!");
		setTimeout(function(){ location.reload(); }, 3000);
	}
}

// Digital Signature
/*$(document).ready(() => {
	var pathname = window.location.pathname;

	if (pathname == "/adminpanel/admin/company")
	{
		var hasSignature = false;

		var canvasDiv = document.getElementById('canvasDiv');
		var canvas = document.createElement('canvas');
		canvas.setAttribute('id', 'canvas');
		canvasDiv.appendChild(canvas);
		$("#canvas").attr('height', $("#canvasDiv").outerHeight());
		$("#canvas").attr('width', $("#canvasDiv").width());
		if (typeof G_vmlCanvasManager != 'undefined') {
			canvas = G_vmlCanvasManager.initElement(canvas);
		}
		
		context = canvas.getContext("2d");
		$('#canvas').mousedown(function(e) {
			var offset = $(this).offset()
			var mouseX = e.pageX - this.offsetLeft;
			var mouseY = e.pageY - this.offsetTop;

			paint = true;
			addClick(e.pageX - offset.left, e.pageY - offset.top);
			redraw();
		});

		$('#canvas').mousemove(function(e) {
			if (paint) {
				hasSignature = true;
				var offset = $(this).offset()
				//addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, true);
				addClick(e.pageX - offset.left, e.pageY - offset.top, true);
				console.log(e.pageX, offset.left, e.pageY, offset.top);
				redraw();
			}
		});

		$('#canvas').mouseup(function(e) {
			paint = false;
		});

		$('#canvas').mouseleave(function(e) {
			paint = false;
		});

		var clickX = new Array();
		var clickY = new Array();
		var clickDrag = new Array();
		var paint;

		function addClick(x, y, dragging) {
			clickX.push(x);
			clickY.push(y);
			clickDrag.push(dragging);
		}

		$("#reset-btn").click(function() {
			hasSignature = false;
			context.clearRect(0, 0, window.innerWidth, window.innerWidth);
			clickX = [];
			clickY = [];
			clickDrag = [];
		});

		$(document).on("click", "#submit-btn", function() {
			if (hasSignature)
			{
				var mycanvas = document.getElementById("canvas");
				var img = mycanvas.toDataURL("image/png");
				anchor = $("#signature");
				anchor.val(img);
			}
		});

		var drawing = false;
		var mousePos = {
			x: 0,
			y: 0
		};
		var lastPos = mousePos;

		canvas.addEventListener("touchstart", function(e) {
			mousePos = getTouchPos(canvas, e);
			var touch = e.touches[0];
			var mouseEvent = new MouseEvent("mousedown", {
				clientX: touch.clientX,
				clientY: touch.clientY
			});
			canvas.dispatchEvent(mouseEvent);
		}, false);


		canvas.addEventListener("touchend", function(e) {
			var mouseEvent = new MouseEvent("mouseup", {});
			canvas.dispatchEvent(mouseEvent);
		}, false);


		canvas.addEventListener("touchmove", function(e) {

			var touch = e.touches[0];
			var offset = $('#canvas').offset();
			var mouseEvent = new MouseEvent("mousemove", {
				clientX: touch.clientX,
				clientY: touch.clientY
			});
			canvas.dispatchEvent(mouseEvent);
		}, false);


		// Get the position of a touch relative to the canvas
		function getTouchPos(canvasDiv, touchEvent) {
			var rect = canvasDiv.getBoundingClientRect();
			return {
				x: touchEvent.touches[0].clientX - rect.left,
				y: touchEvent.touches[0].clientY - rect.top
			};
		}


		var elem = document.getElementById("canvas");

		var defaultPrevent = function(e) {
			e.preventDefault();
		}
		elem.addEventListener("touchstart", defaultPrevent);
		elem.addEventListener("touchmove", defaultPrevent);


		function redraw() {
			//
			lastPos = mousePos;
			for (var i = 0; i < clickX.length; i++) {
				context.beginPath();
				if (clickDrag[i] && i) {
					context.moveTo(clickX[i - 1], clickY[i - 1]);
				} else {
					context.moveTo(clickX[i] - 1, clickY[i]);
				}
				context.lineTo(clickX[i], clickY[i]);
				context.closePath();
				context.stroke();
			}
		}
	}
})*/
////

// File browser (2020.07.30) Attila
$("#attachment-btn").on("click", function()
{

	if ($(".filemanager").is(":visible") && !$("#list").hasClass("animated"))
	{
		$("#attachment-btn").text("Csatolmányok elrejtése");

		var filemanager = $(".filemanager"),
		breadcrumbs = $(".breadcrumbs"),
		fileList = filemanager.find(".data"); // getting the html elements

		$.get("/adminpanel/admin/Scan", function(data)
		{

			var response = [data],
				currentPath = '',
				breadcrumbsUrls = [];

			var folders = [],
				files = [];

			// This event listener monitors changes on the URL. We use it to
			// capture back/forward navigation in the browser.

			$(window).on('hashchange', function()
			{

				goto(window.location.hash);

				// We are triggering the event. This will execute 
				// this function on page load, so that we show the correct folder:

			}).trigger('hashchange');

			// Clicking on folders

			fileList.on('click', 'li.folders', function(e)
			{
				e.preventDefault();

				var nextDir = $(this).find('a.folders').attr('href');

				if(filemanager.hasClass('searching'))
				{

					// Building the breadcrumbs

					breadcrumbsUrls = generateBreadcrumbs(nextDir);

					filemanager.removeClass('searching');
					filemanager.find('input[type=search]').val('').hide();
					filemanager.find('span').show();
				}
				else
				{
					breadcrumbsUrls.push(nextDir);
				}

				window.location.hash = encodeURIComponent(nextDir);
				currentPath = nextDir;
			});


			// Clicking on breadcrumbs

			breadcrumbs.on('click', 'a', function(e)
			{
				e.preventDefault();

				var index = breadcrumbs.find('a').index($(this)),
					nextDir = breadcrumbsUrls[index];

				breadcrumbsUrls.length = Number(index);

				window.location.hash = encodeURIComponent(nextDir);

			});


			// Navigates to the given hash (path)

			function goto(hash)
			{

				hash = decodeURIComponent(hash).slice(1).split('=');

				if (hash.length)
				{
					var rendered = '';

					// if hash has search in it

					if (hash[0] === 'search')
					{

						filemanager.addClass('searching');
						rendered = searchData(response, hash[1].toLowerCase());

						if (rendered.length)
						{
							currentPath = hash[0];
							render(rendered);
						}
						else
						{
							render(rendered);
						}

					}

					// if hash is some path

					else if (hash[0].trim().length)
					{

						rendered = searchByPath(hash[0]);

						if (rendered.length)
						{

							currentPath = hash[0];
							breadcrumbsUrls = generateBreadcrumbs(hash[0]);
							render(rendered);

						}
						else
						{
							currentPath = hash[0];
							breadcrumbsUrls = generateBreadcrumbs(hash[0]);
							render(rendered);
						}

					}

					// if there is no hash

					else
					{
						currentPath = data.path;
						breadcrumbsUrls.push(data.path);
						render(searchByPath(data.path));
					}
				}
			}

			// Splits a file path and turns it into clickable breadcrumbs

			function generateBreadcrumbs(nextDir)
			{
				var path = nextDir.split('/').slice(0);
				for(var i=1;i<path.length;i++)
				{
					path[i] = path[i-1]+ '/' +path[i];
				}
				return path;
			}


			// Locates a file by path

			function searchByPath(dir)
			{
				var path = dir.split('/'),
					demo = response,
					flag = 0;

				for(var i=0;i<path.length;i++)
				{
					for(var j=0;j<demo.length;j++)
					{
						if(demo[j].name === path[i])
						{
							flag = 1;
							demo = demo[j].items;
							break;
						}
					}
				}

				demo = flag ? demo : [];
				return demo;
			}


			// Recursively search through the file tree

			function searchData(data, searchTerms)
			{

				data.forEach(function(d)
				{
					if(d.type === 'folder')
					{

						searchData(d.items,searchTerms);

						if(d.name.toLowerCase().match(searchTerms))
						{
							folders.push(d);
						}
					}
					else if(d.type === 'file')
					{
						if(d.name.toLowerCase().match(searchTerms))
						{
							files.push(d);
						}
					}
				});
				return {folders: folders, files: files};
			}


			// Render the HTML for the file manager

			function render(data)
			{

				var scannedFolders = [],
					scannedFiles = [];

				if(Array.isArray(data))
				{

					data.forEach(function (d)
					{

						if (d.type === 'folder')
						{
							scannedFolders.push(d);
						}
						else if (d.type === 'file')
						{
							scannedFiles.push(d);
						}

					});

				}
				else if(typeof data === 'object')
				{

					scannedFolders = data.folders;
					scannedFiles = data.files;

				}


				// Empty the old result and make the new one

				fileList.empty().hide();

				if(!scannedFolders.length && !scannedFiles.length)
				{
					filemanager.find('.nothingfound').show();
				}
				else
				{
					filemanager.find('.nothingfound').hide();
				}

				if(scannedFolders.length)
				{

					scannedFolders.forEach(function(f)
					{

						var itemsLength = f.items.length,
							name = escapeHTML(f.name),
							icon = '<span class="icon folder"></span>';

						if(itemsLength)
						{
							icon = '<span class="icon folder full"></span>';
						}

						if(itemsLength == 1)
						{
							itemsLength += ' item';
						}
						else if(itemsLength > 1)
						{
							itemsLength += ' items';
						}
						else
						{
							itemsLength = 'Empty';
						}

						var folder = $('<li class="folders"><a href="'+ f.path +'" title="'+ f.path +'" class="folders">'+icon+'<span class="name">' + name + '</span> <span class="details">' + itemsLength + '</span></a></li>');
						folder.appendTo(fileList);
					});

				}

				if(scannedFiles.length)
				{

					scannedFiles.forEach(function(f)
					{

						var fileSize = bytesToSize(f.size),
							name = escapeHTML(f.name),
							fileType = name.split('.'),
							icon = '<span class="icon file"></span>';

						fileType = fileType[fileType.length-1];

						icon = '<span class="icon file f-'+fileType+'">.'+fileType+'</span>';

						if (fileType == "jpg" || fileType == "png" || fileType == "jpeg" || fileType == "pdf")
						{
							var path = f.path.split("/");
							url = path[4] + "/" + path[5] + "/" + path[6] + "/" + path[7];

							var file = $('<li class="files"><a href="/' + url +'" title="' + url + '" class="files" target="_blank">' + icon + '<span class="name">' + name + '</span> <span class="details">' + fileSize + '</span></a></li>');
							file.appendTo(fileList);
						}
						else
						{
							var path = f.path.split("/");
							url = path[4] + "/" + path[5] + "/" + path[6] + "/" + path[7];

							var file = $('<li class="files"><a href="javascript:void(0)" onclick="OpenDoc(this)" title="' + url + '" class="files">' + icon + '<span class="name">' + name + '</span> <span class="details">' + fileSize + '</span></a><input type="hidden" id="editable-doc" name="editable-doc" value="/' + url + '"></li>');
							file.appendTo(fileList);
						}
					});

				}


				// Generate the breadcrumbs

				var url = '';

				if(filemanager.hasClass('searching'))
				{

					url = '<span>Search results: </span>';
					fileList.removeClass('animated');

				}
				else
				{

					fileList.addClass('animated');

					breadcrumbsUrls.forEach(function (u, i)
					{

						var name = u.split('/');

						if (i !== breadcrumbsUrls.length - 1)
						{
							url += '<a href="'+u+'"><span class="folderName">' + name[name.length-1] + '</span></a> <span class="arrow">→</span> ';
						}
						else
						{
							url += '<span class="folderName">' + name[name.length-1] + '</span>';
						}

					});

				}

				breadcrumbs.text('').append(url);


				// Show the generated elements

				fileList.show();

			}


			// This function escapes special html characters in names

			function escapeHTML(text)
			{
				return text.replace(/\&/g,'&amp;').replace(/\</g,'&lt;').replace(/\>/g,'&gt;');
			}


			// Convert file sizes from bytes to human readable units

			function bytesToSize(bytes)
			{
				var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
				if (bytes == 0) return '0 Bytes';
				var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
				return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
			}
		});
	}
	else if ($(".filemanager").is(":hidden") && $("#list").hasClass("animated"))
	{
		$("#attachment-btn").text("Csatolmányok elrejtése");
		$(".filemanager").show();
	}
	else
	{
		$("#attachment-btn").text("Csatolmányok mutatása");
		$(".filemanager").hide();
	}
});

// If user clicks on the editable doc we want to open it inside the editor (2020.07.30) Attila
function OpenDoc(event)
{
    var help = event || window.event;
    var el = help.target || event.srcElement || help;
    if (el.nodeType == 3) el = el.parentNode;
    var file = $(el).attr("title");
    console.log(file);

    $.redirect("/adminpanel/admin/editor", { "file": file })
}
////

// Video Chat Google :3 (2020.07.30) Attila
$("#video-chat").on("click", function(e)
{
    window.open("http://hangouts.google.com/start", "_blank");
});
////

// When user wants to savedoc (2020.07.31) Attila
$("#save-doc").on("click", function()
{
	var doc = $(this).parent().parent().find("#textBox").html();

	console.log(doc);

	$.ajax({
		url: "/adminpanel/admin/SaveDocument",
		type: "POST",
		data: { myDoc: doc },
		success: function(response)
		{
			if (response == "error")
			{
				alert("Nem sikerült elmenteni a módosításokat!");
			}
			else if(response == "saved")
			{
				alert("Módosítások sikeresen elmentve!");
				window.document.location.pathname = "/adminpanel/admin/company";
			}
		}
	});
});

// Automatic home page refresh for new incoming companies (2020.08.01) Attila
$(document).ready( function()
{
	var pathname = window.location.pathname;
	console.log(pathname);

	if (pathname == "/adminpanel/admin/home")
	{
		setInterval(function()
		{
			location.reload();
		}, 60000); // refreshing per minute
	}
});

$(function ()
{
	"use strict"
  
	$('[data-toggle="offcanvas"]').on("click", function () {
	  $(".offcanvas-collapse").toggleClass("open");
	})
});