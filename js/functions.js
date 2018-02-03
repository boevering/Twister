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
    $("#SubmitStartDataButton").click(function () {
        sendFormData(e);
    });
});

function sendFormData(e) {
    $.ajax({
        type: "POST",
        url: "php/game.php",
        dataType: "json",
        data: {
            call_id: "dummy",
            numberOfPlayers: $("#AmountPlayers").val(),
            numberOfColours: $("#AmountColors").val()
        }
    }).done(function(response) {
        alert("done 1: " + response.result);
        alert("done 2: " + response.RogierWins);
    });
}