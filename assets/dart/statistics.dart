import "Listeners.dart";
import "StatLoad.dart";

main() {
	new Listener()..clearInputOnClick('#textAdd')
                ..clearInputOnClick('#numAdd');
  new StatLoad.simple().addListener('.btnAdd');
}