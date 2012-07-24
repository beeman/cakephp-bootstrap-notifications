
function startNotifications() {
    // Save the pagetitle
    pagetitle = $(document).attr('title');
    
    // Initial poll
    poll(); 

    // Set poll timer
    setInterval(function(){ 
        poll(); 
    }, interval);

    $('#notification-icon').bind('click', function() {
        getNotificationList(userid);
    });
}
function poll() {
    countNotifications(userid);
}

function setNotificationCounter(number) {
    var counter = $('#notification-counter');
    var icon = $('#notification-icon i');
    var title = pagetitle;
    if(parseInt(number) == 0) {
        $(counter).hide();
        $(icon).removeClass('icon-white');
    } else {
        $(counter).show();
        $(icon).addClass('icon-white');
        title = '(' + number + ') ' + pagetitle;
    }
    $(counter).html(number);
    $(document).attr('title', title);
    return false;
}
    
function countNotifications(userid) {
    var base_url = count_url;
    var url =  base_url + "/" + userid;
    $.ajax({
        url: url,
        cache: false
    }).done(function(result) {
        setNotificationCounter(result);
    });
    return false;
}
    
function setNotificationItems(content) {
    $('.notification-icon .notification-item').remove();
    $('.notification-icon .notification-empty').remove();
    var spinner = $('#notification-spinner');
    $(spinner).before(content);
    $(spinner).hide();
    return false;
}

function getNotificationList(userid) {
    $('.notification-icon .notification-item').hide();
    $('.notification-icon .notification-empty').hide();
    var spinner = $('#notification-spinner');
    $(spinner).show();
    
    var url =  list_url + "/" + userid;
        
    $.ajax({
        url: url,
        cache: false
    }).done(function(result) {
        
        setNotificationItems(result);
    });
    return false;
}
