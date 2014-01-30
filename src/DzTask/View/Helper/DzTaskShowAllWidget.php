<?php

namespace DzTask\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\View\Model\ViewModel;

class DzTaskShowAllWidget extends AbstractHelper
{
    /**
     * $var string template used for view
     */
    protected $viewTemplate;
    
    /**
     * __invoke
     *
     * @access public
     * @param array $options array of options
     * @return string
     */
    public function __invoke($options = array())
    {
        if (array_key_exists('render', $options)) {
            $render = $options['render'];
        } else {
            $render = true;
        }

        $tasks = $this->getTaskService()
            ->getTaskMapper()
            ->findAll();

        $vm = new ViewModel(array(
            'tasks' => $tasks,
        ));

        $vm->setTemplate('dz-task/task/showall.phtml');
        if ($render) {
            return $this->getView()->render($vm);
        } else {
            return $vm;
        }
    }

    public function setTaskService($taskService)
    {
        $this->taskService = $taskService;
        return $this;
    }

    public function getTaskService()
    {
        return $this->taskService;
    }
}