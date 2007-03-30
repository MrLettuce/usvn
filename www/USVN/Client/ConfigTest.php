<?php
/**
 * Manipulate client config file
 *
 * @author Team USVN <contact@usvn.info>
 * @link http://www.usvn.info
 * @license http://www.cecill.info/licences/Licence_CeCILL_V2-en.txt CeCILL V2
 * @copyright Copyright 2007, Team USVN
 * @since 0.5
 * @package client
 * @subpackage console
 *
 * This software has been written at EPITECH <http://www.epitech.net>
 * EPITECH, European Institute of Technology, Paris - FRANCE -
 * This project has been realised as part of
 * end of studies project.
 *
 * $Id$
 */
// Call USVN_Client_ConfigTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "USVN_Client_ConfigTest::main");
}

require_once "PHPUnit/Framework/TestCase.php";
require_once "PHPUnit/Framework/TestSuite.php";

require_once 'www/USVN/autoload.php';

/**
 * Test class for USVN_Client_Config.
 * Generated by PHPUnit_Util_Skeleton on 2007-03-10 at 18:05:46.
 */
class USVN_Client_ConfigTest extends PHPUnit_Framework_TestCase {
    /**
     * Runs the test methods of this class.
     *
     * @access public
     * @static
     */
    public static function main() {
        require_once "PHPUnit/TextUI/TestRunner.php";

        $suite  = new PHPUnit_Framework_TestSuite("USVN_Client_ConfigTest");
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function setUp()
    {
        $this->clean();
        @mkdir('tests/tmp/testrepository');
        @mkdir('tests/tmp/testrepository/usvn');
    }

    public function tearDown()
    {
        $this->clean();
    }

    private function clean()
    {
        USVN_DirectoryUtils::removeDirectory("tests/tmp/testrepository");
    }

    public function test_creationFichier()
    {
        $config = new USVN_Client_Config('tests/tmp/testrepository');
        $config->save();
        $this->assertTrue(file_exists('tests/tmp/testrepository/usvn/config.xml'));
    }

    public function test_chargementFichier()
    {
        $xml = new SimpleXMLElement("<usvn><url>http://www.usvn.fr</url></usvn>");
        file_put_contents('tests/tmp/testrepository/usvn/config.xml', $xml->asXml());

        $config = new USVN_Client_Config('tests/tmp/testrepository');
        $this->assertEquals('http://www.usvn.fr', $config->url);
    }

    public function test_creationVariable()
    {
        $config = new USVN_Client_Config('tests/tmp/testrepository');
        $config->url = 'http://www.usvn.fr';
        $config->save();

        $config2 = new USVN_Client_Config('tests/tmp/testrepository');
        $this->assertEquals('http://www.usvn.fr', $config2->url);
    }
}

// Call USVN_Client_ConfigTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "USVN_Client_ConfigTest::main") {
    USVN_Client_ConfigTest::main();
}
?>