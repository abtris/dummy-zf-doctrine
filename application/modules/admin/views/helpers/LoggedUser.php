<?php
/**
 * @package ##PACKAGE##
 * @version ##VERSION##
 * @filesource
 */
/**
 * BaseUrl helper
 * @package ##PACKAGE##
 */
class Zend_View_Helper_LoggedUser
{
    /**
     * Print logged user
     * @return string
     */
    public function loggedUser ()
    {
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $user = $auth->getIdentity();
            return "Logged as: <strong>" . $user['email'] . "</strong> ";
        } else {
            return "Anonymous user";
        }
    }
}
