//require('./../chat');
import moment from 'moment';

$(function () {

    setTimeout(scro, 10);
    let userId = $('#userId').val(),
        addressee = $('#addressee').val(),
        noError = true;

    /// socket
    let socket = io(":6001");

    socket.on(`chat:message${addressee}`, function (data) {
        console.log(data);
        if (data.author == userId) {
            outboxMessage(data);
        } else {
            inboxMessage(data);
        }
    });

    socket.on('error', function (error) {
        noError = false;
        console.warn('Error', error);
    });

    ////  new message
    $('form').on('submit', function (e) {
        e.preventDefault();
        sendMessage();
    });

    $(document).bind('keydown', function(event) {
        if (event.keyCode == 13) {
            sendMessage();
        }
    });

    function sendMessage() {
        if (noError) {
            let msg = $('form').serialize();
            $.ajax({
                type: 'POST',
                url: '/intranet/message/save',
                data: msg,
                success: function (data) {
                    $('#user-message').val('');
                },
                error: function (xhr, str) {
                    console.log('Error: ' + xhr.responseCode);
                }
            });
        }
    }

    /// auto scroll
    function scro() {
        let elem = document.getElementById('message-block');
        elem.scrollTop = 9999;
    }

    function inboxMessage(data) {
        appendMessage(data, 'bounceInRight')
    }

    function outboxMessage(data) {
        appendMessage(data, 'bounceInLeft')
    }

    function appendMessage(data, classItem) {

        if (data.user_author.first_name == null) {
            data.user_author.first_name = ' ';
        }
        if (data.user_author.last_name == null) {
            data.user_author.last_name = ' ';
        }
        let item = $('<li/>').append(
            $('<b/>').text(`${data.user_author.first_name} ${data.user_author.last_name}`),
            $('<p/>').text(data.message),
            $('<small/>').text(moment(data.created_at).format('MM/DD/YY H:m:s')).addClass('pull-right')
        );
        $('#message').append(item);
        setTimeout(scro, 10);
        item.addClass(`message animated ${classItem}`);
    }
});