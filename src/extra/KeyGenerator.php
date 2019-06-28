<?php

namespace BCNL\extra;

/**
 * Description of KeyGenerator
 *
 * @author Administrator
 */
class KeyGenerator {

    private static $instance;

    /**
     * Get the Key_generator singleton
     *
     * @static
     * @return	object
     */
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct() {
        ;
    }

    /**
     * 
     * @param int $license_year
     * @param string $license_name
     * @return string
     */
    public function makeString(): string {
        return "yes";
    }

}
