/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    // Превращаем обычную таблицу в крутую
    $('#units').dataTable();
    
    // Запрет на ввод нецифровых данных в числовое поле
    $('input.isNumeric').live('keydown', funtion());
    
    // Реакция на клик по кнопке добавления новой записи
    $('#btnAdd').live('click', function() {
        function(data, textStatus, jqXHR) {
            // В случае существования непустой таблицы, добавляем новую строку
            if ($('#unitList').length) {
                $('#units').dataTable().fnAddData(data.split('-'));
                $('#inputAdd').val('');
                $('#countAdd').val('1');
            } else {
                // Если же таблицы нет, после отсылки данных на сервер, обновляем страницу
                location.reload();
            }
        }
        function(jqXHR, textStatus, errorThrown) {
            alert('Добавление записи не было выполнено. Ошибка сервера.');
        }
    });
    
});