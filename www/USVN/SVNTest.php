<?php
/**
 * Manipulate subversion of a project
 *
 * @author Team USVN <contact@usvn.info>
 * @link http://www.usvn.info
 * @license http://www.cecill.info/licences/Licence_CeCILL_V2-en.txt CeCILL V2
 * @copyright Copyright 2007, Team USVN
 * @since 0.5
 * @package svn
 *
 * This software has been written at EPITECH <http://www.epitech.net>
 * EPITECH, European Institute of Technology, Paris - FRANCE -
 * This project has been realised as part of
 * end of studies project.
 *
 * $Id: SVN.php 386 2007-05-10 13:33:26Z billar_m $
 */
// Call USVN_SVNTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "USVN_SVNTest::main");
}

require_once "PHPUnit/Framework/TestCase.php";
require_once "PHPUnit/Framework/TestSuite.php";

require_once 'www/USVN/autoload.php';

/**
 * Test class for USVN_SVN.
 * Generated by PHPUnit_Util_Skeleton on 2007-03-10 at 17:59:54.
 */
class USVN_SVNTest extends USVN_Test_DB {
    /**
     * Runs the test methods of this class.
     *
     * @access public
     * @static
     */
    public static function main() {
        require_once "PHPUnit/TextUI/TestRunner.php";

        $suite  = new PHPUnit_Framework_TestSuite("USVN_SVNTest");
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function setUp()
    {
		parent::setUp();
        $table = new USVN_Db_Table_Projects();
		$obj = $table->fetchNew();
		$obj->setFromArray(array('projects_name' => 'test',  'projects_start_date' => '1984-12-03 00:00:00'));
		$obj->save();
    }

	public function test_listFile()
	{
        USVN_SVNUtils::checkoutSvn('tests/tmp/svn/test', 'tests/tmp/out');
        $path = getcwd();
        chdir('tests/tmp/out');
        mkdir('trunk/testdir');
        `svn add trunk/testdir`;
        touch('trunk/testfile');
        `svn add trunk/testfile`;
        `svn commit --non-interactive -m Test`;
        chdir($path);
        $svn = new USVN_SVN('test');
        $res = $svn->listFile('/');
		$this->assertEquals(3, count($res));
		$this->assertContains(array("name" => "trunk", "isDirectory" => true, "path" => "/trunk/"), $res);
		$this->assertContains(array("name" => "branches", "isDirectory" => true, "path" => "/branches/"), $res);
		$this->assertContains(array("name" => "tags", "isDirectory" => true, "path" => "/tags/"), $res);
        $res = $svn->listFile('/trunk');
		$this->assertEquals(2, count($res));
		$this->assertContains(array("name" => "testdir", "isDirectory" => true, "path" => "/trunk/testdir/"), $res);
		$this->assertContains(array("name" => "testfile", "isDirectory" => false, "path" => "/trunk/testfile"), $res);
	}

	public function test_listFileBadProject()
	{
        try {
            $svn = new USVN_SVN('fake');
        }
        catch (USVN_Exception $e) {
            return;
        }
        $this->fail();
	}
}

// Call USVN_SVNTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "USVN_SVNTest::main") {
    USVN_SVNTest::main();
}
?>
