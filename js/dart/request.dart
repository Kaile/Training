library request;

import "dart:html";
import "dart:convert" show JSON;

typedef void RequestCallback(var data);

class Ajax {

  static const String JsonType = "application/json";

  final String url;
  final String method;
  final Map data;
  final List<RequestCallback> _succesCallbacks = [];
  final List<RequestCallback> _errorCallbacks = [];

  Ajax(this.url, this.method, this.data);

  void go() {
    HttpRequest request = new HttpRequest();

    request.open(method, url);
    request.onLoad.listen((event) {
        if (request.status < 400) {
          try {
            Map result = request.responseText.isEmpty ? {} : JSON.decode(request.responseText);
            _executeSuccess(result);
          } catch (e) {
            _executeError(request.responseText);
          }
        } else {
          _executeError(request.responseText);
        }
      });

    request.setRequestHeader("Accept", JsonType);

    if (data != null) {
      request.setRequestHeader("Content-Type", JsonType);
      request.send(JSON.encode(data));
    } else {
      request.send();
    }
  }

  Ajax done(RequestCallback callback) {
    _succesCallbacks.add(callback);
    return this;
  }

  Ajax fail(RequestCallback callback) {
    _errorCallbacks.add(callback);
    return this;
  }

  Ajax always(RequestCallback callback) {
    _succesCallbacks.add(callback);
    _errorCallbacks.add(callback);
    return this;
  }

  void _executeSuccess(data) {
    _succesCallbacks.forEach((callback) => callback(data));
  }

  void _executeError(responseText) {
    _errorCallbacks.forEach((callback) => callback(responseText));
  }

}

abstract class Request
{
	String _method;
	String _url;
	Map    _data;

	Request({String url: 'index.html', String method: 'POST', Map data: null})
	{
		this._url    = url;
		this._method = method;
		this._data   = data;
	}
	
	success(var data);
	
	error(String status);
	
	complete(var data);
	
	void beforeSend();
	
	void send()
	{
		this.beforeSend();
		new Ajax(_url, _method, _data)
			.fail(error)
			.done(success)
			.always(complete)
			.go();
	}
}

class RealRequest extends Request
{
	RealRequest(String url) : super(url: url);

	success(var data)
	{
		print('Success function is running: ' + data);
	}
	
	error(String status)
	{
		print('Error function is running ' + status);
	}
	
	complete(var data) 
	{
		print('Complete function is running ' + data);
	}
	
	void beforeSend()
	{
		print('BeforeSend function is running');
	}
}

void main()
{
	(new RealRequest('index.html')).send();
}