<?php
namespace PMVC\PlugIn\form;

// \PMVC\l(__DIR__.'/xxx.php');

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\form';

class form extends \PMVC\PlugIn
{
    public function init()
    {
        echo "I'm init\n";
    }
}
