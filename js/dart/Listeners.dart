import "dart:html";

class Listener {
  List _elements;

  /**
   * Constructor
   */
  Listener();

  void clearInputOnClick(String el){
    Element input = querySelector(el);
    
    input.onClick.listen((e) => _clearInput(input));
    input.onBlur.listen((e) => _fillInput(input));
  }
  
  void _clearInput(Element input){
    if (input.getAttribute('defVal') == null) {
      input.setAttribute('defVal', input.getAttribute('value'));
    }
    if (input.getAttribute('value') == input.getAttribute('defVal')) {
      input.setAttribute('value', '');
    }
  }

  void _fillInput(Element input) {
    if (input.getAttribute('value') == '') {
      input.setAttribute('value', input.getAttribute('defVal'));
    }
  }
}