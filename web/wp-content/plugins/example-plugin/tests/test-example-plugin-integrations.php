<?php
namespace Example_Plugin;
use Example_Plugin\Loader;

class Example_Plugin_Integration_Tests extends \WP_UnitTestCase
{
    const PLUGIN_INSTALL_DIR = WP_CONTENT_DIR . 'plugins/example-plugin/';
    const PLUGIN_FILE_NAME = 'example-plugin.php';
    const PLUGIN_INCLUDES_DIR = self::PLUGIN_INSTALL_DIR . 'inc/';

    public function testTrue() {
        $this->assertTrue(true);
    }

    public function testClassesExist() {
        $this->assertFileExists( self::PLUGIN_INSTALL_DIR . self::PLUGIN_FILE_NAME );
    }

    public function testPluginHeaderHasMinimumInfo() {
        $file = file(self::PLUGIN_INSTALL_DIR . self::PLUGIN_FILE_NAME );
        $expected_comments = [
            ' * Plugin Name: Example Plugin',
            ' * Version: 0.1'
        ];
        $this->assertArraySubset( $expected_comments, array_slice( array_map( function( $line ) {
            return str_replace( [ "\n", "\r" ], '', $line );
        }, $file ), 2, 2 ), true );
    }

    /**
     * @covers Example_Plugin::loader
     */
    public function testPluginLoaderClass() {
        $this->assertDirectoryExists( self::PLUGIN_INCLUDES_DIR );
        $this->assertFileExists( self::PLUGIN_INCLUDES_DIR . 'loader.php' );

        require_once self::PLUGIN_INCLUDES_DIR . 'loader.php';
        $this->assertTrue( class_exists( '\\Example_Plugin\Loader', true) );

        $loader = (new Loader())->init();
		$this->assertInstanceOf( '\\Example_Plugin\Loader', $loader );

		$this->assertTrue( method_exists( $loader, 'load_files' ));
    }

    public function testAdd() {
        $calculator = (new Loader())->init();
        $this->assertEquals(10, $calculator->add(5,5));
        $this->assertEquals(14, $calculator->add(7,7));
        $this->assertEquals(20, $calculator->add(10,10));
        $this->assertEquals(-5, $calculator->add(5,-10));
        $this->assertEquals(5, $calculator->add(-5,10));
    }

    public function testSubtract() {
        $calculator = (new Loader())->init();
        $this->assertEquals(5, $calculator->subtract(10,5));
        $this->assertEquals(0, $calculator->subtract(5,5));
        $this->assertEquals(-5, $calculator->subtract(5,10));
        $this->assertEquals(5, $calculator->subtract(-5,-10));
        $this->assertEquals(5, $calculator->subtract(7.5,2.5));
    }
}
