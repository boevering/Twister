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
        sendFormData();
        getUsers();
    });
});

function sendFormData(e) {
    $.ajax({
        type: "POST",
        url: "php/twister.php",
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

function getUsers() {
    $.ajax({
        type: "POST",
        url: "php/twister.php",
        dataType: "json",
        data: {
            call_id: "get_users"
        }
    }).done(function () {
        alert("done");
    });
}