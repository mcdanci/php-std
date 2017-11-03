/**
 * @author Zain
 * @author Tiron
 */

//require.config({
//    //baseUrl: "",
//    //paths: {
//    //    "": ""
//    //}
//});

// TODO: do something here
var
    urlBegin = "http://s-show-api.intranet.fmnii.e13.cc/index.php/",
    urlSuffixIso3166 = "api/index/listIso3166",
    urlSuffixExhibitor = "api/registration/exhibitor";
urlSuffixVisitor = "api/registration/visitor";

function showCountryList() {
    // configuration
    var xhrObj;

    if (window.XMLHttpRequest) {
        xhrObj = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        xhrObj = new window.ActiveXObject();
    } else {
        alert('Please update the Explorer to latest version.');
    }

    if (xhrObj != null) {
        var url = urlBegin + urlSuffixIso3166;
        var countryField = document.getElementById('iso3166');

        xhrObj.open('POST', url, true);
        xhrObj.send(null);
        xhrObj.onreadystatechange = function () {
            // for debug
            //if (xhrObj.readyState === XMLHttpRequest.DONE && xhrObj.status === 200) {
            //    console.log(xhrObj.responseText);
            //}

            // by Zain
            if (xhrObj.readyState === 4 && xhrObj.status === 200) {
                var iso3166tuple;
                var jsonObj = eval((JSON.parse(xhrObj.responseText)).body);

                for (iso3166tuple in jsonObj) {
                    countryField.innerHTML +=
                        '<option value="'
                        + jsonObj[iso3166tuple].numeric + '">' + jsonObj[iso3166tuple].name // TODO: could be opt.
                        + '</option>';
                }
            }
        };
    }
}

showCountryList();

//window.onload = function () {
//    showCountryList();
//    alert('test');
//};

/**
 * @author Zain
 */

function clickP() {
    if ($("#tnc").is(":checked")) {
        $("#wp-submit").prop("disabled", false);
    } else {
        $("#wp-submit").prop("disabled", true);
    }
}

function validate() {
    var pwd = document.getElementById("password").value;
    var pwd1 = document.getElementById("password_c").value;
    if (pwd == pwd1) {
        document.getElementById("tInfo").innerHTML = "Confirm Password";
        document.getElementById("tInfo").style.color = "black";
    }
    else {
        document.getElementById("tInfo").innerHTML = "Unmatching";
        document.getElementById("tInfo").style.color = "red";
    }
}

function checkPwd() { // {name:'..',id:'..'}
    var zz = new RegExp("[a-z0-9_-]{6,18}");
    var pwd = $('#password').val();
    if (zz.test(pwd)) {
        $('#pwdInfo').css('color', 'black');
        $('#pwdInfo').text('Password');
    } else {
        $('#pwdInfo').css('color', 'red');
        $('#pwdInfo').text('The password requires minimum 6 digits.');
    }
}

function confirmPassword() {
    var pwd = $('#password').val();
    var pwdC = $('#password_c').val();
    if (pwd == pwdC) {
        $('#tInfo').text('Confirm Password')
    } else {
        $('#tInfo').text('Unmatching')
    }
}
