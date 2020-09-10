$(document).ready(function()
{
    InputValidation();
    new Listener("email");
    new Listener("text");
    new Listener("money");
    new Listener("select");

    $("input[type=money]").inputFilter(function(inputVal)
    {
        return /^-?\d*$/.test(inputVal);
    });

    $("input[id=company_meeting_additional_payment_time]").inputFilter(function(inputVal)
    {
        return /^-?\d*$/.test(inputVal);
    });
});





////////////////////////////////////////// Validators ////////////////////////////////////////////////
class Listener
{
    constructor(type)
    {
        if (type == "email")
        {
            this.Email();
        }
        else if (type == "text")
        {
            this.Text();
        }
        else if(type == "money")
        {
            this.Money();
        }
        else if(type == "select")
        {
            this.Select();
        }
    }

    Email()
    {
        return $("input[type=email]").on("change", function()
        {
            var inputVal = $(this).val(); // getting the input value
            var inputId = $(this).attr("id"); // getting the input name for further validation if needed

            if (!$(this).is(":disabled") && $(this).is(":visible") && $(this).prop("required"))
            {
                if (inputVal == "")
                {
                    $(this).parent().find(".invalid-feedback").text("Kérlek töltsd ki a mezőt!");
                    $(this).removeClass("is-valid");
                    $(this).addClass("is-invalid");
                }
                else
                {
                    if (IsEmail(inputVal) && inputId != "company_member_email2")
                    {
                        $(this).removeClass("is-invalid");
                        $(this).addClass("is-valid");
                    }
                    else if (IsGmail(inputVal) && inputId == "company_member_email2")
                    {
                        $(this).removeClass("is-invalid");
                        $(this).addClass("is-valid");
                    }
                    else
                    {
                        $(this).parent().find(".invalid-feedback").text("Hibás email cím!");
                        $(this).removeClass("is-valid");
                        $(this).addClass("is-invalid");
                    }
                }
            }
            else
            {
                $(this).removeClass("is-valid");
                $(this).removeClass("is-invalid");
            }
        });
    }

    Text()
    {
        return $("input[type=text]").on("change", function()
        {
            var inputVal = $(this).val(); // getting the input value
            var inputId = $(this).attr("id"); // getting the input name for further validation if needed

            if (!$(this).is(":disabled") && $(this).is(":visible") && $(this).prop("required"))
            {
                if (inputVal == "")
                {
                    $(this).parent().find(".invalid-feedback").text("Kérlek töltsd ki a mezőt!");
                    $(this).removeClass("is-valid");
                    $(this).addClass("is-invalid");
                }
                else
                {
                    if (inputId == "company_name")
                    {
                        if (IsLengthGood(inputVal))
                        {
                            $(this).removeClass("is-invalid");
                            $(this).addClass("is-valid");
                        }
                        else
                        {
                            $(this).parent().find(".invalid-feedback").text("Minimum 3 karakter hosszúnak kell lennie!");
                            $(this).removeClass("is-valid");
                            $(this).addClass("is-invalid");
                        }
                    }
                    else
                    {
                        $(this).removeClass("is-invalid");
                        $(this).addClass("is-valid");
                    }
                }
            }
            else if (!$(this).is(":disabled") && $(this).is(":visible") && inputVal != "")
            {
                if (inputId == "company_short_name" || inputId == "company_foreign_name" || inputId == "company_short_foreign_name")
                {
                    if (IsLengthGood(inputVal))
                    {
                        $(this).removeClass("is-invalid");
                        $(this).addClass("is-valid");
                    }
                    else
                    {
                        $(this).parent().find(".invalid-feedback").text("Minimum 3 karakter hosszúnak kell lennie!");
                        $(this).removeClass("is-valid");
                        $(this).addClass("is-invalid");
                    }
                }
            }
            else
            {
                $(this).removeClass("is-valid");
                $(this).removeClass("is-invalid");
            }
        });
    }

    Money()
    {
        return $("input[type=money]").on("blur", function()
        {
            var inputVal = $(this).val(); // getting the input value

            if (!$(this).is(":disabled") && $(this).is(":visible") && $(this).prop("required"))
            {
                if (inputVal != "")
                {
                    if(parseInt(inputVal) % 1000 != 0)
                    {
                        $(this).parent().find(".invalid-feedback").text("Az összegnek ezerrel oszthatónak kell lennie!");
                        $(this).removeClass("is-valid");
                        $(this).addClass("is-invalid");
                    }
                    else
                    {
                        $(this).val(FormatMoney(inputVal));
                        $(this).removeClass("is-invalid");
                        $(this).addClass("is-valid");
                    }
                }
                else
                {
                    $(this).parent().find(".invalid-feedback").text("Kérlek töltsd ki a mezőt!");
                    $(this).removeClass("is-valid");
                    $(this).addClass("is-invalid");
                }
            }
            else if (!$(this).is(":disabled") && $(this).is(":visible") && inputVal != "")
            {
                if(parseInt(inputVal) % 1000 != 0)
                {
                    $(this).parent().find(".invalid-feedback").text("Az összegnek ezerrel oszthatónak kell lennie!");
                    $(this).removeClass("is-valid");
                    $(this).addClass("is-invalid");
                }
                else
                {
                    $(this).val(FormatMoney(inputVal));
                    $(this).removeClass("is-invalid");
                    $(this).addClass("is-valid");
                }
            }
            else
            {
                $(this).removeClass("is-valid");
                $(this).removeClass("is-invalid");
            }
        });
    }

    Select()
    {
        return $("select").on("change", function()
        {
            var inputVal = $(this).val(); // getting the input value
    
            if (!$(this).is(":disabled") && $(this).is(":visible") && $(this).prop("required")) // getting only select which are not disabled and visible and they are have required attribute
            {
                if (inputVal == "")
                {
                    $(this).parent().find(".invalid-feedback").text("Kérlek töltsd ki a mezőt!");
                    $(this).removeClass("is-valid");
                    $(this).addClass("is-invalid");
                }
                else
                {
                    $(this).removeClass("is-invalid");
                    $(this).addClass("is-valid");
                }
            }
            else
            {
                $(this).removeClass("is-valid");
                $(this).removeClass("is-invalid");
            }
        });
    }
}

// the rewritten function for validate every type of input (2020.08.11) Attila
function InputValidation(isSubmit = false)
{
    $(".member-container").each(function() // showing all of the member containers they can be hidden because of the collapser
    {
        if (isSubmit)
        {
            $(this).show();
        }
    });

    $("select").each(function()
    {
        var inputVal = $(this).val(); // getting the input value

        if (!$(this).is(":disabled") && $(this).is(":visible") && $(this).prop("required")) // getting only select which are not disabled and visible and they are have required attribute
        {
            if (inputVal == "")
            {
                $(this).parent().find(".invalid-feedback").text("Kérlek töltsd ki a mezőt!");
                $(this).removeClass("is-valid");

                if (isSubmit)
                {
                    $(this).addClass("is-invalid");
                }
            }
        }
    });

    $("input").each(function()
    {
        var inputVal = $(this).val(); // getting the input value
        var inputId = $(this).attr("id"); // getting the input name for further validation if needed
        var inputType = $(this).attr("type"); // getting input type for special validaiton

        if (!$(this).is(":disabled") && $(this).is(":visible") && $(this).prop("required")) // getting only inputs which are not disabled and visible and they are have required attribute
        {
            if (inputVal == "")
            {
                $(this).parent().find(".invalid-feedback").text("Kérlek töltsd ki a mezőt!");
                $(this).removeClass("is-valid");

                if (isSubmit)
                {
                    $(this).addClass("is-invalid");
                }
            }
            else
            {
                if (inputId == "company_name")
                {
                    if (IsLengthGood(inputVal))
                    {
                        $(this).removeClass("is-invalid");
                        $(this).addClass("is-valid");
                    }
                    else
                    {
                        $(this).parent().find(".invalid-feedback").text("Minimum 3 karakter hosszúnak kell lennie!");
                        $(this).removeClass("is-valid");
                        $(this).addClass("is-invalid");
                    }
                }
                else
                {
                    if (inputType == "email")
                    {
                        if (IsEmail(inputVal) && inputId != "company_member_email2")
                        {
                            $(this).removeClass("is-invalid");
                            $(this).addClass("is-valid");
                        }
                        else if (IsGmail(inputVal) && inputId == "company_member_email2")
                        {
                            $(this).removeClass("is-invalid");
                            $(this).addClass("is-valid");
                        }
                        else
                        {
                            $(this).parent().find(".invalid-feedback").text("Hibás email cím!");
                            $(this).removeClass("is-valid");
                            $(this).addClass("is-invalid");
                        }
                    }
                    else if (inputType == "money")
                    {
                        if ($(this).parent().parent().is(":visible"))
                        {
                            $(this).inputFilter(function(value)
                            {
                                return /^-?\d*$/.test(value);
                            });

                            $(this).val(FormatMoney(inputVal));
                            $(this).removeClass("is-invalid");
                            $(this).addClass("is-valid");
                        }
                        else
                        {
                            $(this).removeClass("is-valid");
                            $(this).removeClass("is-invalid");
                        }
                    }
                    else if(inputType == "text")
                    {
                        $(this).removeClass("is-invalid");
                        $(this).addClass("is-valid");
                    }
                }
            }
        }
        else if (!$(this).is(":disabled") && $(this).is(":visible") && inputVal != "")
        {
            if (inputId == "company_short_name" || inputId == "company_foreign_name" || inputId == "company_short_foreign_name")
            {
                if (IsLengthGood(inputVal))
                {
                    $(this).removeClass("is-invalid");
                    $(this).addClass("is-valid");
                }
                else
                {
                    $(this).parent().find(".invalid-feedback").text("Minimum 3 karakter hosszúnak kell lennie!");
                    $(this).removeClass("is-valid");
                    $(this).addClass("is-invalid");
                }
            }
        }
        else
        {
            $(this).removeClass("is-valid");
            $(this).removeClass("is-invalid");
        }
    });
}

// Mobile number input with realtime validaiton (2020.08.05) Attila
var input = document.querySelector("#company_member_phone");

// initialise plugin
var iti = window.intlTelInput(input,{
  utilsScript: "js/vendor/intlTelInput/utils.js?1585994360633",
  preferredCountries: ["hu"]
});

var reset = function()
{
  input.classList.remove("is-invalid");
};

// on blur: validate
input.addEventListener("blur", function() {
    reset();
    $(".invalid-phone").hide();
    if (input.value != "" && input.value.trim())
    {
        if (iti.isValidNumber())
        {
            input.classList.add("is-valid");
        }
        else
        {
            input.classList.add("is-invalid");
            var errorCode = iti.getValidationError();
            if (errorCode == -99)
            {
                input.classList.add("is-invalid");
                $(".invalid-phone").show();
            }
            else if (intlTelInputUtils.validationError.INVALID_COUNTRY_CODE)
            {
                input.classList.add("is-invalid");
                $(".invalid-phone").show();
            }
        }
    }
    else
    {
        input.classList.remove("is-invalid");
        input.classList.remove("is-valid");
        $(".invalid-phone").hide();
    }
});

// on keyup / change flag: reset
input.addEventListener("change", reset);
input.addEventListener("keyup", reset);
////

// Restricts input for each element in the set of matched elements to the given inputFilter.(2020.08.05) Attila
(function($)
{
    $.fn.inputFilter = function(inputFilter)
    {
      return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function()
      {
            if (inputFilter(this.value))
            {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            }
            else if (this.hasOwnProperty("oldValue"))
            {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            }
            else
            {
                this.value = "";
            }
      });
    };
}(jQuery));
////
//////////////////////////////////////////////////////////////





/////////////////////////////////////// Validator functions /////////////////////////////////////
// only numbers validaiton function (2020.08.05) Attila
function IsNumeric(num)
{
    var val = parseInt(num);
    return Number.isInteger(val);   
}
////

// email validation function (2020.08.05) Attila
function IsEmail(email)
{
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}
////

// gmail validation function (2020.08.30) Attila
function IsGmail(email)
{
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (re.test(String(email).toLowerCase()))
    {
        return email.includes("gmail.com");
    }
    else
    {
        return false;
    }
}
////

// length validator function (2020.08.05) Attila
function IsLengthGood(val, length = 3)
{
    var valueLength = val.length;
    return valueLength >= length;
}
////

// validator for checking if input doesn't contains any unwanted special character (2020.08.05) Attila
function IsValueValid(val)
{
    var pattern = new RegExp(/[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/); //unacceptable chars
    if (pattern.test(val))
    {
        return false;
    }
    return true;
}
////

// Money formatting 2 500 etc without decimal (2020.08.05) Attila
function FormatMoney(amount, decimalCount = 0, decimal = ".", thousands = " ")
{
    if (typeof(amount) == "number")
    {
        amount = amount.toString().replace(/ /g, " ");
    }
    else
    {
        amount = amount.replace(/ /g, " ");
    }

    try
    {
        decimalCount = Math.abs(decimalCount);
        decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

        const negativeSign = amount < 0 ? "-" : "";

        let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
        let j = (i.length > 3) ? i.length % 3 : 0;

        return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
    }
    catch(e)
    {
        console.log(e);
    }
}
////
/////////////////////////////////////////////////////////////////////////////////