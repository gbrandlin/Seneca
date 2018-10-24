// JavaScript source code
ons.ready(function () {
    var pullHook = document.getElementById('pull-hook');

    pullHook.addEventListener('changestate', function (event) {
        var message = '';

        switch (event.state) {
            case 'initial':

                break;
            case 'preaction':

                break;
            case 'action':
                message = 'Loading...';
                break;
        }

        pullHook.innerHTML = message;
    });
    

    pullHook.onAction = function (done) {
        setTimeout(done, 1000);
    };
});

function showCustomer(str) {
    var xhttp;
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    }
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("txtHint").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "getcustomer.asp?q=" + str, true);
    xhttp.send();
}