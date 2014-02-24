library StatLoad;

import "dart:html";

class StatLoad {

    String _url = '/index.php/site/index';
    String _selectorForLoad = '';

	StatLoad(this._url, this._selectorForLoad);
	StatLoad.simple();
	
	
	set url(String newUrl) => this.url = newUrl;
	String get url => this._url;
	
	set selectorForLoad(String newSelector) => this._selectorForLoad = newSelector;
	String get selectorForLoad => this._selectorForLoad;
	
	void addListener(String qSel) {
        HttpRequest request = new HttpRequest();

	    querySelector(qSel).onClick.listen((e) {
            

            request.onLoadEnd.listen((e) => _loadData(request));
            
            request.open('POST', this.url, async: true);
            request.send(json);
        });
	}
	
	void _loadData(HttpRequest request) {
        if (request == null) {
            throw new Exception("Bad request object");
        }
        
        Element elLoad = querySelector(this._selectorForLoad);
        if (elLoad == null) {
            window.location.reload();
        } else {
            elLoad.text = request.responseText;
        }
	}
}