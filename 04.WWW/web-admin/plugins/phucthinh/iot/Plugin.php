<?php

namespace PhucThinh\IOT;

use Backend;
use System\Classes\PluginBase;
use Event;
use RainLab\User\Models\User;

/**
 * IOT Plugin Information File
 */
class Plugin extends PluginBase {

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails() {
        return [
            'name' => 'IOT',
            'description' => 'No description provided yet...',
            'author' => 'PhucThinh',
            'icon' => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register() {
        
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot() {
        //Extend Form Fields
        Event::listen('backend.form.extendFields', function($widget) {

            if (!$widget->getController() instanceof \RainLab\User\Controllers\Users) {
                return;
            }

            // Only for the User model
            if (!$widget->model instanceof \RainLab\User\Models\User) {
                return;
            }
            //Add tab fields
            $widget->addTabFields([
                'user_factory' => [
                    'label' => 'Factory',
                    'type' => 'relation',
                    'nameFrom' => 'name',
                    'tab' => 'rainlab.user::lang.user.account',
                    'span' => 'auto'
                ]
            ]);

            //Add tab fields
            $widget->addTabFields([
                'phone' => [
                    'label' => 'Phone',
                    'type' => 'text',
                    'tab' => 'Personal',
                    'span' => 'auto'
                ]
            ]);
            //Add tab fields
            $widget->addTabFields([
                'address' => [
                    'label' => 'Address',
                    'type' => 'text',
                    'tab' => 'Personal',
                    'span' => 'auto'
                ]
            ]);
            //Add tab fields
            $widget->addTabFields([
                'birthday' => [
                    'label' => 'Birthday',
                    'type' => 'text',
                    'tab' => 'Personal',
                    'span' => 'auto'
                ]
            ]);
        });
        User::extend(function($model) {
            $model->belongsTo['user_factory'] = ['PhucThinh\IOT\Models\Factory', 'key' => 'factory_id', 'conditions' => 'status = 1'];
        });
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents() {
        return []; // Remove this line to activate

        return [
            'PhucThinh\IOT\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions() {
        return []; // Remove this line to activate

        return [
            'phucthinh.iot.some_permission' => [
                'tab' => 'IOT',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation() {
        return [
            'iot' => [
                'label' => 'Phúc Thịnh - IOT',
                'url' => Backend::url('phucthinh/iot/factory'),
                'icon' => 'icon-desktop',
                'permissions' => ['phucthinh.iot.*'],
                'order' => 500,
                'sideMenu' => [
                    'factory' => [
                        'label' => 'Factory',
                        'icon' => 'icon-sitemap',
                        'url' => Backend::url('phucthinh/iot/factory'),
                        'permissions' => ['phucthinh.iot.factory'],
                        'counterLabel' => 'General',
                    ]
                ]
            ],
        ];
    }

}
