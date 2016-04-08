/**
 * Created by pfeifer on 05.04.2016.
 */
$(document).ready(function() {
    $("#myBtn").click(function () {
        var url = window.location.href + "?page=connect";
        window.location = url;
        return true;
    });

    $("#update-btn").click(function () {
        $(".moodForm").removeClass("hidden");
        $(".moodText").addClass("hidden");
        $("#update-btn").addClass("hidden");
        $("#delete-btn").addClass("hidden");
    });

    $("#back").click(function () {
        var param = +getURLParameter("dateId")+1;
        if(isNaN(param)){
            param = 1;
        }
        var urlArray = getUnfinishedURL();
        var url = "index.php?" + urlArray[0] + "&" + urlArray[1] + "&dateId=" + param;
        window.location = url;
    });

    $("#forward").click(function () {
        var param = +getURLParameter("dateId")-1;
        if(isNaN(param)){
            param = 0;
        }
        if(param < 0){
            param = 0
        }
        var urlArray = getUnfinishedURL();
        var url = "index.php?" + urlArray[0] + "&" + urlArray[1] + "&dateId=" + param;
        window.location = url;
    });

    function onLoad() {

        $.ajax({
            url: 'php/ajaxDBcall.php',
            type: 'POST',
            data: {xid: $('#user').text(), sleep: $('#sleep').text()},
            success: function(result) {
                if(result != ""){
                    $(".moodForm").addClass("hidden");
                    $(".moodText").text(result);
                    $(".moodText").removeClass("hidden");
                    $("#update-btn").removeClass("hidden");
                    $("#delete-btn").removeClass("hidden");
                }
                console.log("success");
                console.log(result);
            },
            error: function () {
                console.log("error");
            }
        });

    }

    onLoad();

    $("#delete-btn").click(function () {
        $.ajax({
            url: 'php/ajaxDBdelete.php',
            type: 'POST',
            data: {xid: $('#user').text(), sleep: $('#sleep').text()},
            success: function(result) {
                $(".moodForm").removeClass("hidden");
                $(".moodText").addClass("hidden");
                $("#update-btn").addClass("hidden");
                $("#delete-btn").addClass("hidden");
                console.log("success");
                console.log(result);
            },
            error: function () {
                console.log("error");
            }
        });
    });

    $(".moodForm").submit(function (e) {
        e.preventDefault();

        var $form = $(".selectForm").val();

        $.ajax({
            url: 'php/ajaxDBuOrI.php',
            type: 'POST',
            data: {value : $form, xid: $('#user').text(), sleep: $('#sleep').text()},
            success: function(result) {
                $(".moodForm").addClass("hidden");
                $(".moodText").text($form);
                $(".moodText").removeClass("hidden");
                $("#update-btn").removeClass("hidden");
                $("#delete-btn").removeClass("hidden");
                console.log("success");
                console.log(result);
            },
            error: function () {
                console.log("error");
            }
        });
    });

    function getURLParameter(sParam){
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');
        for (var i = 0; i < sURLVariables.length; i++){
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == sParam){
                return sParameterName[1];
            }else{
            }
        }
    }

    function getUnfinishedURL(){
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');
        return sURLVariables;
    }
    $("#logout").click(function () {
        window.location.replace('index.php');
        return true;
    });

});



