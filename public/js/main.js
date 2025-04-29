function logout(redirectUrl) {
    $.ajax({
        type: 'POST',
        url: redirectUrl,
        data: {
            'logout': true
        },
        success: function(data){
            window.location.href = data.location;
        }
    });
}