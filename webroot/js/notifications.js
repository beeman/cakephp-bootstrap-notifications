
function startNotifications() {
    poll(); 
        
    setInterval(function(){ 
        poll(); 
    }, 3000);

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
    if(parseInt(number) == 0) {
        $(counter).hide();
        $(icon).removeClass('icon-white');
    } else {
        $(counter).show();
        $(icon).addClass('icon-white');
    }
    $(counter).html(number);
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
    $('.notification-item').remove();
    var spinner = $('#notification-spinner');
    $(spinner).after(content);
    $(spinner).hide();
    return false;
}

function getNotificationList(userid) {
        
    $('.notification-item').hide();
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
