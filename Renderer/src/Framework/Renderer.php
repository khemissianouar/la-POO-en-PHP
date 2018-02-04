<?php
/**
 * Created by PhpStorm.
 * User: lanewris
 * Date: 02/02/18
 * Time: 22:36
 */

namespace Framework;
class Renderer
{
    const DEFAULT_NAMESPACE = '__MAIN';
    private $paths = [];
    /**Variables globalement accerssibles pour toute les vues
     * @var array
     */
    private $globals =[];

    /**
     * permet de rajoouteer un chamin pour charger la vue
     * @param $namespace
     * @param null|string $path
     */

    public function addPath($namespace, ?string $path = null)
    {
        if (is_null($path)) {
            $this->paths[self::DEFAULT_NAMESPACE] = $namespace;
        } else $this->paths[$namespace] = $path;


    }

    /**
     * Permet de rendre une vue
     * la chemin peur etre précisé avec des namespace rajouté via addPath()
     * $this->render('view')
     * $this->render('@blog/view')
     * @param string $view
     * @param array $params
     * @return string
     */

    public function render(string $view,array $params=[]): string
    {
        if ($this->hasNamespace($view)) {
            $path = $this->replaceNamespace($view) . '.php';

        } else {
            $path = $this->paths[self::DEFAULT_NAMESPACE] . DIRECTORY_SEPARATOR . $view . '.php';
        }
        ob_start();
        $rendere =$this;
        extract($this->globals);
        extract($params);
        require($path);
        return ob_get_clean();


    }

    /**
     * Permet de rajouter des variables globales à toutes les vues
     * @param string $key
     * @param mixed $value
     */
    public function addGlobal(string $key,$value):void{
        $this->globals[$key]=$value;

    }

    private function hasNamespace(string $view): bool
    {
        return $view[0] === '@';
    }

    private function getNamespace(string $view): string
    {
        return substr($view, 1, strpos($view, '/') - 1);
    }

    private function replaceNamespace(string $view): string
    {
        $namespace = $this->getNamespace($view);
        return str_replace('@' . $namespace, $this->paths[$namespace], $view);

    }
}