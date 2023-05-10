<?php 
namespace Bfsb\Ctrl\Assist;

use Bfsb\Ctrl\Assist\Type\Feedback;
use Bfsb\Ctrl\Assist\Type\Link;

class AssistCtrl {
	
	public function __construct() {   
		new Link(); 
		new Feedback();
	} 
}