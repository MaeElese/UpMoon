/**
 * Created by pfeifer on 05.04.2016.
 */
$(document).ready(function() {
    $("#myBtn").click(function () {
        var url = window.location.href + "?page=connect";
        window.location = url;
        return true;
    })
});




