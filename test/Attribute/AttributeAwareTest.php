<?php
namespace IndigoTest\Html\Attribute;

use Indigo\Html\Attribute\AttributeAwareInterface;
use Indigo\Html\Attribute\AttributeAwareTrait;
use PHPUnit\Framework\TestCase;

/**
 * Class AttributeAwareTest
 *
 * @package IndigoTest\Html\Attribute
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
class AttributeAwareTest extends TestCase
{
    /**
     * Trait implementation under test.
     *
     * @var AttributeAwareInterface
     */
    protected $subject;

    /**
     * Sets up the trait under test.
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();

        $this->subject = $this->getObjectForTrait(AttributeAwareTrait::class);
    }

    /**
     * Common API.
     *
     * @return void
     */
    public function testCommonApi()
    {
        $trait = $this->subject;

        $this->assertFalse($trait->hasAttribute('id'));
        $this->assertNull($trait->getAttribute('id'));

        $trait->setAttribute('id', 'new id');

        $this->assertTrue($trait->hasAttribute('id'));
        $this->assertEquals('new id', $trait->getAttribute('id'));

        $trait->setAttributes([
            'class' => 'some-class'
        ]);

        $attributes = $trait->getAttributes();

        $this->assertCount(2, $attributes);
        $this->assertArrayHasKey('id', $attributes);
        $this->assertEquals('new id', $attributes['id']);
        $this->assertArrayHasKey('class', $attributes);
        $this->assertEquals('some-class', $attributes['class']);

        $trait->replaceAttributes([
            'lang' => 'hr',
        ]);

        $attributes = $trait->getAttributes();

        $this->assertCount(1, $attributes);
        $this->assertArrayHasKey('lang', $attributes);
        $this->assertEquals('hr', $attributes['lang']);

        $trait->replaceAttributes([
            'class' => 'some-class',
            'id' => 'some-id',
            'lang' => 'some-lang',
        ]);

        $trait->removeAttributes(['class', 'id']);

        $attributes = $trait->getAttributes();

        $this->assertCount(1, $attributes);
        $this->assertArrayNotHasKey('class', $attributes);
        $this->assertArrayNotHasKey('id', $attributes);
    }
}
