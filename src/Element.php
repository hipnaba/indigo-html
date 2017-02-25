<?php
namespace Indigo\Html;

use Zend\Stdlib\ArrayObject;

/**
 * A HTML Element.
 *
 * @package Indigo\Html
 */
class Element implements ElementInterface
{
    /** @var string */
    protected $tag;
    /** @var array */
    protected $attributes = [];
    /** @var string */
    protected $content;
    /** @var ElementInterface[] */
    protected $children;

    /**
     * Element constructor.
     *
     * @param string $tag
     * @param array $attributes
     */
    public function __construct($tag, array $attributes = [])
    {
        $this->setTag($tag);
        $this->setAttributes($attributes);

        $this->children = new ArrayObject();
    }

    /**
     * {@inheritdoc}
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * {@inheritdoc}
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
     */
    public function hasAttribute($name)
    {
        return array_key_exists($name, $this->attributes);
    }

    /**
     * {@inheritdoc}
     */
    public function getAttribute($name)
    {
        if (isset($this->attributes[$name])) {
            return $this->attributes[$name];
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function setAttribute($name, $value)
    {
        $tag = $this->getTag();

        if (0 === strpos($name, 'data-')) {
            $attribute = ['type' => 'mixed'];
        } else if (0 === strpos($name, 'aria-')) {
            $attribute = ['type' => 'aria'];
        } else if (array_key_exists($tag, self::TAG_ATTRIBUTES) && in_array($name, self::TAG_ATTRIBUTES[$tag])) {
            $attribute = ['type' => 'string'];
        } else if (array_key_exists($tag, self::TAG_ATTRIBUTES) && array_key_exists($name, self::TAG_ATTRIBUTES[$tag])) {
            $attribute = self::TAG_ATTRIBUTES[$tag][$name];
        } else if (in_array($name, self::GLOBAL_ATTRIBUTES)) {
            $attribute = ['type' => 'string'];
        } else if (array_key_exists($name, self::GLOBAL_ATTRIBUTES)) {
            $attribute = self::GLOBAL_ATTRIBUTES[$name];
        }

        if (!isset($attribute)) {
            throw new Exception\InvalidAttributeNameException(
                sprintf("%s is not a valid HTML attribute", $name)
            );
        }

        switch ($attribute['type']) {
            case 'boolean':
                if ($value) {
                    $value = $name;
                } else {
                    $this->removeAttribute($name);
                    return;
                }
                break;
            case 'integer':
                if (!is_numeric($value)) {
                    throw new Exception\InvalidAttributeValueException(
                        sprintf("Invalid attribute value for '%s', must be integer", $name)
                    );
                }

                $value = intval($value);
                break;
            case 'enum':
                if (isset($attribute['convert']) && isset($attribute['convert'][$value])) {
                    $value = $attribute['convert'][$value];
                }

                if (!in_array($value, $attribute['values'])) {
                    throw new Exception\InvalidAttributeValueException(
                        sprintf("Invalid attribute value for '%s', can only be one of %s", $name, implode(', ', array_filter($attribute['values'])))
                    );
                }
                break;
            case 'list':
                if (is_array($value)) {
                    $separator = isset($attribute['separator']) ? $attribute['separator'] : ' ';
                    $value = implode($separator, $value);
                }
                break;
            case 'string':
            default:
                $value = (string) $value;
        }

        $this->attributes[$name] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * {@inheritdoc}
     */
    public function setAttributes(array $attributes)
    {
        foreach ($attributes as $name => $value) {
            $this->setAttribute($name, $value);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAttribute($name)
    {
        unset($this->attributes[$name]);
    }

    /**
     * {@inheritdoc}
     */
    public function removeAttributes(array $names)
    {
        foreach ($names as $name) {
            $this->removeAttribute($name);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearAttributes()
    {
        $this->attributes = [];
    }

    /**
     * {@inheritdoc}
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * {@inheritdoc}
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * {@inheritdoc}
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * {@inheritdoc}
     */
    public function append(ElementInterface $element)
    {
        $this->children[] = $element;
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->children);
    }

    /**
     * @return ElementInterface[]
     */
    public function getIterator()
    {
        return $this->children;
    }
}