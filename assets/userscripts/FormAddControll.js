/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    // Превращаем обычную таблицу в крутую
    $('#units').dataTable();
    
    // Запрет на ввод нецифровых данных в числовое поле
    // $('input.isNumeric').live('keydown', funtion());
    
    var ss = new ConcreeteFormData();

    // Реакция на клик по кнопке добавления новой записи
    $('#btnAdd').live('click', function() {
        ss.send('/index.php/site/addunit', '#btnAdd');
    });
});