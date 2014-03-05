/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(
    $('#btnAdd').live('click', function() {
        $.ajax({
            dataType: 'text',
            url: location.href + 'index.php/site/addUnit',
            type: 'POST',
            data: $(this).parents('form').serialize(),
            cache: false,
            success: function(data, textStatus, jqXHR) {
                if ($('#unitList').length) {
                    $('#unitList').html($('#unitList').html() + data);
                    $('#inputAdd').val('');
                } else {
                    location.reload();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(textStatus);
            }
        });
    })
);