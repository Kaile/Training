import "dart:html";

class StatLoad {

    String _url = '/index.php/site/addunit';
    String _selectorForLoad = '';

	StatLoad(this._url, this._selectorForLoad);
	StatLoad.simple();
	
	
	set url(String newUrl) => this.url = newUrl;
	
	String get url => this._url;
	
	void addListener(String qSel) {
        HttpRequest request = new HttpRequest();

	    querySelector(qSel).onClick.listen((e) {
            String json = '{"test" : "Hello"}';

            request.onLoadEnd.listen((e) => _loadData(request));
            request.open('POST', this.url, async: true);
            request.send(json);
        });
	}
	
	void _loadData(HttpRequest request) {

	}
}