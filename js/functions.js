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
    }).done(function(response) {
        alert("done 1: " + response.result);
        alert("done 2: " + response.RogierWins);
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