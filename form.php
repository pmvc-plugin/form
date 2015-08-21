<?php
namespace PMVC\PlugIn\form;

// \PMVC\l(__DIR__.'/xxx.php');

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\form';

class form extends \PMVC\PlugIn
{

    private $check;

    public function init()
    {
        $this['error'] = array();
    }

    public function add($params)
    {
        $params = \PMVC\mergeDefault(
            $this->getDefault(),
            $params
        );
        $this->check[] = $params;
        return $params['bool'];
    }

    public function getDefault()
    {
        return array(
            'bool'=>false,
            'key'=>'',
            'message'=>'',
            'url'=>'',
            'callBack'=>null
        );
    }

    public function validate()
    {
        $bool = true;
        foreach ($this->check as $check) {
            if (!$check['bool']) {
                $bool = false;
                if (!empty($check['message'])) {
                    trigger_error($check['message'],E_USER_ERROR);
                    $this['error'][$check['key']] = $check['message'];
                }
                if (!empty($check['url'])) {
                    $this['redirect'] = $check['url']; 
                }
                if (!empty($check['callBack'])) {
                    call_user_func_array(
                        $check['callBack'],
                        $check 
                    );
                }
            }
        }
        return $bool;
    }

    public function __toString()
    {
        return (string)$this->validate();
    }
}
