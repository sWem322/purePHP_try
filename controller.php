<?php

namespace spaceWeb;

/**
 * routing
 */
class Controller
{
    /**
     * database model
     */
    var $model;

    /**
     * session object
     */
    var $session;

    /**
     * got info
     */
    var $request;

    /**
     * Это конструктор
     */
    function __construct($model, $session, $request)
    {
        $this->model = $model;
        $this->session = $session;
        $this->request = $request;
    }

    public function path_device_list()
    {
        $list = $this->model->device_list();

        echo json_encode($list);
    }

    public function path_device_info()
    {
        $list = $this->model->device_info($this->request["device_info"]);

        echo json_encode($list);
    }

    public function path_measurment_list()
    {
        \ob_start();
        $this->model->measurment_list($this->request["device_info"]);
        $result = \ob_get_clean();

        echo $result;
    }
}
