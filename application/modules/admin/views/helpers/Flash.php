<?php
/** 
 *  @version ##VERSION##
 *  @package ##PACKAGE##
 *  @filesource
 */

/**
 * Description of Flash helper
 * @package ##PACKAGE##
 * @author prskavecl
 */
class Zend_View_Helper_Flash
{
    /**
     * Flash Messager
     * @param array $messages
     * @return string HTML
     */
    public function flash($messages)
    {
        $str = "";
        if (count($messages)!=0) {
            $str = "<div class='flash'>".$messages[0]."</div>";
        }
        return $str;
    }
}