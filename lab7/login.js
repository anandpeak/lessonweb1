var i, xhr, xhr1, activeXids = ['MSXML2.XMLHTTP.3.0', 'MSXML2.XMLHTTP', 'Microsoft.XMLHTTP'];


document.addEventListener('DOMContentLoaded', function () {

    setInterval(function () {
        if (typeof XMLHttpRequest === 'function') {
            xhr = new XMLHttpRequest();
        }
        else {
            for (i = 0; i < activeXids.length; i++) {
                try {
                    xhr = new ActiveXObject(activeXids[i]);
                }
                catch (err) {
                    alert("aldaa");
                }
            }

        }
        if (xhr) {
            var userName = document.getElementById("userName");
            var myRand = parseInt(Math.random() * 9999999);
            var name = {
                usName: userName.value,
                rand: myRand
            }
            xhr.onreadystatechange = function () {
                if (xhr.status == 200 && xhr.readyState == 4) {
                    var userObj = xhr.responseText;
                    var submi = document.getElementById("submit1");
                    console.log(userObj);
                    var par = document.getElementById("cent");
                    var aler = document.createElement("span");
                    aler.innerHTML = "Hereglegchiin ner davhtsaj baina";

                    if (userObj == 1) {
                        console.log("sain1");

                        par.appendChild(aler);

                        submi.disabled = true;

                    } else {
                        submi.disabled = false;

                        console.log("oruul");
                    }
                    if (par.childNodes[2]) {
                        par.removeChild(par.childNodes[2]);
                    }

                }

            }

            var const1 = JSON.stringify(name);
            console.log(name);
            var userId = "userId=" + const1;

            xhr.open('GET', 'http://localhost:8081/~macuser/web1/lab7/login.php?' + userId, true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.send();
        }
    }, 5000);

    //captcha reset hiih uyd captcha ajillahgui bol enentei hariutslaga tootsnuu bayrllaa
    var butt = document.getElementById("butt");
    butt.addEventListener("click", function () {
        if (typeof XMLHttpRequest === 'function') {
            xhr1 = new XMLHttpRequest();
        }
        else {
            for (i = 0; i < activeXids.length; i++) {
                try {
                    xhr1 = new ActiveXObject(activeXids[i]);
                }
                catch (err) {
                    alert("aldaa");
                }
            }
        }
        if (xhr1) {
            var captch = document.getElementById("captch");
            captch.remove();
            console.log(captch);
            captch = document.createElement("IMG");
            captch.src = "captcha.php";
            console.log(captch);
            captch.style.width = "100px";
            captch.style.height = "50px";
            captch.id = "captch";
            document.getElementById("parCaptch").appendChild(captch);
        }

    });
});
