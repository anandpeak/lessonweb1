function buildGrid(cols, rows) {
    var arr = Array(cols);
    for (var i = 0; i < rows; i++) {
        arr[i] = Array(rows);
        for (var j = 0; j < arr[0].length; j++) {
            arr[i][j] = 'white';
        }
    }
    for (i = 1; i < arr[0].length; i++) {
        arr[0][i] = 'yellow';
        arr[i][0] = 'yellow';
        arr[7][i] = 'yellow';
        arr[i][6] = 'yellow';
    }
    arr[7][0] = 'white';
    arr[7][6] = 'white';
    arr[0][6] = 'white';
    arr[2][2] = 'black';
    arr[2][4] = 'black';
    arr[5][2] = 'red';
    arr[5][3] = 'red';
    arr[5][4] = 'red';
    var tableMarkup = "";

    for (x = 0; x < rows; x++) {
        tableMarkup += "<tr>";
        for (y = 0; y < cols; y++) {
            //tableMarkup += "<td>&nbsp;</td>";
            tableMarkup += "<td></td > ";
        }
        tableMarkup += "</tr>";
    }
    document.getElementById("drawing-table").innerHTML = tableMarkup;
    return arr;
};

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById("start").addEventListener('click', () => {
        // Variable Setup
        var cols = 7,
            rows = 8,
            curColor = "red",
            res = 27,
            clicks = 0;

        //$el;

        // Inital Build of Table  
        var arr = buildGrid(cols, rows);
        console.log(arr);

        function delegateSelector(selector, event, handler) {
            var elements = document.querySelectorAll(selector);
            [].forEach.call(elements, function (el) {
                el.addEventListener(event, function (e) {
                    //	console.log(e);
                    handler(e);
                });
            });
        }

        delegateSelector('table', "click", function (e) {
            //console.log(e.target);
            e.target.style.backgroundColor = curColor;
            clicks += 1;
            //	console.log(clicks);
            //	console.log(e.target.style.backgroundColor);
            var x = document.getElementsByTagName("td");
            let score = 0;
            // console.log(x[16].style.backgroundColor);
            // console.log()
            var arNum = 0;
            //var childNode = document.getElementById("drawing-table").childNodes;
            if (clicks <= res) {
                arNum = 0;
                //console.log("if " + arr[0][1] === x[arNum].style.backgroundColor)
                for (i = 0; i < rows; i++) {
                    for (j = 0; j < cols; j++) {
                        if (arr[i][j] == x[arNum].style.backgroundColor) {
                            //console.log("arr " + arr[i][j]);
                            //console.log("x " + x[arNum].style.backgroundColor)
                            score += 1;
                        }
                        arNum += 1;
                    }
                    console.log("asdf " + score);
                }

                //console.log("ar " + arNum)
            }
            if (score == 27) {
                alert("you win");
                location.reload();
            }


            //console.log(childNode.style.backgroundColor)
            //childnodes uudiin olood ternii #th iig catch hiih
            //click hiih burd shalgah nohtsol

        });


        delegateSelector('#color-selector', "click", function (e) {
            var el = e.target;
            curColor = el.getAttribute("data-color");
            el.classList.add("selected");
        });
    });
});