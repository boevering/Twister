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
    alert("document ready");

    $("#SubmitStartDataButton").click(function () {
        alert("document test");
    });
});
