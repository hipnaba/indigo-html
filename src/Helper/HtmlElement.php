<?php
namespace Indigo\Html\Helper;

use Indigo\Html\ElementInterface;
use Indigo\View\Helper\Indent;
use Indigo\View\Helper\RenderObject;
use Indigo\View\HelperPluginAwareInterface;

/**
 * Renders a HTML element.
 *
 * @package Indigo\Html\Helper
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
class HtmlElement extends AbstractHtmlHelper
{
    /**
     * Indent helper.
     *
     * @var Indent
     */
    protected $indent;

    /**
     * RenderObject helper.
     *
     * @var RenderObject
     */
    protected $renderObject;

    /**
     * Returns the Indent helper.
     *
     * @return Indent
     */
    public function getIndentHelper()
    {
        if (null === $this->indent) {
            if ($this->view && method_exists($this->view, 'plugin')) {
                $this->indent = $this->view->plugin('indent');
            } else {
                $this->indent = new Indent();
            }
        }

        return $this->indent;
    }

    /**
     * Returns the RenderObject helper.
     *
     * @return RenderObject
     */
    public function getRenderObjectHelper()
    {
        if (null === $this->renderObject) {
            if ($this->view && method_exists($this->view, 'plugin')) {
                $this->renderObject = $this->view->plugin('renderObject');
            } else {
                $this->renderObject = new RenderObject();
            }
        }
        return $this->renderObject;
    }

    /**
     * Renders a HTML element.
     *
     * @param ElementInterface $element Element to render
     *
     * @return string
     */
    public function render(ElementInterface $element)
    {
        $indent = $this->getIndentHelper();
        $renderObject = $this->getRenderObjectHelper();

        $rendered = $this->openTag($element);
        $content = [];

        if ($element->hasChildren()) {
            foreach ($element->getChildren() as $child) {
                // The element wants to be rendererd by another helper.
                if ($child instanceof HelperPluginAwareInterface) {
                    $content[] = $renderObject->render($child);
                    continue;
                }

                $content[] = $this->render($child);
            }
        }

        if ($element->getContent()) {
            $content[] = $element->getContent();
        }

        $rendered .= count($content) > 1
            // Multiline content
            ? PHP_EOL . $indent(implode(PHP_EOL . PHP_EOL, $content)) . PHP_EOL
            : implode($content);


        if ($this->hasEndTag($element)) {
            $rendered .= sprintf('</%s>', $element->getTag());
        }

        return $rendered;
    }

    /**
     * Renders the opening tag for the given element.
     *
     * @param ElementInterface $element Element to render.
     *
     * @return string
     */
    public function openTag(ElementInterface $element)
    {
        $attributes = $element->getAttributes();
        $attributeString = $this->getAttributeString($attributes);

        return sprintf(
            '<%s%s>',
            $element->getTag(),
            $attributeString ? ' ' . $attributeString : ''
        );
    }
}
