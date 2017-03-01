<?php
namespace Indigo\Html\Helper;

use Indigo\Html\Attribute\AttributeInterface;
use Indigo\Html\ElementInterface;
use Indigo\Html\ViewHelpers;
use Indigo\View\Helper\AbstractHelper as BaseAbstractHelper;
use Zend\View\Helper\EscapeHtml;
use Zend\View\Helper\EscapeHtmlAttr;
use Zend\View\Renderer\PhpRenderer;

/**
 * Abstract Element Helper
 *
 * @package Indigo\Html\Helper
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 *
 * @method PhpRenderer|ViewHelpers getView()
 */
abstract class AbstractHtmlHelper extends BaseAbstractHelper
{
    /**
     * All HTML tags that don't have an end tag
     *
     * @see https://developer.mozilla.org/en/docs/Web/HTML/Element
     */
    const NO_END_TAG = [
        // Document metadata
        'base',
        'link',
        'meta',
        // Text content
        'hr',
        // Inline text semantics
        'br',
        'wbr',
        // Image and multimedia
        'area',
        'img',
        'track',
        // Embedded content
        'embed',
        'param',
        'source',
        // Table content
        'col',
        // Forms
        'input',
        // Interactive elements
        'menuitem',
    ];

    /**
     * HTML escaper.
     *
     * @var EscapeHtml
     */
    protected $escapeHtml;

    /**
     * Escaper za atribute.
     *
     * @var EscapeHtmlAttr
     */
    protected $escapeHtmlAttr;

    /**
     * Vraća HTML escaper.
     *
     * @return EscapeHtml
     */
    protected function getEscapeHtmlHelper()
    {
        if (null === $this->escapeHtml) {
            if (method_exists($this->view, 'plugin')) {
                $this->escapeHtml = $this->view->plugin('escapeHtml');
            } else {
                $this->escapeHtml = new EscapeHtml();
            }
        }

        return $this->escapeHtml;
    }

    /**
     * Vraća escaper za atribute.
     *
     * @return EscapeHtmlAttr
     */
    protected function getEscapeHtmlAttrHelper()
    {
        if (null === $this->escapeHtmlAttr) {
            if (method_exists($this->view, 'plugin')) {
                $this->escapeHtmlAttr = $this->view->plugin('escapeHtmlAttr');
            } else {
                $this->escapeHtmlAttr = new EscapeHtmlAttr();
            }
        }

        return $this->escapeHtmlAttr;
    }

    /**
     * Renders an Indigo Element.
     *
     * If no element is passed, returns itself. Can be used to configure
     * the helper before calling `render`.
     *
     * @param ElementInterface|null $element Element to render
     *
     * @return AbstractHtmlHelper|string
     */
    public function __invoke(ElementInterface $element = null)
    {
        if (null === $element) {
            return $this;
        }

        return $this->render($element);
    }

    /**
     * Returns the element's HTML.
     *
     * @param ElementInterface $element Element to render
     *
     * @return string
     */
    abstract public function render(ElementInterface $element);

    /**
     * Renders the HTML attributes string.
     *
     * @param AttributeInterface[] $attributes Attributes to render
     *
     * @return string
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    protected function getAttributeString($attributes)
    {
        if (0 === count($attributes)) {
            return '';
        }

        $escapeHtml = $this->getEscapeHtmlHelper();
        $escapeHtmlAttr = $this->getEscapeHtmlAttrHelper();

        $rendered = [];

        foreach ($attributes as $attribute) {
            $name = $escapeHtml($attribute->getName());
            $value = $escapeHtmlAttr($attribute->getValue());

            $rendered[] = sprintf('%s="%s"', $name, $value);
        }

        return implode(' ', $rendered);
    }

    /**
     * Returns true if a given element in fact has an end tag.
     *
     * @param ElementInterface $element Element to check
     *
     * @return bool
     */
    protected function hasEndTag(ElementInterface $element)
    {
        $tag = $element->getTag();
        return !in_array($tag, self::NO_END_TAG);
    }
}
