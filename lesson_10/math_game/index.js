var timerSec = 400;

$(".top").click(function () { //CHOICE
    $(".top").hide();
    $("#choice").show(1500);
});

$("#addition").click(function () { //ADDITION CLOCK
    document.getElementById('choice').style.display = 'none';
    vid = document.getElementsByClassName("numbers")[0].innerHTML;
    countdownAddition();
    $(".numbers").fadeIn();
});


function countdownAddition() {  // "It's a final COUNTINGtimerSec! Tu-du-du-duuu, tu-du-du- tu- tu"
    document.getElementsByClassName("numbers")[0].innerHTML = vid;
    vid--;
    var one_two = setTimeout(countdownAddition, 1000);
    if (vid == 0) {
        clearTimeout(one_two);
        $(".numbers").fadeOut();
        $("#example").show();
        $("#timerAddition").show();
        $("#suggestRightAnswer").show();
        timerID = setInterval(timerAddition, 1000); //main timer
        addition();
    }
}


var sum = 0;
var first = 0;
var second = 0;
function addition(min, max, min2, max2, min3, max3, minTimer, maxTimer) {
    min = 3;
    max = 10;

    min2 = 8;
    max2 = 14;

    min3 = 10;
    max3 = 18;

    minTimer = 4;
    maxTimer = 7;

    document.getElementById('example').innerHTML = "";
    document.getElementById('timerAddition').innerHTML = "";

    first = Math.floor(Math.random() * (max - min) + min);
    second = Math.floor(Math.random() * (max - min) + min);

    if (right > 4) {
        first = Math.floor(Math.random() * (max2 - min2) + min2);
        second = Math.floor(Math.random() * (max2 - min2) + min2);
    } else if (right > 7) {
        first = Math.floor(Math.random() * (max3 - min3) + min3);
        second = Math.floor(Math.random() * (max3 - min3) + min3);
    }

    sum = parseInt(first + second);

    console.log(sum);

    document.getElementById('example').innerHTML = first.toString() + " + " + second.toString();
    document.getElementById('timerAddition').innerHTML = sum + Math.floor(Math.random() * (maxTimer - minTimer)) + minTimer;
}

var right = 0;

function suggestRightAnswerAddition() {
    if (document.getElementById('timerAddition').innerHTML == sum) {
        right++;
        document.getElementById('suggestRightAnswer').innerHTML = "Right answers:";
        document.getElementById('suggestRightAnswer').innerHTML += right;
        return addition();
    } else if (document.getElementById('timerAddition').innerHTML != sum) {
        right = 0;
        document.getElementById('suggestRightAnswer').innerHTML = right;
        return addition();
    }
}

var timerID = 0;

function timerAddition() {
    var obj = document.getElementById('timerAddition');
    obj.innerHTML--;

    if (+obj.innerHTML < +sum - 3) {
        clearInterval(timerID);
        right = 0;
        document.getElementById('suggestRightAnswer').innerHTML = right;
        addition();
        timerID = setInterval(timerAddition, timerSec);
    }
}




<!----------------------------------------------------- ДОДАВАННЯ----------------------------------------------------------------------------- -->















<!----------------------------------------------------- ВІДНІМАННЯ----------------------------------------------------------------------------- -->










$("#subtraction").click(function () {
    document.getElementById('choice').style.display = 'none';
    vid = document.getElementsByClassName("numbers")[0].innerHTML;
    countdownSubtraction();
    $(".ready").css('display', 'none');
    $(".numbers").fadeIn();
    subtraction();
    console.log("sub");
});

function countdownSubtraction() {  // "It's a final COUNTING! Tu-du-du-duuu, tu-du-du- tu- tu"
    document.getElementsByClassName("numbers")[0].innerHTML = vid;
    vid--;
    var one_two = setTimeout(countdownSubtraction, 1000);
    if (vid == 0) {
        clearTimeout(one_two);
        $(".numbers").fadeOut();
        $("#example").show();
        $("#timerSubtraction").show();
        $("#suggestRightAnswer").show();
        timerID = setInterval(timerSubtraction, 1000);
        subtraction();
        console.log("sub");
    }
}

var sub = 0;
function subtraction(min, max, min2, max2, min3, max3, minTimer, maxTimer) {
    min = 3;
    max = 10;

    min2 = 5;
    max2 = 15;

    min3 = 8;
    max3 = 19;

    minTimer = 4;
    maxTimer = 8;
    document.getElementById('example').innerHTML = "";
    document.getElementById('timerSubtraction').innerHTML = "";
    first = Math.floor(Math.random() * (max - min) + min);
    second = Math.floor(Math.random() * (max - min) + min);
    if (right > 3) {
        first = Math.floor(Math.random() * (max2 - min2) + min2);
        second = Math.floor(Math.random() * (max2 - min2) + min2);
    } else if (right > 7) {
        first = Math.floor(Math.random() * (max3 - min3) + min3);
        second = Math.floor(Math.random() * (max3 - min3) + min3);
    }
    sub = parseInt(first - second);
    document.getElementById('example').innerHTML += first;
    document.getElementById('example').innerHTML += " ";
    document.getElementById('example').innerHTML += "-";
    document.getElementById('example').innerHTML += " ";
    document.getElementById('example').innerHTML += second;
    document.getElementById('timerSubtraction').innerHTML = first + Math.floor(Math.random() * (maxTimer - minTimer)) + minTimer;
    console.log("sub");
}

function suggestRightAnswerSubtraction() {
    if (document.getElementById('timerSubtraction').innerHTML == sub) {
        console.log("sub");
        right++;
        document.getElementById('suggestRightAnswer').innerHTML = "Right answers:";
        document.getElementById('suggestRightAnswer').innerHTML += right;
        return subtraction();
    } else if (document.getElementById('timerSubtraction').innerHTML != sub) {
        console.log("sub");
        right = 0;
        document.getElementById('suggestRightAnswer').innerHTML = right;
        return subtraction();
    }
}


function timerSubtraction() {

    console.log("sub");
    var obj = document.getElementById('timerSubtraction');
    obj.innerHTML--;

    if (+obj.innerHTML < +sub) {
        clearInterval(timerID);
        subtraction();
        right = 0;
        document.getElementById('suggestRightAnswer').innerHTML = right;
        timerID = setInterval(timerSubtraction, timerSec);
    }
}




<!----------------------------------------------------- ВІДНІМАННЯ----------------------------------------------------------------------------- -->









<!----------------------------------------------------- ДІЛЕННЯ----------------------------------------------------------------------------- -->












$("#division").click(function () {
    document.getElementById('choice').style.display = 'none';
    vid = document.getElementsByClassName("numbers")[0].innerHTML;
    countdownDivision();
    $(".ready").css('display', 'none');
    $(".numbers").fadeIn();
    division();
});

function countdownDivision() {  // "It's a final COUNTING! Tu-du-du-duuu, tu-du-du- tu- tu"
    document.getElementsByClassName("numbers")[0].innerHTML = vid;
    vid--;
    var one_two = setTimeout(countdownDivision, 1000);
    if (vid == 0) {
        clearTimeout(one_two);
        $(".numbers").fadeOut();
        $("#example").show();
        $("#timerDivision").show();
        $("#suggestRightAnswer").show();
        timerID = setInterval(timerDivision, 1000);
        division();
    }
}

var multi = 0;
var findId = 0;
function division(min, max, min2, max2, min3, max3, minTimer, maxTimer) {
    min = 2;
    max = 10;

    min2 = 4;
    max2 = 20;

    min3 = 8;
    max3 = 28;

    minTimer = 4;
    maxTimer = 10;
    document.getElementById('example').innerHTML = "";
    document.getElementById('timerDivision').innerHTML = "";
    first = Math.floor(Math.random() * (max - min) + min);
    second = Math.floor(Math.random() * (max - min) + min);
    if (right > 3) {
        first = Math.floor(Math.random() * (max2 - min2) + min2);
        second = Math.floor(Math.random() * (max2 - min2) + min2);
    } else if (right > 7) {
        first = Math.floor(Math.random() * (max3 - min3) + min3);
        second = Math.floor(Math.random() * (max3 - min3) + min3);
    }
    multi = parseInt(first * second);
    findId = parseInt(multi / first);
    document.getElementById('example').innerHTML += multi;
    document.getElementById('example').innerHTML += " ";
    document.getElementById('example').innerHTML += '/';
    document.getElementById('example').innerHTML += " ";
    document.getElementById('example').innerHTML += first;
    document.getElementById('timerDivision').innerHTML = multi + Math.floor(Math.random() * (maxTimer - minTimer)) + minTimer;
}

function suggestRightAnswerDivision() {
    if (document.getElementById('timerDivision').innerHTML == findId) {
        right++;
        document.getElementById('suggestRightAnswer').innerHTML = "Right answers:";
        document.getElementById('suggestRightAnswer').innerHTML += right;
        return division();
    } else if (document.getElementById('timerDivision').innerHTML != findId) {
        right = 0;
        document.getElementById('suggestRightAnswer').innerHTML = right;
        return division();
    }
}

function timerDivision() {
    var obj = document.getElementById('timerDivision');
    obj.innerHTML--;

    if (+obj.innerHTML < +multi) {
        clearInterval(timerID);
        division();
        right = 0;
        document.getElementById('suggestRightAnswer').innerHTML = right;
        timerID = setInterval(timerDivision, timerSec);
    }
}




<!----------------------------------------------------- ДІЛЕННЯ----------------------------------------------------------------------------- -->










<!----------------------------------------------------- МНОЖЕННЯ ----------------------------------------------------------------------------- -->






$("#multiplication").click(function () {
    document.getElementById('choice').style.display = 'none';
    vid = document.getElementsByClassName("numbers")[0].innerHTML;
    countdownMultiplication();
    $(".ready").css('display', 'none');
    $(".numbers").fadeIn();
    multiplication();
});

function countdownMultiplication() {  // "It's a final COUNTING! Tu-du-du-duuu, tu-du-du- tu- tu"
    document.getElementsByClassName("numbers")[0].innerHTML = vid;
    vid--;
    var one_two = setTimeout(countdownMultiplication, 1000);
    if (vid === 0) {
        clearTimeout(one_two);
        $(".numbers").fadeOut();
        $("#example").show();
        $("#timerMultiplication").show();
        $("#suggestRightAnswer").show();
        timerID = setInterval(timerMultiplication, 1000);
        multiplication();
    }
}


function multiplication(min, max, min2, max2, min3, max3, minTimer, maxTimer) {
    min = 1;
    max = 5;

    min2 = 1;
    max2 = 8;

    min3 = 3;
    max3 = 11;

    minTimer = 4;
    maxTimer = 10;
    document.getElementById('example').innerHTML = "";
    document.getElementById('timerMultiplication').innerHTML = "";
    first = Math.floor(Math.random() * (max - min) + min);
    second = Math.floor(Math.random() * (max - min) + min);
    if (right > 3) {
        first = Math.floor(Math.random() * (max2 - min2) + min2);
        second = Math.floor(Math.random() * (max2 - min2) + min2);
    } else if (right > 7) {
        first = Math.floor(Math.random() * (max3 - min3) + min3);
        second = Math.floor(Math.random() * (max3 - min3) + min3);
    }
    multi = parseInt(first * second);
    findId = parseInt(multi / first);
    document.getElementById('example').innerHTML += multi;
    document.getElementById('example').innerHTML += " ";
    document.getElementById('example').innerHTML += '*';
    document.getElementById('example').innerHTML += " ";
    document.getElementById('example').innerHTML += first;
    document.getElementById('timerMultiplication').innerHTML = multi + Math.floor(Math.random() * (maxTimer - minTimer)) + minTimer;
}

function suggestRightAnswerMultiplication() {
    if (document.getElementById('timerMultiplication').innerHTML == findId) {
        right++;
        document.getElementById('suggestRightAnswer').innerHTML = "Right answers:";
        document.getElementById('suggestRightAnswer').innerHTML += right;
        return multiplication();
    } else if (document.getElementById('timerMultiplication').innerHTML != findId) {
        right = 0;
        document.getElementById('suggestRightAnswer').innerHTML = right;
        return multiplication();
    }
}



function timerMultiplication() {
    var obj = document.getElementById('timerMultiplication');
    obj.innerHTML--;

    if (+obj.innerHTML < +multi) {
        clearInterval(timerID);
        multiplication();
        right = 0;
        document.getElementById('suggestRightAnswer').innerHTML = right;
        timerID = setInterval(timerMultiplication, timerSec);
    }
}

