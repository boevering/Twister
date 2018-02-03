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
    $("#StartTwisterForm").submit(function (e) {
        sendFormData(e);
    });
});

function sendFormData(e) {
    alert("1");

    var formData = new FormData($("#SubmitStartDataButton"));

    alert(formData);

    $.post(
        "php/game.php",
        formData,
        function (data, status) {
            alert("Data: " + data + "\nStatus: " + status);
        }
    );

    $.post("php/game.php",
        {
            name: "Donald Duck",
            city: "Duckburg"
        },
        function (data, status) {
            alert("Data: " + data + "\nStatus: " + status);
        });


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