<?php namespace PhucThinh\IOT\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Factory Back-end Controller
 */
class Factory extends Controller
{
    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    /**
     * @var string Configuration file for the `FormController` behavior.
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string Configuration file for the `ListController` behavior.
     */
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('PhucThinh.IOT', 'iot', 'factory');
    }
}
