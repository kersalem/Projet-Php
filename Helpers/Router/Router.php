<?php


namespace App\Helpers\Router;


use App\Helpers\Controller\ErrorController;
use ReflectionException;

class Router
{
    const UNKNOWN_ROUTE_ERROR = "Cette route n'existe pas";
    const UNKNOWN_PARAMETER_ERROR = "Le parametre n'a pas été trouvé";
    /**
     * @var array $routes
     */

    private $routes;
    /**
     * @var ErrorController
     */
    private $errorController;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        // On récupère la liste de routes depuis le fichier routes.yml
        $this->routes = yaml_parse_file(__DIR__.'/../../Conf/routes.yml');
        // On implemente le controller qui permet de gerer les erreurs
        $this->errorController = new ErrorController();
    }

    /**
     * Permet de rediriger vers une route
     * @param string $routeName nom de la route
     * @param array  $params    parametres de la route
     */
    public function redirectToRoute(string $routeName, array $params = [])
    {
        try {
            // Dans le cas ou le nom de la route ne se trouve pas dans routes.yml (et donc que la route n'existe pas,
            // on jette une nouvelle erreur
            if(!isset($this->routes[$routeName])) {throw new \Exception(self::UNKNOWN_ROUTE_ERROR);}
            // On redirige vers la route, récupéré a partir du nom de route dans le fichier routes.yml
            header("location: ".$this->routes[$routeName]['path'].($params !== [] ? $this->setParametersInQuery($params) : "" ));
        // Si l'on attrape une nouvelle exception, on l'affiche dans les log et on renvoie vers la page d'accueil
        } catch (\Exception $e) {
            error_log($e->getMessage()."\n".$e->getTraceAsString());
            header("location: /");
        }
    }

    /**
     * Permet de diriger vers une action à partir de l'url de la page
     * @param string $request url
     * @param array  $GETParams parametre récupérés a partir de la variable _GET
     *
     * @throws ReflectionException
     */
    public function handleRequest(string $request, array $GETParams)
    {
        // On découpe l'url en deux: la partie chemin, et la partie parametres (qui sont séparées par un ?)
        $requestArr = explode("?", $request);
        // On récupere la partie chemin
        $routePath = $requestArr[0];
        // Variable permettant de savoir si la route existe
        $routeExist = false;
        // On parcour toutes les routes de routes.yml
        foreach ($this->routes as $route) {
            // Si le chemin de l'url récupéré en parametre est égal au chemin de la route de routes.yml...
            if ($route['path'] === $routePath && !$routeExist) {
                // On créé une nouvelle instance du controller récupéré dans routes.yml
                $controller = new $route['controller']();
                // On créé une nouvelle instance de reflection method en lui donnant en parametre la methode définie dans routes.yml
                $reflectionMethod = new \ReflectionMethod($controller, $route['action']);
                // On stock les parametres récupérés par getParametersArray dans un tableau
                $parameters = $this->getParametersArray($reflectionMethod->getParameters(), $GETParams);
                // On appelle la methode définie dans routes.yml, en lui donnant les parametres récupérés ci-dessus
                call_user_func_array([$controller, $route['action']], $parameters);
                // La route existe
                $routeExist = true;
            }
        }
        if (!$routeExist) {
            $this->errorController->error404();
        }
    }

    /**
     * Cette methode permet de renvoyer sous forme de chaine de caractère une url à partir d'un nom de route et de paramètres
     * Elle sera utilisé dans les template afin de générer des url de manière automatique. Si l'on change l'attribut 'path' de la route
     * dans le fichier routes.yml, le lien changera lui aussi automatiquement
     * @param string $routeName nom de la route
     * @param array  $params parametres qui seront généré dans la requete en methode GET
     *
     * @return string
     */
    public function path(string $routeName, array $params = []): string
    {
        try {
            // Si la route n'existe pas, on jette une exception
            if(!isset($this->routes[$routeName])) {throw new \Exception(self::UNKNOWN_ROUTE_ERROR);}
            // On retourne le chemin de la route, suivi des parametres en GET s'il y en a
            return $this->routes[$routeName]['path'] . ($params !== [] ? $this->setParametersInQuery($params) : "" );
        // Si l'on attrape une exception, alors on la log et on retourne #. Ainsi les liens ayant utilisé une route inexistante seront inactifs
        } catch (\Exception $e) {
            error_log($e->getMessage()."\n".$e->getTraceAsString());
            return "#";
        }
    }

    /**
     * Methode permettant de formatter un tableau de parametres pour les mettre dans une requete avec
     * le format GET
     * @param array $params les parametres à mettre dans la requete
     *
     * @return string
     */
    private function setParametersInQuery(array $params): string
    {
        // La chaine de caractère commence par ? pour que les parametres soit détectés comme des parametres GET
        $query = "?";
        // On rassemble tous les parametres par des & pour qu'ils soient compris comme des parametres différents
        $query .= implode("&", array_map(function ($param, $value) {
            // On rassemble la clé et la valeur de chaque parametre par un = pour correspondre au format GET
            return $param . "=" . $value;
        }, array_keys($params), $params));
        // On retourne la requete
        return $query;
    }

    /**
     * Cette methode permet de renvoyer un tableau contenant les parametres qu'attend une action
     * et dans le sens dans lequel elles les attends depuis la variable _GET
     * @param array $methodParameters liste des parametres qu'attend l'action
     * @param array $GETParams parametres _GET
     *
     * @return array
     */
    private function getParametersArray(array $methodParameters, array $GETParams): array
    {
        $parameterArray = [];
        // Pour chaque parametre de la liste
        foreach ($methodParameters as $method_parameter) {
            try {
                // Si on ne trouve pas ce parametre dans la variable _GET, on jette une exception
                if (!isset($GETParams[$method_parameter->getName()])) {
                    throw new \Exception(self::UNKNOWN_PARAMETER_ERROR);
                }
                // On récupère le parametre de la variable _GET en récupérant le nom du parametre
                $parameterArray[] = $GETParams[$method_parameter->getName()];
            // Si l'on attrape une exception, on la log
            } catch (\Exception $e) {
                error_log($e->getMessage()."\n".$e->getTraceAsString());
            }
        }
        // On retourne le tableau de parametres
        return $parameterArray;
    }
}