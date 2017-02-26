<?php
namespace Indigo\Html\Element;

use Indigo\Html\Element;
use Indigo\View\RenderableProxyInterface;

/**
 * Enables adding any kind of object as a child to HTML element as long as they can be rendered.
 *
 * @package Indigo\Html\Element
 * @author  Danijel Fabijan <danijel.fabijan@bruckom.hr>
 * @link    https://bitbucket.org/bruckom/bwp-core
 */
class Renderable extends Element implements RenderableProxyInterface
{
    /**
     * The object to be rendered.
     *
     * @var mixed
     */
    protected $objectToRender;

    /**
     * The helper to be used to render the object.
     *
     * @var mixed
     */
    protected $helperPlugin;

    /**
     * RenderableWrapper constructor.
     *
     * @param mixed $objectToRender Object to render.
     * @param mixed $helperPlugin   Helper to render the object with.
     */
    public function __construct($objectToRender, $helperPlugin)
    {
        parent::__construct('div');

        $this->objectToRender = $objectToRender;
        $this->helperPlugin = $helperPlugin;
    }

    /**
     * Returns the object for rendering.
     *
     * @return mixed
     */
    public function getObjectToRender()
    {
        return $this->objectToRender;
    }

    /**
     * {@inheritdoc}
     *
     * @return mixed
     */
    public function getHelperPlugin()
    {
        return $this->helperPlugin;
    }
}
