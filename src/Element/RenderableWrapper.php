<?php
namespace Indigo\Html\Element;

use Indigo\Html\Element;
use Indigo\View\RenderableInterface;

/**
 * Enables adding any kind of object to HTML element as long as they can be rendered.
 *
 * @package Indigo\Html\Element
 * @author  Danijel Fabijan <danijel.fabijan@bruckom.hr>
 * @link    https://bitbucket.org/bruckom/bwp-core
 */
class RenderableWrapper extends Element implements RenderableInterface
{
    /**
     * The object to be rendered.
     *
     * @var mixed
     */
    protected $object;

    /**
     * The helper to be used to render the object.
     *
     * @var mixed
     */
    protected $helperPlugin;

    /**
     * RenderableWrapper constructor.
     *
     * @param mixed $object Object to render.
     * @param mixed $helper Helper to render the object with.
     */
    public function __construct($object, $helper)
    {
        parent::__construct('div');

        $this->object = $object;
        $this->helperPlugin = $helper;
    }

    /**
     * Returns the object to be rendered.
     *
     * @return mixed
     */
    public function getObject()
    {
        return $this->object;
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
