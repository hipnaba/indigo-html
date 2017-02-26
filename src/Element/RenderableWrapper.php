<?php
namespace Indigo\Html\Element;

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
    protected $element;

    /**
     * The helper to be used to render the object.
     *
     * @var mixed
     */
    protected $helper;

    /**
     * RenderableWrapper constructor.
     *
     * @param mixed $element Object to render.
     * @param mixed $helper  Helper to render the object with.
     */
    public function __construct($element, $helper)
    {
        parent::__construct('div');

        $this->element = $element;
        $this->helper = $helper;
    }

    /**
     * Returns the object to be rendered.
     *
     * @return mixed
     */
    public function getElement()
    {
        return $this->element;
    }

    /**
     * Set the object to be rendered.
     *
     * @param mixed $element The object to be rendered.
     *
     * @return void
     */
    public function setElement($element)
    {
        $this->element = $element;
    }

    /**
     * Returns the helper to be used to render the object.
     *
     * @return mixed
     */
    public function getHelper()
    {
        return $this->helper;
    }

    /**
     * Sets the helper to be used to render the object.
     *
     * @param string $helper The helper.
     *
     * @return void
     */
    public function setHelper($helper)
    {
        $this->helper = $helper;
    }
}
