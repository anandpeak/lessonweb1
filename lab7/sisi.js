
var i, xhr, activeXids = ['MSXML2.XMLHTTP.3.0', 'MSXML2.XMLHTTP', 'Microsoft.XMLHTTP'];
var xhr1, xhr2;
function start() {
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
        xhr.onreadystatechange = function () {
            if (xhr.status == 200 && xhr.readyState == 4) {
                var majors = document.getElementById('container');
                var majorObj = JSON.parse(xhr.responseText);
                var majUl = document.createElement("ul");
                for (i = 0; i < majorObj.length; i++) {
                    var majNameLi = document.createElement("li");
                    majNameLi.addEventListener("click", function (e) {
                        e.stopPropagation();
                        var majNameTar = e.target;
                        console.log(majNameTar);
                        var majObj = {
                            majVal: majNameTar.innerText
                        }
                        xhr1 = new XMLHttpRequest();
                        xhr1.onreadystatechange = function () {
                            if (xhr1.status == 200 && xhr1.readyState == 4) {
                                var studObj = JSON.parse(xhr1.responseText);
                                var studUl = document.createElement("ul");
                                for (j = 0; j < studObj.length; j++) {
                                    var studLi = document.createElement("li");
                                    studLi.addEventListener("click", function (el) {
                                        el.stopPropagation();
                                        lessNameTar = el.target;
                                        console.log(lessNameTar);
                                        var objStud = {
                                            studVal: lessNameTar.innerText
                                        }
                                        xhr2 = new XMLHttpRequest();
                                        xhr2.onreadystatechange = function () {
                                            if (xhr2.status == 200 && xhr2.readyState == 4) {
                                                lessonsObj = JSON.parse(xhr2.responseText);
                                                var lessUl = document.createElement("ul");
                                                for (k = 0; k < lessonsObj.length; k++) {
                                                    var lessNames = document.createElement("li");
                                                    lessNames.appendChild(document.createTextNode(lessonsObj[k].lessonName));
                                                    lessUl.appendChild(lessNames);
                                                }
                                                lessNameTar.appendChild(lessUl);
                                            }
                                        }
                                        xhr2.open("POST", 'http://localhost:8081/~macuser/web1/lab7/sisi.php', true);
                                        xhr2.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                                        var contStud = JSON.stringify(objStud);
                                        var studData = "studData1=" + contStud;
                                        xhr2.send(studData);
                                    });
                                    studLi.appendChild(document.createTextNode(studObj[j].firstName));
                                    studUl.appendChild(studLi);

                                }
                                console.log(majNameTar);
                                majNameTar.appendChild(studUl);
                            }
                        }
                        xhr1.open("POST", 'http://localhost:8081/~macuser/web1/lab7/sisi.php', true);
                        xhr1.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                        var cont = JSON.stringify(majObj);
                        var majData = "majData=" + cont;
                        xhr1.send(majData);
                    });
                    majNameLi.appendChild(document.createTextNode(majorObj[i].majorName));
                    majUl.appendChild(majNameLi);
                }
                majors.appendChild(majUl);


            }
        }
        xhr.open('POST', 'http://localhost:8081/~macuser/web1/lab7/sisi.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send();
    }


}
document.addEventListener('DOMContentLoaded', start, false);


// <-- eniiig comment gdg yum :))