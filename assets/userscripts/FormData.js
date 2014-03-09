/* 
    FormData is a class that working with forms 
    and controls.

    author: "Mihail Kornilov"
    email:  "fix-06 at yandex dot ru

    since:  v0.1 
    dependence: jQuery.js
 */

/*
    Object constructor
    Sets defaults values for ajax requests
*/
function FormData() {
    
};

FormData.prototype.dataType = 'text';
FormData.prototype.url = location.origin;
FormData.prototype.requestType = 'POST';
FormData.prototype.cache = false;

/*
    Sends request to the server and after success response
    run success function or after response with error run
    error function.

    @param String url - address for request
    @param String selector - button selector that send the request

    If document does't have forms alert with error message shows
*/
FormData.prototype.send = function (url, selector) {
    var url = url || '/';
    this.url += url;
    
    var selector = selector || 'button';
    var form = $(selector).parents('form');
    if (form.length) {
        $.ajax({
            dataType: this.dataType,
            url: this.url,
            type: this.requestType,
            data: form.serialize(),
            cache: this.cache,
            success: this.success(),
            error: this.error()
        });
    } else {
        alert('error in case selector ' + selector);
    }
};

/*
    Have run on success response
*/
FormData.prototype.success = function() {
    alert('data requested successfully');
};

/*
    Have run on error response
*/
FormData.prototype.error = function() {
    alert('error occur');
};