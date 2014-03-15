/* 
    FormData is a class that working with forms 
    and controls.

    @author: Mihail Kornilov fix-06 at yandex dot ru

    @since:  v0.3
    @dependence: jQuery.js
 */

/**
 * Object constructor
 * Sets defaults values for ajax requests
 * @returns {FormData}
 */
function FormData() {};

FormData.prototype.dataType = 'text';
FormData.prototype.requestType = 'POST';
FormData.prototype.cache = false;

/*
* Function send the requests. Used by other FormData functions
* @param {String} urlAddress - url where data is sending
* @param {String} sendingData - data that sended to server
* @param {Callback} successFunction - callback function that run if request is done
* @param {Callback} errorFunction - callback function that run if request is bad
*/
FormData.prototype.sendRequest = function(urlAddress, sendingData, successFunction, errorFunction) {
    var urlAddress = urlAddress || '/';
    urlAddress = location.origin + urlAddress;

    var successFunction = successFunction || this.successResponse;

    var errorFunction   = errorFunction || this.errorResponse;
    
    var sendingData = sendingData || null;

    var self = this;

    $.ajax({
        dataType: self.dataType,
        url: urlAddress,
        type: self.requestType,
        data: sendingData,
        cache: self.cache,
        success: function(data, textStatus, jqXHR) {
            successFunction(data, textStatus, jqXHR);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            errorFunction(jqXHR, textStatus, errorThrown);
        },
        complete: function() {
            delete urlAddress;
            delete self;
            delete sendingData;
        }
    });
};

/**
 * Have run on success response
 * @param {String} data
 * @param {String} textStatus
 * @param {Object} jqXHR
 */
FormData.prototype.successResponse = function(data, textStatus, jqXHR) {
    alert('data requested successfully');
};

/**
 * Have run on error response
 * @param {Object} jqXHR
 * @param {String} textStatus
 * @param {Object} errorThrown
 */
FormData.prototype.errorResponse = function(jqXHR, textStatus, errorThrown) {
    alert('error occur');
};

/**
 * Sends request to the server and after success response
 *  run success function or after response with error run
 *  error function.
 *  @param {String} url - address for request
 *  @param {String} selector - button selector that send the request
 *
 *  If document does't have forms alert with error message shows
 * 
 */
FormData.prototype.sendForm = function(url, selector) {
    var form = $(selector).parents('form');
    
    if (form.length) {
        this.sendRequest(
                url, 
                form.serialize(),
                this.successSendForm,
                this.errorSendForm
            );
    } else {
        alert('error in case selector ' + selector);
    }
};


FormData.prototype.deleteRow = function(url, params) {
    this.sendRequest(
            url, 
            params, 
            this.deleteResponse
        );
};
    

FormData.prototype.successSendForm  = function(data, textStatus, jqXHR) {
    alert('Form data has been successfully sended');
}

FormData.prototype.errorSendForm  = function(jqXHR, textStatus, errorThrown) {
    alert('Form data hasn\'t  sended');
}

    
// *************************************************************
ConcreeteFormData = function() {};

ConcreeteFormData.prototype = new FormData();

ConcreeteFormData.prototype.successSendForm = function(data) {   
    var data = data || '1';
    // Проверяем есть ли идентификатор, который хранит таблицу с данными
    if ($('#unitList').length) {
        $('#units').dataTable().fnAddData(data.split('*-'));
        $('#inputAdd').val('');
        $('#countAdd').val('1');
    } else {
        // Если же таблицы нет, после отсылки данных на сервер, обновляем страницу
        location.reload();
    }
};

ConcreeteFormData.prototype.errorSendForm = function() {
    alert('Добавление записи не было выполнено. Ошибка сервера.');
};