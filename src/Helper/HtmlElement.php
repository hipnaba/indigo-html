<?php
namespace Indigo\Html\Helper;

use Indigo\Html\ElementInterface;

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
     * Renders a HTML element.
     *
     * @param ElementInterface $element Element to render
     *
     * @return string
     */
    public function render(ElementInterface $element)
    {
        $indent = $this->getIndentHelper();

        $rendered = $this->openTag($element);
        $content = [];

        if ($element->hasChildren()) {
            foreach ($element->getChildren() as $child) {
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
