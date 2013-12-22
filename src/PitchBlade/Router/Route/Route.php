<?php
/**
 * This class represents a single route
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Router
 * @subpackage Route
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2012 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Router\Route;

use PitchBlade\Router\Path\Parser;
use PitchBlade\Network\Http\RequestData;

/**
 * This class represents a single route
 *
 * @category   PitchBlade
 * @package    Router
 * @subpackage Route
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Route implements AccessPoint
{
    /**
     * @var string The name of this route
     */
    private $name;

    /**
     * @var PitchBlade\Router\Path\Parser The path of the route
     */
    private $path;

    /**
     * @var callable The callback
     */
    private $callback;

    /**
     * @var array The (optional) requirements of path variables in the route
     */
    private $requirements = [];

    /**
     * @var array The (optional) mapping of path variable in the route
     */
    private $defaults = [];

    /**
     * Creates the instance of the route
     *
     * @param string                        $name     The name of the route
     * @param PitchBlade\Router\Path\Parser $path     The path of the route
     * @param callable                      $callback The callback of the route
     */
    public function __construct($name, Parser $path, callable $callback)
    {
        $this->name     = $name;
        $this->path     = $path;
        $this->callback = $callback;
    }

    /**
     * Adds a regex patterns as requirements for path variables
     *
     * @param array $requirements The regex patterns
     *
     * @return \PitchBlade\Router\Route\AccessPoint Instance of self
     */
    public function wherePattern(array $requirements)
    {
        $this->requirements = $requirements;

        return $this;
    }

    /**
     * Adds default values for path variables
     *
     * @param array $defaults The defaults
     *
     * @return \PitchBlade\Router\Route\AccessPoint Instance of self
     */
    public function defaults(array $defaults)
    {
        $this->defaults = $defaults;

        return $this;
    }

    /**
     * Tries to match the current route against the request
     *
     * @param \PitchBlade\Network\Http\RequestData $request The request data
     *
     * @return boolean True when the route matches the request
     */
    public function matchesRequest(RequestData $request)
    {
        $pathParts = explode('/', trim($request->getPath(), '/'));

        foreach ($this->path->getParts() as $pathPart) {
        }

        return true;
    }
}