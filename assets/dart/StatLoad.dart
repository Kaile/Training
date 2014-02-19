import "dart:html";

class StatLoad {

    String _url = 'index.php';
    String _selectorForLoad = '';

	StatLoad(this._url, this._selectorForLoad);
	StatLoad.simple();
	
	
	set url(String newUrl) => this.url = newUrl;
	
	String get url => this._url;
	
	void addListener(String qSel) {
	    querySelector(qSel).onClick.listen((event) => loadData);
	}
	
	void loadData() {
	    HttpRequest request = new HttpRequest();
	    request.open('POST', this.url, async: true);
	    
	    String json = '{"testing" : "Hello"}';
	    
	    request.send(json);
	    
	    if (request.readyState == HttpRequest.DONE && 
	            (request.status == 0 || request.status == 200)) {
	        print(request.responseText);
	    }
	}
}