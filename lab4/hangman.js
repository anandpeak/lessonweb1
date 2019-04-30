var words = [
    ["f", "o", "r", "d"],
    ["b", "a", "t", "t", "u", "l", "g", "a"],
    ["a", "n", "a", "n", "d"]
]
var alphabet = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
    'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's',
    't', 'u', 'v', 'w', 'x', 'y', 'z'];
var ques = [
    ["USA iin mashin uildverlegch company iig nerlene uu"],
    ["Mongol ulsiin yronhiilegchiin ner hen be? "],
    ["Minii ner hen bilee ?"]
]
document.addEventListener("DOMContentLoaded", () => {
    var rad = Math.floor((Math.random() * 3));
    console.log(rad);

    console.log(ques);
    document.getElementById('asuult').innerHTML = ques[rad];
    // var buttons = function () {
    var buttons = document.getElementById("buttons");
    var letters = document.createElement('ul');
    for (var i = 0; i < alphabet.length; i++) {
        letters.id = 'alphabet';
        list = document.createElement('li');
        list.id = 'letter';
        list.innerHTML = alphabet[i];
        letters.appendChild(list);
        buttons.appendChild(letters);
        console.log(letters)
    }
    //  }
    // function result() {
    wordHolder = document.getElementById('hold');
    correct = document.createElement('ul');
    for (var i = 0; i < words[rad].length; i++) {
        correct.id = 'ans';
        live = document.createElement('li');
        live.id = 'liveWord';

        //
        correct.appendChild(live);
        wordHolder.appendChild(correct);
    }

    //}
    function delegateSelector(selector, event, handler) {
        var elements = document.querySelectorAll(selector);
        //  console.log("elements" + elements);
        //element uudiin child bolgon deer uildel hiih
        [].forEach.call(elements, function (el) {
            el.addEventListener(event, function (e) {
                //	console.log(e);
                //
                handler(e);
            });
        });
    }
    //hariultiin li nuudiig duudah
    var die = 0;
    var dieImg = 0;
    var won = 0;
    dieImg = document.getElementById("img");
    dieImg.src = "hangman" + die + ".png";

    delegateSelector('ul', 'click', function (e) {

        var ss = e.target.innerHTML;
        // console.log(ss);
        var log;
        var s = words[rad].indexOf(ss);
        if (s == -1) {
            die += 1;
            dieImg.src = "hangman" + die + ".png";
            if (die == 5) {
                alert("u lose");
                location.reload();
            }
        }
        var num = s;
        for (num; num < words[rad].length; num++) {
            dieImg.src = "hangman" + die + ".png";
            var lis = document.getElementById("ans").getElementsByTagName("li");
            //lis[1].innerHTML = "a";
            // console.log("lis" + lis[1])
            // console.log(s);
            //&& log != 1
            if (s == -1) {
                // die += 1;
                // dieImg.src = "hangman" + die + ".png";
                // if (die == 5) {
                //     alert("u lose");
                //     location.reload();
                // }
                break;
            } else if (s != -1) {
                lis[s].innerHTML = ss;
                //console.log(lis[s]);
                won += 1;
                // console.log(won);
                //  console.log(s);
            }

            s = words[rad].indexOf(ss, s + 1);
            console.log("s " + s);
            console.log("won" + won);

            // if (s == -1) {
            //     log = 1;
            // }
        }
        if (won == words[rad].length) {
            alert("you won");
            location.reload();
        }
    });
});