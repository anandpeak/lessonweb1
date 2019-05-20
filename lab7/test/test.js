var i, xhr, activeXids = ['MSXML2.XMLHTTP.3.0', 'MSXML2.XMLHTTP', 'Microsoft.XMLHTTP'];
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
				console.log();
			}
		}
	}
	if (xhr) {
		xhr.onreadystatechange = function () {
			if (xhr.readyState !== 4) {
				return false;
			}
			if (xhr.status !== 200) {
				console.log(xhr.status);
				return false;
			}
			var students = document.getElementById('students');
			var studentObj = JSON.parse(xhr.responseText);
			console.log(typeof studentObj, studentObj);
			var list = document.createElement("ul");
			for (var i = 0; i < studentObj.length; i++) {
				var st = document.createElement("li");
				var sisiId = document.createElement("span");
				var fname = document.createElement("span");
				fname.addEventListener("click", function (e) {
					var fnameTar = e.target;
					var input = document.createElement("input");
					input.value = fnameTar.childNodes[0].nodeValue;
					input.addEventListener("click", function (ell) {
						ell.stopPropagation();
					});
					fnameTar.innerHTML = "";
					fnameTar.appendChild(input);
					input.addEventListener("keydown", function (el) {
						if (el.code == "Enter") {
							var obj = {
								fname: input.value
							}
							xhr.onreadystatechange = function () {
								if (xhr.status == 200 && xhr.readyState == 4) {
									console.log(xhr.responseText);
								}
							}

							xhr.open("POST", 'update.php');
							var content = JSON.stringify(obj);
							xhr.send(content);
						}
					});
				});
				var lname = document.createElement("span");
				fname.appendChild(document.createTextNode(studentObj[i].lname));
				lname.appendChild(document.createTextNode(studentObj[i].fname));
				sisiId.appendChild(document.createTextNode(studentObj[i].sisi_id));
				st.appendChild(fname);
				st.appendChild(lname);
				st.appendChild(sisiId);
				list.appendChild(st);
			}
			students.appendChild(list);

		};
		xhr.open('GET', 'test.php');
		xhr.send(null);
		console.log('sent');
	}
}
document.addEventListener('DOMContentLoaded', start, false);