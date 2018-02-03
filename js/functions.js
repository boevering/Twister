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
    });
});

function sendFormData() {
    alert("1");

    var formData = new FormData(this);

    alert(formData);

    $.ajax({
        type: "POST",
        data: {
            action: "receiveStartTwisterData",
            newFormRecherche: formData
        },
        url: "php/game.php",
        success: function (response) {
            console.log(response);
            alert("success");
        },
        done: function () {
            alert("done");
        },
        fail: function () {
            alert("fail");
        }
    });

    alert("3");


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