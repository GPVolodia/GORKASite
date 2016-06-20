<?php

class Router
{
    private $routes;

    public function __construct()
    {
       // $this->routes = include(ROOT . '/application/config/routes.php');
        $this->routes = include(ROOT . '/components/routes.php');
    }

    public function ololo ()
    {
        echo '<br>';
        
        print_r($this->routes);
        echo '<br>';
    }

    /*public function run ()
    {
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        $uri = urldecode($uri);

        foreach ($this->routes as $pattern => $path)
        {
            if (preg_match("~$pattern~", $uri))
            {

                $internalUri = preg_replace("~$pattern~", $path, $uri);
                echo $internalUri;
                $segments = explode('/', $internalUri);

                $controllerName = array_shift($segments) . "Controller";
                $controllerName = ucfirst($controllerName);

                $actionName = array_shift($segments);
                $actionName = 'action' . ucfirst($actionName);

                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

                if (file_exists($controllerFile))
                    include_once $controllerFile;

                
                if ($result != null)
                {
                    break;
                }

                echo "Контролер : $controllerName<br>";
                echo "Метод : $actionName";
                $parameters = $segments;
                print_r($parameters);
                echo '<br><br>';
                $controllerObject = new $controllerName;
                $result = $controllerObject -> $actionName($parameters);

            }
        }
    }*/

    public function run()
	{
        
        $isCorrectPage = false;
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        $uri = urldecode($uri);
        foreach ($this->routes as $pattern => $path)
            if  (preg_match("~$pattern~", $uri))
            {
                $internalUri = preg_replace("~$pattern~", $path, $uri);
                $segments = explode('/', $internalUri);

                $controllerName = array_shift($segments) . "Controller";
                $controllerName = ucfirst($controllerName);

                $actionName = array_shift($segments);
                $actionName = 'action' . ucfirst($actionName);

                $parameters = $segments;

                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

                if (file_exists($controllerFile))
                    include_once $controllerFile;

                if (method_exists($controllerName, $actionName))
                {
                    call_user_func_array(array($controllerName, $actionName), $parameters);
                    $isCorrectPage = true;
                    break;
                }
            }
        if (!$isCorrectPage)
           self::error404();
    }



    private function error404()
    {
        header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found");
        header('Status: 404 Not Found');
        require_once(ROOT. '/views/404View.php');
    }
}