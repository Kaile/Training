/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    include('/assets/userscripts/jquery.dataTables.min.js');
    $('#btnAdd').live('click', function() {
        $.ajax({
            dataType: 'text',
            url: location.origin + '/index.php/site/addUnit',
            type: 'POST',
            data: $(this).parents('form').serialize(),
            cache: false,
            success: function(data, textStatus, jqXHR) {
                if ($('#unitList').length) {
                    $('#units').dataTable().fnAddData(data.split('-'));
                    $('#inputAdd').val('');
                } else {
                    location.reload();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(textStatus);
            }
        });
    });
    $('#units').dataTable();
});