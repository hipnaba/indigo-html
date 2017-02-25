<?php
namespace Indigo\Html\Element;

use Indigo\Html\Exception;
use Zend\Stdlib\ArrayObject;
use Zend\Stdlib\ArrayUtils;

/**
 * A HTML Element.
 *
 * @package Indigo\Html
 */
class Element implements ElementInterface
{
    /**
     * Element tag name.
     *
     * @var string
     */
    protected $tag;

    /**
     * Element attributes.
     *
     * @var array
     */
    protected $attributes = [];

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
     * Returns all attribute data for this tag.
     *
     * @param null $attribute
     * @return array
     */
    protected function getAttributeMetadata($attribute = null)
    {
        $attributes = static::GLOBAL_ATTRIBUTES;

        if (array_key_exists($this->tag, static::TAG_ATTRIBUTES)) {
            $attributes = ArrayUtils::merge($attributes, static::TAG_ATTRIBUTES[$this->tag]);
        }

        if (null === $attribute) {
            return $attributes;
        }

        if (preg_match('/(data|aria)-.+/', $attribute)) {
            return ['type' => 'mixed'];
        } elseif (array_key_exists($attribute, $attributes)) {
            return $attributes[$attribute];
        } elseif (in_array($attribute, $attributes)) {
            return ['type' => 'string'];
        }

        throw new Exception\InvalidAttributeNameException(
            sprintf("%s is not a valid HTML attribute", $attribute)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function hasAttribute($name)
    {
        $attributes = $this->getAttributeMetadata();

        return
            in_array($name, $attributes) ||
            array_key_exists($name, $attributes) ||
            array_key_exists($name, $this->attributes);
    }

    /**
     * {@inheritdoc}
     */
    public function getAttribute($name)
    {
        $attribute = $this->getAttributeMetadata($name);

        switch ($attribute['type']) {
            case 'boolean':
                return array_key_exists($name, $this->attributes);
            case 'string':
            default:
                return array_key_exists($name, $this->attributes) ? $this->attributes[$name] : null;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setAttribute($name, $value)
    {
        $attribute = $this->getAttributeMetadata($name);

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
                break;
            case 'enum':
                if (isset($attribute['convert']) && isset($attribute['convert'][$value])) {
                    $value = $attribute['convert'][$value];
                }

                if (!in_array($value, $attribute['values'])) {
                    throw new Exception\InvalidAttributeValueException(sprintf(
                        "Invalid attribute value for '%s', can only be one of %s",
                        $name,
                        implode(', ', array_filter($attribute['values']))
                    ));
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
