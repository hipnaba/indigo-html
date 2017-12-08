<?php
namespace IndigoTest\Html\Attribute;

use Indigo\Html\Attribute\AttributeFactory;
use Indigo\Html\Attribute\AttributeInterface;
use Indigo\Html\Attribute\StringAttribute;
use Indigo\Html\Element;
use Indigo\Html\Exception\InvalidAttributeNameException;
use PHPUnit\Framework\TestCase;

/**
 * Class AttributeFactoryTest
 *
 * @package IndigoTest\Html\Attribute
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
class AttributeFactoryTest extends TestCase
{
    /**
     * If no attribute type specified, the factory will create a StringAttribute
     *
     * @return void
     */
    public function testDefaultTypeIsString()
    {
        $factory = new AttributeFactory();

        $attribute = $factory->create([
            'name' => 'id',
        ]);

        $this->assertInstanceOf(StringAttribute::class, $attribute);
    }

    /**
     * The factory will throw an exception if no name provided.
     *
     * @return void
     *
     * @expectedException \InvalidArgumentException
     */
    public function testWillThrowExceptionIfNoNameProvided()
    {
        $factory = new AttributeFactory();

        $factory->create([]);
    }

    /**
     * The factory will throw an exception for invalid attribute name.
     *
     * @return void
     *
     * @expectedException \Indigo\Html\Exception\InvalidAttributeNameException
     */
    public function testWillThrowExceptionForInvalidAttributeName()
    {
        $factory = new AttributeFactory();

        $factory->create('invalid');
    }

	/**
	 * @expectedException \Indigo\Html\Exception\InvalidAttributeNameException
	 */
    public function testWillThrowExceptionContainingInvalidAttributeName()
    {
	    $factory = new AttributeFactory();

	    try {
	    	$factory->create('invalid-attribute-name');
	    } catch (InvalidAttributeNameException $e) {
	    	$this->assertContains('invalid-attribute-name', $e->getMessage());
	    	throw $e;
	    }
    }

    /**
     * The factory will create data- and aria- attributes.
     *
     * @return void
     */
    public function testCanCreateDataAndAriaAttributes()
    {
        $factory = new AttributeFactory();

        $data = $factory->create('data-options');
        $aria = $factory->create('aria-labeledby');

        $this->assertInstanceOf(AttributeInterface::class, $data);
        $this->assertInstanceOf(AttributeInterface::class, $aria);
    }

    /**
     * The factory will validate against the provided elements attribute list.
     *
     * @return void
     */
    public function testCanCreateTagSpecificAttributes()
    {
        $factory = new AttributeFactory();
        $element = new Element('base');

        $attribute = $factory->create('href', $element);

        $this->assertNotNull($attribute);
    }

    /**
     * The factory can create <img> elements.
     *
     * @return void
     */
    public function testCanCreateImgTagAttributes()
    {
        $factory = new AttributeFactory();
        $element = new Element('img');

        $attribute = $factory->create('src', $element);

        $this->assertNotNull($attribute);
    }
}
