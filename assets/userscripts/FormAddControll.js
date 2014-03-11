/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    // Превращаем обычную таблицу в крутую
    var table = $('#units').dataTable();
    
    // Запрет на ввод нецифровых данных в числовое поле
    // $('input.isNumeric').live('keydown', funtion());
    
    var ss = new ConcreeteFormData();

    // Реакция на клик по кнопке добавления новой записи
    $('#btnAdd').live('click', function() {
        ss.sendForm('/index.php/site/addunit', '#btnAdd');
    });
    
    $('input.delRow').live('click', function() {
        var self = this;
        $.ajax({
            url: location.origin + "/index.php/site/delunit",
            type: 'POST',
            data: {
                id: $(self).attr('id')
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Can\'t delete');
            },
            success: function(data, textStatus, jqXHR) {
                table.fnDeleteRow(table.fnGetPosition(self.parentNode.parentNode));
            }
        });
    });
});