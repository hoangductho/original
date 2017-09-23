<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userpermissions extends MY_Controller {

    protected $__ISSERVICE__ = false;
    protected $__IS_AUTH__ = true;
    protected $__RULES__ = [
        'index' => [
            'method' => 'GET',
            'authorize' => [
                'group' => 'System',
                'role' => 'Admin',
                // 'permission' => 'ADMIN_CATEGORY_EDIT',
                // 'region' => null,
            ],
            'data' => []
        ],
        'filter' => [
            'method' => 'GET',
            'security' => true,
            'data' => [
                'account_id' => [
                    'allow_null' => true,
                    'filter' => FILTER_VALIDATE_REGEXP,
                    'options' => [
                        'regexp' => '/^[0-9]{1,9}+$/'
                    ]
                ],
                'group_id' => [
                    'allow_null' => true,
                    'filter' => FILTER_VALIDATE_REGEXP,
                    'options' => [
                        'regexp' => '/^[0-9]{1,9}+$/'
                    ]
                ],
                'role_id' => [
                    'allow_null' => true,
                    'filter' => FILTER_VALIDATE_REGEXP,
                    'options' => [
                        'regexp' => '/^[0-9]{1,9}+$/'
                    ]
                ],
                'permission_id' => [
                    'allow_null' => true,
                    'filter' => FILTER_VALIDATE_REGEXP,
                    'options' => [
                        'regexp' => '/^[0-9]{1,9}+$/'
                    ]
                ],
                'region_id' => [
                    'allow_null' => true,
                    'filter' => FILTER_VALIDATE_REGEXP,
                    'options' => [
                        'regexp' => '/^[0-9]{1,9}+$/'
                    ]
                ],
            ]
        ],
    ];

    public function __construct() {
        parent::__construct();

        $layout_data = [
            'title' => 'User-Permission',
            'javascript' => array(
                1 => '/assets/js/vienvong/userpermissions.js'
            )
        ];

        // set layout
        $this->load->set_layout('active_layout.php');
        $this->load->layout($layout_data);
    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $data['userpermissions'] = $this->MUserPermission->getAllUserPermission();

        $data['regions'] = $this->MRegions->getAllRegions();

        $data['groups'] = $this->MGroups->getActiveGroups();

        $data['permissions'] = $this->MPermission->getAllPermission();

        $data['emails'] = $this->MAccount->getAllAccount();
        
        $this->load->render('Userpermissions/userpermissions', $data);
    }


    /**
     * Filter Data
     *
     * Get list of articles by filter data conditions
     */
    public function filter() {
        $request = $this->__REQUEST_DATA__;

        $settings = array(
            'userpermissions' => $this->MUserPermission->getAllUserPermission($request)
        );
        
        $render = $this->load->view('Userpermissions/list_userpermissions', $settings, TRUE);

        echo $render;
    }
} 