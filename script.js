$('#submit').on('click', function() {
    if ($('#description').css('opacity') == 0) {
        $('#description').css('opacity', 1);
    }
    else {
        $('#description').css('opacity', 0);
    }
});
