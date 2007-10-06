<?php
/**
 * Import users from an htpasswd file to USVN
 *
 * @author Team USVN <contact@usvn.info>
 * @link http://www.usvn.info
 * @license http://www.cecill.info/licences/Licence_CeCILL_V2-en.txt CeCILL V2
 * @copyright Copyright 2007, Team USVN
 * @since 0.5
 * @package admin
 * @subpackage user
 *
 * This software has been written at EPITECH <http://www.epitech.net>
 * EPITECH, European Institute of Technology, Paris - FRANCE -
 * This project has been realised as part of
 * end of studies project.
 *
 * $Id: ImportHtpasswdTest.php 493 2007-05-18 18:29:36Z duponc_j $
 */

// Call USVN_View_Helper_ImgTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "USVN_View_Helper_ImgTest::main");
}

require_once "PHPUnit/Framework/TestCase.php";
require_once "PHPUnit/Framework/TestSuite.php";

require_once 'www/USVN/autoload.php';
require_once 'www/helpers/Img.php';

/**
 * Test class for USVN_View_Helper_Img.
 * Generated by PHPUnit_Util_Skeleton on 2007-04-03 at 09:22:11.
 */
class USVN_View_Helper_ImgTest extends USVN_Test_Test {
    /**
     * Runs the test methods of this class.
     *
     * @access public
     * @static
     */
    public static function main() {
        require_once "PHPUnit/TextUI/TestRunner.php";

        $suite  = new PHPUnit_Framework_TestSuite("USVN_View_Helper_ImgTest");
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function testImg()
    {
        $helper = new USVN_View_Helper_Img();
         $ctrl = Zend_Controller_Front::getInstance();
         $ctrl->setBaseUrl('~/noplay/usvn');
        $this->assertEquals($helper->img('test.png', 'Test'), '<img src="~/noplay/usvn/medias/default/images/test.png" alt="Test" />');
    }
}

// Call USVN_View_Helper_ImgTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "USVN_View_Helper_ImgTest::main") {
    USVN_View_Helper_ImgTest::main();
}
?>
