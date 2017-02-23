var timerId;

$(document).ready(function () {

    $('#submit').on('click', startTimer);

    $('#stop').on('click', stopTimer);

});

function stopTimer() {
    clearInterval(timerId);
}

function startTimer() {
    getNews();
    stopTimer();
    var interval = parseInt($('#interval').val());

    if (interval <= 3 || isNaN(interval)) {
        interval = 3;
        $('#interval').val(interval);
    }
    timerId = window.setInterval(getNews, interval * 1000);
}

function getNews() {
    $('.content').removeClass('processing').addClass('processing');

    var provider = $('#provider').val();

    if (provider == '') {
        stopTimer();
        $('.list').empty().removeClass('processing');
        alert('Error: Please select provider');
        return;
    }
    var username = $('#username').val();

    $.ajax({
        url: "/getNews",
        data: {username: username, provider: provider},
        dataType: 'json'
    }).done(function (data) {
        $('.content').removeClass('processing');
        buildNewsFeed(data);
    }).fail(function (jqXHR, textStatus, errorThrown) {
        $('.content').removeClass('processing');
        stopTimer();
        var error = JSON.parse(jqXHR.responseText);
        alert(error.error);
        buildNewsFeed([]);
    });
}

function buildNewsFeed(news) {
    $('.list').empty();
    news.forEach(function (item, i, news) {
        var itemClone = $('#item_template').clone();
        itemClone.attr('id', '');
        itemClone.attr('style', '');
        itemClone.find('.name').text(item.username);
        itemClone.find('.title').text(item.title);
        itemClone.find('.date').text(item.createdAt);
        itemClone.find('.description').text(item.text);
        if (item.media.type == 'photo') {
            itemClone.find('.media').html('<img src="' + item.media.url + '">');
        }

        $('.list').append(itemClone);
    });

}