<?php
namespace Indigo\Html\Attribute;

/**
 * Attribute Factory
 *
 * @package Indigo\Html\Attribute
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
class AttributeFactory
{
    /**
     * Attribute implementations by type
     *
     * @var array
     */
    protected $types = [
        'string' => StringAttribute::class,
    ];

    /**
     * Creates a new attribute
     *
     * @param mixed $spec Attribute to create.
     *
     * @return AttributeInterface
     */
    public function create($spec)
    {
        if (is_string($spec)) {
            $spec = [
                'type' => 'string',
                'name' => $spec,
            ];
        }

        if (!isset($spec['type'])) {
            throw new \InvalidArgumentException('Must specify the attribute type');
        }

        if (!isset($spec['name'])) {
            throw new \InvalidArgumentException('Must specify the attribute name');
        }

        $attributeClass = $this->types[$spec['type']] ?: StringAttribute::class;

        if (!class_exists($attributeClass)) {
            throw new \DomainException('Invalid attribute class provided');
        }

        /**
         * The created attribute
         *
         * @var AttributeInterface $attribute
         */
        $options = isset($spec['options']) ? $spec['options'] : [];
        $attribute = new $attributeClass($spec['name'], $options);

        return $attribute;
    }
}
