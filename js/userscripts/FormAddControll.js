/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    // Превращаем обычную таблицу в крутую
    var table = $('#units').dataTable();
    
    var cfd = new ConcreeteFormData();

    // Реакция на клик по кнопке добавления новой записи
    $('#btnAdd').live('click', function() {
        cfd.sendForm('/ajax/addunit', '#btnAdd');
    });
    
    // Реакция на клик по кнопке удаления записи
    $('input.delRow').live('click', function() {
        var self = this;

        cfd.sendRequest(
                '/ajax/delunit',
                {id: $(this).attr('id')},
                function() {
                    table.fnDeleteRow(table.fnGetPosition(self.parentNode.parentNode));
                },
                function() {
                    alert('Невозможно удалить запись.');
                }
            );
    });
    
    // Реакция на клик по кнопке инкремента или декремента счетчика
    $('.changeCount').live('click', function() {
        var self = this;
        
        cfd.sendRequest(
                    '/ajax/changeCount',
                    {
                        id: $(self).attr('id'),
                        op: $(self).attr('op')
                    },
                    function (data) {
                        $(self).prevAll('span').html(data);
                    }
                );
    });
    
    // Реакция на клик по кнопке отображения предыдущих записей
    // Посылается запрос на загрузку данных с сервера
    // Данные получаются и записываюся в блок под таблицей
});