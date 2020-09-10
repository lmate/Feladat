/*
HTML
<!-- Digital Signature START EZT NE PISZKÁLD CSAK CSS (2020.07.30) Attila -->
<div style="margin-top: 20px;">
    <h2><?php echo $messages["digital-signature"]; ?> *</h2>
    <div class="sign" id="canvasDiv_1"></div>
    <button type="button" class="btn btn-primary" id="save-btn_1" style="width: 50px;">&#9989;</button>
    <button type="button" class="btn btn-primary" id="reset-btn_1" style="width: 50px;">&#10060;</button>
    <input type="hidden" name="signature_1" id="signature_1">
</div>
<!-- Digital Signature END -->
*/

// Class for Digital signature (2020.08.06) Attila
class Signature
{
    constructor(canvasDiv, canvasID, resetBtn, saveBtn, hiddenInput)
    {
        this.canvasDiv = canvasDiv;
        this.canvasID = canvasID;
        this.resetBtn = resetBtn;
        this.saveBtn = saveBtn;
        this.hiddenInput = hiddenInput;
        this.GettingCanvas();
    }

    GettingCanvas()
    {
        var hasSignature = false;

        var canvasDiv = document.getElementById(this.canvasDiv);
        var canvas = document.createElement("canvas");
        canvas.setAttribute("id", this.canvasID);
        canvasDiv.appendChild(canvas);
        $("#"+this.canvasID).attr("height", $(canvasDiv).outerHeight());
        //$("#canvas_1").attr('width', $("#canvasDiv").outerWidth());
        $("#"+this.canvasID).attr("width", 838);
        if (typeof G_vmlCanvasManager != "undefined")
        {
            canvas = G_vmlCanvasManager.initElement(canvas);
        }
        
        var context = canvas.getContext("2d");
        $("#"+this.canvasID).mousedown(function(e)
        {
            var offset = $(this).offset()
            var mouseX = e.pageX - this.offsetLeft;
            var mouseY = e.pageY - this.offsetTop;

            paint = true;
            addClick(e.pageX - offset.left, e.pageY - offset.top);
            redraw();
        });

        $("#"+this.canvasID).mousemove(function(e)
        {
            if (paint) {
                hasSignature = true;
                var offset = $(this).offset()
                //addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, true);
                addClick(e.pageX - offset.left, e.pageY - offset.top, true);
                redraw();
            }
        });

        $("#"+this.canvasID).mouseup(function(e)
        {
            paint = false;
        });

        $("#"+this.canvasID).mouseleave(function(e)
        {
            paint = false;
        });

        var clickX = new Array();
        var clickY = new Array();
        var clickDrag = new Array();
        var paint;

        function addClick(x, y, dragging)
        {
            clickX.push(x);
            clickY.push(y);
            clickDrag.push(dragging);
        }

        $("#"+this.resetBtn).click(function()
        {
            hasSignature = false;
            context.clearRect(0, 0, window.innerWidth, window.innerWidth);
            clickX = [];
            clickY = [];
            clickDrag = [];
        });

        var hidden = this.hiddenInput;

        $("#"+this.saveBtn).click(function()
        {
            if (hasSignature)
            {
                alert("Sikeresen elmentetted az aláírásod!");
                var img = canvas.toDataURL("image/png");
                $("#"+hidden).val(img);
            }
            else
            {
                alert("Üres az aláírás mező kérlek írd alá mielőtt elmented!");
            }
        });

        var drawing = false;
        var mousePos = {
            x: 0,
            y: 0
        };
        var lastPos = mousePos;

        canvas.addEventListener("touchstart", function(e)
        {
            mousePos = getTouchPos(canvas, e);
            var touch = e.touches[0];
            var mouseEvent = new MouseEvent("mousedown", {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas.dispatchEvent(mouseEvent);
        }, false);


        canvas.addEventListener("touchend", function(e)
        {
            var mouseEvent = new MouseEvent("mouseup", {});
            canvas.dispatchEvent(mouseEvent);
        }, false);


        canvas.addEventListener("touchmove", function(e)
        {

            var touch = e.touches[0];
            var offset = $('#canvas_1').offset();
            var mouseEvent = new MouseEvent("mousemove", {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas.dispatchEvent(mouseEvent);
        }, false);


        // Get the position of a touch relative to the canvas
        function getTouchPos(canvasDiv, touchEvent)
        {
            var rect = canvasDiv.getBoundingClientRect();
            return {
                x: touchEvent.touches[0].clientX - rect.left,
                y: touchEvent.touches[0].clientY - rect.top
            };
        }


        var elem = document.getElementById(this.canvasID);

        var defaultPrevent = function(e)
        {
            e.preventDefault();
        }
        elem.addEventListener("touchstart", defaultPrevent);
        elem.addEventListener("touchmove", defaultPrevent);


        function redraw()
        {
            //
            lastPos = mousePos;
            for (var i = 0; i < clickX.length; i++)
            {
                context.beginPath();
                if (clickDrag[i] && i)
                {
                    context.moveTo(clickX[i - 1], clickY[i - 1]);
                }
                else
                {
                    context.moveTo(clickX[i] - 1, clickY[i]);
                }
                context.lineTo(clickX[i], clickY[i]);
                context.closePath();
                context.stroke();
            }
        }
    }
}
////