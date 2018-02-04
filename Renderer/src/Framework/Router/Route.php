<?php

namespace Framework\Router;
/**
 * Class Route
 * @package Framework\Router
 */
class Route
{
    private $name;
    private $parameters;
    private $callback;

    public function __construct(string $name, callable $callback, array $parameters)
    {
        $this->callback = $callback;
        $this->name = $name;
        $this->parameters = $parameters;
    }

    public function getName():?string
    {
        return $this->name;

    }

    /**
     * @return callable
     */
    public function getCallback(): callable
    {
        return $this->callback;
    }

    /**
     * @return String[]
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }
}