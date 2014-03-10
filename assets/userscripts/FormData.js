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
function FormData() {};

FormData.prototype.dataType = 'text';
FormData.prototype.url = location.origin;
FormData.prototype.requestType = 'POST';
FormData.prototype.cache = false;

/*
    Have run on success response
*/
FormData.prototype.successResponse = function(data, textStatus, jqXHR) {
    alert('data requested successfully');
};

/*
    Have run on error response
*/
FormData.prototype.errorResponse = function(jqXHR, textStatus, errorThrown) {
    alert('error occur');
};

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
    var self = this;
    if (form.length) {
        $.ajax({
            dataType: self.dataType,
            url: self.url,
            type: self.requestType,
            data: form.serialize(),
            cache: self.cache,
            success: function(data, textStatus, jqXHR) {
                self.successResponse(data, textStatus, jqXHR);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                self.errorResponse(jqXHR, textStatus, errorThrown);
            },
            complete: function() {
                delete url;
                delete selector;
                delete form;
                delete self;
            }
        });
    } else {
        alert('error in case selector ' + selector);
    }
};


// *************************************************************
ConcreeteFormData = function() {};

ConcreeteFormData.prototype = new FormData();

ConcreeteFormData.prototype.successResponse = function(data) {   
    var data = data || '1';
    if ($('#unitList').length) {
        $('#units').dataTable().fnAddData(data.split('*-'));
        $('#inputAdd').val('');
        $('#countAdd').val('1');
    } else {
        // Если же таблицы нет, после отсылки данных на сервер, обновляем страницу
        location.reload();
    }
}

ConcreeteFormData.prototype.errorResponse = function() {
    alert('Добавление записи не было выполнено. Ошибка сервера.');
}