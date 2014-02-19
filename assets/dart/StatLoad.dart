import "dart:html";

class StatLoad {

    String _url = 'http://training/index.php/site/index';
    String _selectorForLoad = '';

	StatLoad(this._url, this._selectorForLoad);
	StatLoad.simple();
	
	
	set url(String newUrl) => this.url = newUrl;
	
	String get url => this._url;
	
	void addListener(String qSel) {
	    querySelector(qSel).onClick.listen((event) => loadData());
	}
	
	void loadData() {
	    HttpRequest request = new HttpRequest();
	    request.open('POST', this.url, async: false);
	    
	    String json = '{"test" : "Hello"}';
	    
	    request.send(json);

	    print(request.responseText);
	}
}