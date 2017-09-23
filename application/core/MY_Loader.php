<?php
(defined('BASEPATH')) or exit('No direct script access allowed');

/* load the HMVC_Loader class */
require APPPATH . 'third_party/HMVC/Loader.php';

class MY_Loader extends HMVC_Loader {
  /**
  * Layout view
  *
  * @var string
  * @access protected
  */
  protected $_LAYOUT_VIEW;

  /**
  * Layout data
  *
  * @var array
  * @access protected
  */
  protected $_LAYOUT_DATA;

  /**
  * Template view
  *
  * @var string
  * @access protected
  */
  protected $_TEMPLATE_VIEW;

  /**
  * Template view
  *
  * @var array
  * @access protected
  */
  protected $_TEMPLATE_DATA;
  /**
  * Template view
  *
  * @var string
  * @access protected
  */
  protected $_MAIN_VIEW;

  /**
  * Template view
  *
  * @var array
  * @access protected
  */
  protected $_MAIN_DATA;
  /**
  * Dictionary
  *
  * @var array
  * @access protected
  */
  public $__DICT__;

  /**
  * Constructor
  *
  * Add the current module to all paths permanently
  */
  public function __construct() {
    parent::__construct();
    $this->_LAYOUT_VIEW = 'layout';
    $this->_LAYOUT_DATA = array();
    $this->_TEMPLATE_VIEW = 'template';
    $this->_TEMPLATE_DATA = array();
  }

  // ------------------------------------------------------------------
  /**
  * Render Page
  *
  * @access public
  */
  public function render($view = '', $data = array(), $return = FALSE) {
    if(!empty($view)) {
      $this->_MAIN_VIEW = $view;
      $this->_MAIN_DATA = $data;
    }

    return $this->view($this->_LAYOUT_VIEW, $this->_LAYOUT_DATA, $return);
  }

  // ------------------------------------------------------------------
  /**
  * Render Page
  *
  * @access public
  */
  public function render_template() {
    $this->view($this->_TEMPLATE_VIEW, $this->_TEMPLATE_DATA);
  }

  // ------------------------------------------------------------------
  /**
   * Setup layout view
   */
  public function set_layout ($view = '') {
    if(!empty($view)) {
      $this->_LAYOUT_VIEW = $view;
    }

    return $this;
  }
  // ------------------------------------------------------------------
  /**
  * Setup layout data
  *
  * @param $view view name will be loaded to template
  * @param $data data will be pushed to view
  * @param $alias alias name for view in template
  */
  public function layout($alias, $data = array()) {
    if(!empty($alias)) {
      if(!is_array($alias)) {
        $this->_LAYOUT_DATA[$alias] = $data;
      }
      else {
        $this->layout_set_array($alias);
      }
    }
  }

  // ------------------------------------------------------------------
  /**
  * Setup layout array
  *
  * @param $view view name will be loaded to template
  * @param $data data will be pushed to view
  * @param $alias alias name for view in template
  */
  public function layout_set_array($data) {
    if(!empty($data))
      $this->_LAYOUT_DATA = array_merge($this->_LAYOUT_DATA, $data);
  }

  // ------------------------------------------------------------------
  /**
   * Setup layout view
   */
  public function set_template ($view = '') {
    if(!empty($view)) {
      $this->_TEMPLATE_VIEW = $view;
    }

    return $this;
  }
  // ------------------------------------------------------------------
  /**
  * Setup template
  *
  * @param $view view name will be loaded to template
  * @param $data data will be pushed to view
  * @param $alias alias name for view in template
  */
  public function template($view, $data = null, $alias = null) {
    if(is_array($view)) {
      $this->template_set_array($view);
    }
    else {
      if($alias != null && !empty($alias)) {
        $this->_TEMPLATE_DATA[$alias] = array(
          'view' => $view,
          'data' => $data
        );
      }else {
        $item = array(
          'view' => $view,
          'data' => $data
        );
        array_push($this->_TEMPLATE_DATA, $item);
      }
    }
  }
  // ------------------------------------------------------------------
  /**
  * Setup template array
  *
  * @param $view view name will be loaded to template
  * @param $data data will be pushed to view
  * @param $alias alias name for view in template
  */
  public function template_set_array($data) {
    if(!empty($data))
      array_merge($this->_TEMPLATE_DATA, $data);
  }
}
