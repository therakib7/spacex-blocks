<?php 
namespace Bfsb\Ctrl\Integrate;

use Bfsb\Ctrl\Integrate\Smtp\SmtpCtrl;

class IntegrateCtrl
{
    public function __construct()
    {
        new SmtpCtrl();
    } 
}
