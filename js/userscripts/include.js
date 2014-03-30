/*
	Function that includes the JavaScript files and executes them
	
	author: Mihail Kornilov
	email: 	fix-06 at yandex dot ru

	date: 	08 March 2014 23:09
	since:  v0.1
	dependence: need included jQuery
*/

var included = [];

/*
	Include only one script per time
	@param String path - path to <file>.js
*/
function include(path, callback) {
	for (var i = included.length - 1; i >= 0; i--) {
		if (included[i] == path) {
			alert('The file ' + path + ' already included');
			return false;
		}
	};
	$.ajax({
		url: path,
		dataType: 'script',
		assync: false,
		success: function() {
			included.push(path);
			callback;
		},
		error: function() {
			alert('The file ' + path + ' can\'t include because error occur');
		}
	});
}