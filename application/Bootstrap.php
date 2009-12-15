<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initConfig () {
        $this->_config = new Zend_Config_Ini('../application/configs/'.
                        'application.ini', APPLICATION_ENV);
        Zend_Registry::getInstance()->set('config', $this->_config);
    }

    protected function _initLog () {
        // Error log
        $writer = new Zend_Log_Writer_Stream($this->_config->errorlogpath);
        $format = '%timestamp% %priorityName% (%priority%): '.
                '[%module%] [%controller%] %message%' . PHP_EOL;
        $formatter = new Zend_Log_Formatter_Simple($format);
        $writer->setFormatter($formatter);
        $logger = new Zend_Log($writer);
        Zend_Registry::getInstance()->set('logger', $logger);

        // Appliction Log
        $writerApp = new Zend_Log_Writer_Stream($this->_config->logpath);
        $formatApp = '%timestamp% (%username%): '.
                '[%controller%] %message%' . PHP_EOL;
        $writerApp->setFormatter(new Zend_Log_Formatter_Simple($formatApp));
        $loggerApp = new Zend_Log($writerApp);
        Zend_Registry::getInstance()->set('loggerApp', $loggerApp);

    }


    protected function _initViewHelpers () {
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();

        $view->addHelperPath('ZendX/JQuery/View/Helper/', 'ZendX_JQuery_View_Helper');
        $view->doctype('XHTML1_STRICT');
        $view->headMeta()->appendHttpEquiv('Content-Type',
                'text/html;charset=utf-8');
        $view->headTitle()->setSeparator(' - ');
        $view->headTitle('Kreativní memorizer');
        $view->headMeta()->appendName('author', 'Ladislav Prskavec');
        $view->headMeta()->appendName('copyright', 'FormaX');

        $viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
        $viewRenderer->setView($view);
        Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);


    }
    public function _initDoctrine() {
        $this->getApplication()->getAutoloader()
                ->pushAutoloader(array('Doctrine', 'autoload'));
        spl_autoload_register(array('Doctrine', 'modelsAutoload'));

        $manager = Doctrine_Manager::getInstance();
        $manager->setAttribute(Doctrine::ATTR_AUTO_ACCESSOR_OVERRIDE, true);
        $manager->setAttribute(
                Doctrine::ATTR_MODEL_LOADING,
                DOctrine::MODEL_LOADING_CONSERVATIVE
        );
        $manager->setAttribute(Doctrine::ATTR_AUTOLOAD_TABLE_CLASSES, true);

        $doctrineConfig = $this->getOption('doctrine');

        Doctrine::loadModels($doctrineConfig['models_path']);

        $conn = Doctrine_Manager::connection($doctrineConfig['dsn'],'doctrine');
        $conn->setAttribute(Doctrine::ATTR_USE_NATIVE_ENUM, true);
        $conn->setCharset('utf8');
        return $conn;
    }

    
}

