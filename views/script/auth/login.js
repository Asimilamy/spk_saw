$(document).off('submit', '#formLogin').on('submit', '#formLogin', function(e) {
    e.preventDefault();
    let url = 'controllers/auth/login.php';
    $('.form-alert').slideUp();
    submit_form(url, this)
        .done(function(data) {
            $('.form-alert').html(data.msg);
            $('.form-alert').slideDown();
            if (data.status == 'success') {
                location.reload();
            }
        })
        .fail(function () {
            alert('Sorry system encountered error!');
        });
});
