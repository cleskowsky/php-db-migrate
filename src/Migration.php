<?php

/**
 * Implemented by migrations
 */
interface Migration {
    /**
     *
     */
    function up();
    
    /**
     * 
     */
    function down();
}

?>