<?php
namespace Indigo\Html\Helper;

use Indigo\Html\ElementInterface;
use Indigo\View\Helper\Renderable;
use Indigo\View\RenderableInterface;

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
     * Renderable helper.
     *
     * @var Renderable
     */
    protected $renderable;

    /**
     * Returns the Renderable helper.
     *
     * @return Renderable
     */
    public function getRenderableHelper()
    {
        if (null === $this->renderable) {
            if ($this->view && method_exists($this->view, 'plugin')) {
                $this->renderable = $this->view->plugin('renderable');
            } else {
                $this->renderable = new Renderable();
            }
        }
        return $this->renderable;
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
        $rendered = $this->openTag($element);
        $content = '';

        if ($element->hasChildren()) {
            $content .= PHP_EOL;

            foreach ($element->getChildren() as $child) {
                if ($child instanceof RenderableInterface) {
                    $renderable = $this->getRenderableHelper();
                    $content .= '    ' . $renderable->render($child) . PHP_EOL;
                    continue;
                }

                $content .= '    ' . $this->render($child) . PHP_EOL;
            }
        }

        if ($this->hasEndTag($element)) {
            $rendered .= $content ?: $element->getContent();
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
