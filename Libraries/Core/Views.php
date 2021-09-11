<?php 

class Views
{
    function getView($controller, $view, $data=""){
        $controller = get_class($controller);
        if ($controller == 'Start') {
            $view = 'Views/'.$view.'.php';
        }else{
            $view = 'Views/'.$controller.'/'.$view.'.php';
        }
        require_once($view);
    }

}
