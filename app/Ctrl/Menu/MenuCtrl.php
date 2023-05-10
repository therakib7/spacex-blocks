<?php
namespace Bfsb\Ctrl\Menu;
 
use Bfsb\Ctrl\Menu\Type\Welcome;

class MenuCtrl {

	public function __construct() {
		if ( is_admin() ) { 
			new Welcome();
		}
	}
}