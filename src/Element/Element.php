<?php
namespace Indigo\Html\Element;

use Indigo\Html\Attribute\AttributeAwareTrait;
use Indigo\Html\Attribute\CssClassAwareTrait;
use Indigo\Html\Exception;
use Zend\Stdlib\ArrayObject;

/**
 * A HTML Element.
 *
 * @package Indigo\Html
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
class Element implements ElementInterface
{
    use AttributeAwareTrait;
    use CssClassAwareTrait;

    /**
     * Element tag name.
     *
     * @var string
     */
    protected $tag;

    /**
     * Element content.
     *
     * @var string
     */
    protected $content;

    /**
     * Child elements.
     *
     * @var ElementInterface[]
     */
    protected $children;

    /**
     * Element constructor.
     *
     * @param string $tag        The element's tag name
     * @param array  $attributes The element's attributes
     */
    public function __construct($tag, array $attributes = [])
    {
        $this->children = new ArrayObject();

        $this->setTag($tag);
        $this->setAttributes($attributes);
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * {@inheritdoc}
     *
     * @param string $tag New tag name
     *
     * @return void
     */
    public function setTag($tag)
    {
        $tag = strtolower($tag);

        if (!in_array($tag, self::TAG_NAMES)) {
            throw new Exception\InvalidTagNameException(
                sprintf("%s is not a valid HTML tag name", $tag)
            );
        }

        $this->tag = $tag;
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * {@inheritdoc}
     *
     * @param string $content New content for the element
     *
     * @return void
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * {@inheritdoc}
     *
     * @return ElementInterface[]
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * {@inheritdoc}
     *
     * @param ElementInterface $element Element to append to this one
     *
     * @return void
     */
    public function append(ElementInterface $element)
    {
        $this->children[] = $element;
    }

    /**
     * {@inheritdoc}
     *
     * @return integer
     */
    public function count()
    {
        return count($this->children);
    }

    /**
     * {@inheritdoc}
     *
     * @return ElementInterface[]
     */
    public function getIterator()
    {
        return $this->children;
    }
}
