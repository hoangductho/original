<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usergroup extends MY_Controller {

    protected $__ISSERVICE__ = false;
    protected $__IS_AUTH__ = true;
    protected $__RULES__ = [
        'index' => [
            'method' => 'GET',
            'authorize' => [
                'group' => 'System',
                // 'role' => 'Admin',
                // 'permission' => 'ADMIN_CATEGORY_EDIT',
                // 'region' => null,
            ],
            'data' => []
        ]
    ];

    public function __construct() {
        parent::__construct();

        $layout_data = [
            'title' => 'User-Group',
            'javascript' => array(
                1 => '/assets/js/vienvong/usergroup.js'
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
        $data['emails'] = $this->MAccount->getAllAccount();
        $data['groups'] = $this->MGroups->getActiveGroups();
        $data['usergroups'] = $this->MGroupuser->getAllGroupUser();
        
        $this->load->render('Usergroup/usergroup', $data);
    }
} 