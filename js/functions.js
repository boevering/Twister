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
        e.preventDefault();
        sendFormData(e);
    });
});

function sendFormData(e) {
    $.ajax({
        type: "POST",
        url: "php/game.php",
        dataType: "json",
        data: {
            numberOfPlayers: $("#AmountPlayers").val(),
            numberOfColours: $("#AmountColors").val()
        }
    }).always(function() {
        alert("always");
    }).success(function(response) {
        alert("done: " + response);
    });

    //$.post("php/game.php",
    //    {
    //        name: "Donald Duck",
    //        city: "Duckburg"
    //    },
    //    function (data, status) {
    //        alert("Data: " + data + "\nStatus: " + status);
    //    });
}