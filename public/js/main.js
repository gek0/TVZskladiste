/**
 * main JS file
 */


jQuery(document).ready(function(){
    // category add form
    $("button#show-add").click(function(){
        $("div#add-content").toggle(500);
    });

    // page loader on system status
    $("#fakeloader").fakeLoader({
        timeToHide: 1000,
        zIndex: 999,
        spinner: "spinner5", // spinner1-7
        bgColor: "#337AB7"
    });

    //system status
    if($("#status-content").length > 0){
        setTimeout(function(){
            $("#status-content").fadeIn(250);
        }, 1500);
    }

    // user archived orders
    if($("#archived-order").length > 0){
        setTimeout(function(){
            $("#archived-order").fadeIn(250);
        }, 1500);
    }
});

$(document).ready(function(){

});

/**
 *   catch laravel form/route notifications
 */
function catchLaravelNotification(errorHtmlSourceID, notificationType) {
    var outputMsg = $('#outputMsg');
    var errorMsg = $('#'+errorHtmlSourceID).html();
    outputMsg.append(errorMsg).addClass(notificationType).slideDown();

    //timer
    var numSeconds = 5;
    function countDown(){
        numSeconds--;
        if(numSeconds == 0){
            clearInterval(timer);
        }
        $('#notificationTimer').html(numSeconds);
    }
    var timer = setInterval(countDown, 1000);

    function restoreNotification(){
        outputMsg.fadeOut(1000, function(){
            setTimeout(function () {
                outputMsg.empty().attr('class', 'notificationOutput');
            }, 2000);
        });
    }

    //hide notification if user clicked
    $('#notifTool').click(function(){
        restoreNotification();
    });

    setTimeout(function () {
        restoreNotification();
    }, numSeconds * 1000);
}