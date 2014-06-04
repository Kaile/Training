/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// Превращаем обычную таблицу в крутую
$(document).ready(function () {
	table = $('#units').dataTable();
	
	// удаление мероприятия
	$('.delRow').click(function() {
		var data  = {};
		data.id   = $(this).attr('id');
		data.self = this;
		(new DeleteRowRequest(data)).send();
	});
});

function AjaxRequest(data) {
	this.data     = data || {};
	this.assync   = true;
	this.dataType = 'text';
	this.type     = 'POST';
	this.url      = '.';
	
	this.beforSend = function() {};
	
	this.success   = function(data) {};
	
	this.error     = function(jqXHR) {
		console.error(jqXHR);
	};
	
	this.complete  = function() {};
	
	this.send = function() {
		var self = this;
		
		$.ajax({
			async:    self.assync,
			type:     self.type,
			data:     self.data,
			url:      self.url,
			dataType: self.dataType,
			beforeSend: function(xhr) {
				self.beforSend();
			},
			success: function(data, textStatus, jqXHR) {
				self.success(data);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				self.error(jqXHR);
			},
			complete: function(jqXHR, textStatus) {
				self.complete();
			}
		});
	};
}

// request for deleting row
function DeleteRowRequest(data) {
	this.data = data;
	this.url = '/ajax/delunit';
	
	this.success = function(data) {
		if (data.length > 1) {
			console.info(data);
		} else {
			table.fnDeleteRow(table.fnGetPosition(this.data.self.parentNode.parentNode));
		}
	};
}
DeleteRowRequest.prototype = new AjaxRequest();
DeleteRowRequest.prototype.constructor = AjaxRequest.constructor;