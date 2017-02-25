<?php
namespace IndigoTest\Html;

use Indigo\Html\Module;
use PHPUnit\Framework\TestCase;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

/**
 * Class ModuleTest
 *
 * @package IndigoTest\Html
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
class ModuleTest extends TestCase
{
    /**
     * Module should define view helpers.
     *
     * @return void
     */
    public function testViewHelperConfig()
    {
        $module = new Module();

        $this->assertInstanceOf(ViewHelperProviderInterface::class, $module);
        $this->assertNotEmpty($module->getViewHelperConfig());
    }
}
