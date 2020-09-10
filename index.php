<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <title>Cégalapítás - Könnyen és gyorsan!</title>

</head>
<body>
    <div class="container-fluid">
    <header>
        <div class="row">
            <div class="col-md-3">
                <span>Cégalapítás</span>
            </div>
            <div class="col-md-9">
            <nav>
                <a href="#">Kezdőlap</a>
                <a href="#">Tudástár</a>
                <a href="#">Kapcsolat</a>
                <a href="adminpanel/admin/" target="_blank">Ügyvédeknek</a>
                <a href="adminpanel/admin/register" target="_blank">Ügyvédi iroda regisztráció</a>
            </nav>
            </div>
        </div>
    </header>
    <main>
        <div class="row">
            <div class="col-md-12 typewrite" data-period="2000" 
            data-type='[ "Bízza ránk vállalata alapítását.", "Kezdje el már ma.", 
            "A többit bízza ránk."]'>
                </div>
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <button type="button" class="buttonka" onclick="window.location.href='form/'"><span>Megalapítom a vállalkozásom.</span></button>
            </div>
            <div class="col-md-4">
            </div>
        </div>
    </main>


    </div>
</body>
</html>


<script>
var TxtType = function(el, forgat, period)
{
    this.forgat = forgat;
    this.el = el;
    this.loopNum = 0;
    this.period = parseInt(period, 10) || 2000;
    this.txt = '';
    this.tick();
    this.isDeleting = false;
};

TxtType.prototype.tick = function()
{
    var i = this.loopNum % this.forgat.length;
    var fullTxt = this.forgat[i];

    if (this.isDeleting)
    {
        this.txt = fullTxt.substring(0, this.txt.length - 1);
    }
    else
    {
        this.txt = fullTxt.substring(0, this.txt.length + 1);
    }

    this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

    var that = this;
    var delta = 200 - Math.random() * 100;

    if (this.isDeleting)
    {
        delta /= 2;
    }

    if (!this.isDeleting && this.txt === fullTxt)
    {
        delta = this.period;
        this.isDeleting = true;
    }
    else if (this.isDeleting && this.txt === '')
    {
        this.isDeleting = false;
        this.loopNum++;
        delta = 500;
    }

    setTimeout(function() {
        that.tick();
    }, delta);
};

window.onload = function()
{
    var elements = document.getElementsByClassName('typewrite');
    for (var i=0; i<elements.length; i++)
    {
        var forgat = elements[i].getAttribute('data-type');
        var period = elements[i].getAttribute('data-period');
        if (forgat)
        {
            new TxtType(elements[i], JSON.parse(forgat), period);
        }
    }
    // INJECT CSS
    var css = document.createElement("style");
    css.type = "text/css";
    css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
    document.body.appendChild(css);
};

</script>