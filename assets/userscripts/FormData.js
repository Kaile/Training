/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function FormData() {
    this.prototype.dataType = 'text';
    this.prototype.url = location.href + 'index.php';
    this.prototype.requestType = 'POST';
    this.prototype.cache = false;
};

FormData.prototype.send = function (url, selector) {
    var url = url || '/';
    this.prototype.url += url;
    
    var selector = selector || 'button';
    var form = $(selector).parents('form');
    if (form.length) {
        $.ajax({
            dataType: this.dataType,
            url: this.url,
            type: this.requestType,
            data: form.serialize(),
            cache: this.cache,
            success: this.success((data, textStatus, jqXHR)),
            error: this.error(jqXHR, textStatus, errorThrown)
        });
    } else {
        alert('error in case selector ' + selector);
    }
};

FormData.prototype.success = function() {
    alert('data requested successfully');
};

FormData.prototype.error = function() {
    alert('error occur');
};