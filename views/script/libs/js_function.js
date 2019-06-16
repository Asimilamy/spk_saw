function submit_form(url, form_element) {
    return $.ajax({
        type: 'POST',
        url: url,
        data: new FormData(form_element),
        contentType: false,
        processData:false
    });
}
