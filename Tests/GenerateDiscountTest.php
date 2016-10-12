<?php
/**
 * Created by PhpStorm.
 * User: akf-sebastianrasch
 * Date: 16.09.16
 * Time: 15:26
 */

namespace AGAN\Api;
require_once __DIR__ . '/../Classes/GenerateDiscount.php';

/**
 * Class GenerateDiscountTest
 *
 * for all tests set private methods to public
 *
 * @package AGAN\Api
 */
class GenerateDiscountTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var
     */
    public $_startTest;


    /**
     * setup
     */
    public function setUp()
    {
        $this->_startTest = new GenerateDiscount();
    }


    /**
     * test generated code
     */
    public function testCodePattern ()
    {
        $code = $this->_startTest->generateCode();

        $this->assertRegExp('/^[a-zA-Z0-9_-]{3,16}$/', $code);
    }


    /**
     * test api connection
     */
    public function testConnection()
    {
        $api = $this->_startTest->connectApi();

        $this->assertInternalType('object', $api);
    }


}
