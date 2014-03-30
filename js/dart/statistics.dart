import "Listeners.dart";
import "StatLoad.dart";

main() {
	Listener listener = new Listener()..clearInputOnClick('#textAdd')
                                      ..clearInputOnClick('#numAdd');
    List<String> listElem = new List();
    listElem..add('#textAdd')
            ..add('#numAdd');
    StatLoad loader = new StatLoad('/index.php/site/addunit', '#unitList')..addListener('.btnAdd', json: listElem);

}