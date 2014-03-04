library StatLoad;

import "dart:html";
import "dart:convert";

class StatLoad {

    String _url = '/index.php/site/index';
    String _selectorForLoad = '';

	StatLoad(this._url, this._selectorForLoad);
	StatLoad.simple();
	
	
	set url(String newUrl) => this.url = newUrl;
	String get url => this._url;

    set selectorForLoad(String newSelector) => this._selectorForLoad = newSelector;
    String get selectorForLoad => this._selectorForLoad;
	
	void addListener(String qSel, {List<String> json}) {
        HttpRequest request = new HttpRequest();

        Map<String, String> jsonMap;

        json.forEach((elem) {
            Element tmp = querySelector(elem);
            jsonMap[tmp.getAttribute("name")] = tmp.getAttribute("value");
        });
        
	    querySelector(qSel).onClick.listen((e) {
            request.onLoadEnd.listen((e) => _loadData(request));
            
            request.open('POST', this.url);
            request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            request.send(encodeMap(jsonMap));
        });
	}
	
	void _loadData(HttpRequest request) {

        if (request == null) {
            throw new Exception("Bad request object");
        }
        
        Element elLoad = querySelector(this._selectorForLoad);
        if (elLoad == null) {
//            window.location.reload();
        } else {
            elLoad.text = request.responseText;
        }

	}
	
	String encodeMap(Map data) {
	    return data.keys.map((k) {
	       return '${Uri.encodeComponent(k)}=${Uri.encodeComponent(data[k])}';
	    }).join('&');
	}
}