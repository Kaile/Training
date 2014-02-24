import "Listeners.dart";
import "StatLoad.dart";

main() {
	Listener listener = new Listener()..clearInputOnClick('#textAdd')
                                      ..clearInputOnClick('#numAdd');
    StatLoad loader = new StatLoad('/index.php/site/addunit', '#unitList')..addListener('.btnAdd');
}