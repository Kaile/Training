import "dart:html";
import "dart:convert";

class StatLoad {

    String _url = '/index.php/site/addunit';
    String _selectorForLoad = '';

	StatLoad(this._url, this._selectorForLoad);
	StatLoad.simple();
	
	
	set url(String newUrl) => this.url = newUrl;
	
	String get url => this._url;
	
	void addListener(String qSel, {List<String> json}) {
        HttpRequest request = new HttpRequest();

        Map<String, String> jsonMap = new Map();

        json.forEach((elem) {
            Element tmp = querySelector(elem);
            jsonMap['${tmp.getAttribute("name")}'] = '${tmp.getAttribute("value")}';
        });
	    querySelector(qSel).onClick.listen((e) {
            request.onLoadEnd.listen((e) => _loadData(request));
            request.open('POST', this.url, async: true);
            request.send(JSON.encode(jsonMap));
        });
	}
	
	void _loadData(HttpRequest request) {
        
	}
}