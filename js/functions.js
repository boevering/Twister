// JavaScript Document
function display() {
	"use strict";
	document.getElementById('add').style.display = 'block';
}

function ColorPlayer(colors) {
    var colorsArray = colors.split(",");
    return (colorsArray);
}

$(document).ready(function() {
    $("#SubmitStartDataButton").submit(function (e) {
        sendFormData(e);
    });
});

function sendFormData(e) {
    alert("1");

    var formData = new FormData($("#SubmitStartDataButton"));

    alert(formData);

    $.ajax({
        type: "POST",
        data: formData,
        url: "php/game.php",
        done: function (response) {
            console.log(response);
            alert("success");
        }
    });

    alert("3");

    e.preventDefault();

    //$.ajax({
    //        url: "game.php",
    //        data: $("#StartTwisterForm").serialize()
    //    })
    //    .done(function () {
    //        alert("done");
    //    })
    //    .success(function () {
    //        alert("success");
    //    })
    //    .fail(function () {
    //        alert("fail");
    //    });
}