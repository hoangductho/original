<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profiles extends MY_Controller {

    protected $__ISSERVICE__ = false;
    protected $__IS_AUTH__ = true;
    protected $__RULES__ = [
        'index' => [
            'method' => 'GET',
            'data' => []
        ],
        'changepass' => [
            'method' => 'GET',
            'data' => []
        ]
    ];

    public function __construct() {
        parent::__construct();

        $layout_data = [
            'title' => 'Profiles',
            'javascript' => array(
                1 => '/assets/lib/cropperjs/cropper.min.js',
                2 => '/assets/js/vienvong/profiles.js',
            ),
            'stylesheet' => array(
                1 => '/assets/lib/cropperjs/cropper.min.css'
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
        $data['profile'] = $this->MAccount->getByID($this->__ACCOUNT__->id);
        $this->load->render('Profiles/profiles', $data);
    }

    /**
     * Change password page
     */
    public function changepass() {
        $this->load->render('Profiles/changepass');
    }
}