<?php

namespace Bfsb\Ctrl;

use Bfsb\Ctrl\Ajax\AjaxCtrl;
use Bfsb\Ctrl\Api\ApiCtrl;
use Bfsb\Ctrl\Asset\AssetCtrl;
use Bfsb\Ctrl\Cron\CronCtrl;
use Bfsb\Ctrl\Template\TemplateCtrl;
use Bfsb\Ctrl\Hook\HookCtrl;
use Bfsb\Ctrl\Integrate\IntegrateCtrl;
use Bfsb\Ctrl\Assist\AssistCtrl;
use Bfsb\Ctrl\Meta\MetaCtrl;
use Bfsb\Ctrl\Menu\MenuCtrl;
use Bfsb\Ctrl\Taxonomy\TaxonomyCtrl;
use Bfsb\Ctrl\Widget\WidgetCtrl; 

class MainCtrl
{

    public function __construct()
    {

        //if ( is_admin() ) {
        new TaxonomyCtrl();
        new MenuCtrl();
        new AssistCtrl();
        //}
        new AssetCtrl();
        new TemplateCtrl();
        new WidgetCtrl();
        new AjaxCtrl();
        new HookCtrl();
        new MetaCtrl();
        new ApiCtrl();
        new CronCtrl();
        new IntegrateCtrl(); 
    }
}
