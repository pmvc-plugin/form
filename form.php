<?php
namespace PMVC\PlugIn\form;

// \PMVC\l(__DIR__.'/xxx.php');

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\form';

class form extends \PMVC\PlugIn
{

    private $check = array();

    public function add($bool, $message=null, $callBack=null)
    {
        $this->check[] = array(
            'bool'=>$bool,
            'message'=>$message,
            'callBack'=>$callBack
        );
        return $bool;
    }

    public function validate()
    {
        $bool = true;
        foreach ($this->check as $check) {
            if (!$check['bool']) {
                $bool = false;
                if (!empty($check['message'])) {
                    trigger_error($check['message'], E_USER_ERROR);
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

    public function getCheckList()
    {
        return $this->check;
    }

    public function __toString()
    {
        return (string)$this->validate();
    }
}
