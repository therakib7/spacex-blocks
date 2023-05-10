<?php

namespace Bfsb\Ctrl\Hook;

use Bfsb\Ctrl\Hook\Type\Filter;
use Bfsb\Ctrl\Hook\Type\Action\ActionCtrl;

class HookCtrl
{
    public function __construct()
    {
        new Filter();
        new ActionCtrl();
    }
}
