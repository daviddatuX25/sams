function logout(redirectUrl) {
    console.log('Logging out...');
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
