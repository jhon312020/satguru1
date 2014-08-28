<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Country extends CI_Controller {
 
  // calling the constructor
  public function __construct() {
    parent::__construct();
    $this->load->model('country/country_model', 'country');
  }
 
  public function index() {
    redirect('country/listing');
  }
 
  /**
   * This function will display the list of country
   * data coming from the model
   */
  public function listing() {
    $data['header']['title'] = 'Country listing';
    $data['footer']['scripts']['homescript.js'] = 'home';
    $data['view_name'] = 'country/country_listing_view';
    $data['view_data'] = $this->country->get();
 
    $this->load->view('country/page_view', $data);
  }
 
  /**
   * This function will display the form to add a new country
   */
  public function add() {
    $data['header']['title'] = 'Add a new country';
    $data['footer']['scripts']['homescript.js'] = 'home';
    $data['view_name'] = 'country/country_add_view';
    $data['view_data'] = '';
 
    $this->load->view('country/page_view', $data);
  }
 
  /**
   * This function will display the form for editing a country
   * the get function used to fetch the country info
   * [If no id, then it should display error]
   * @param int $id
   */
  public function modify($id = null) {
    if ($id == null) {
      show_error('No identifier provided', 500);
    }
    else {
      $data['header']['title'] = 'Edit a country';
      $data['footer']['scripts']['homescript.js'] = 'home';
      $data['view_name'] = 'country/country_edit_view';
      $data['view_data'] = $this->country->get($id);
 
      $this->load->view('country/page_view', $data);
    }
  }
 
  /**
   * This function deletes a country from the database
   * and redirects back to the listing
   * @param int $id
   */
  public function remove($id = null) {
    if ($id == null) {
      show_error('No identifier provided', 500);
    }
    else {
      $this->country->remove($id);
      redirect('country/listing'); // back to the listing
    }
  }
 
  /**
   * This function will call the model add function
   * and add the new country.
   */
  public function save() {
    if (isset($_POST) && $_POST['save'] == 'Add') {
      $data['name'] = $this->input->post('country_name');
      $data['phonecode'] = $this->input->post('country_phonecode');
      $this->country->add($data);
      redirect('country/listing'); // back to the add form
    }
    else {
      redirect('country/listing');
    }
  }
 
  /**
   * This function will update the info of the existing country
   */
  public function update() {
    if (isset($_POST) && $_POST['save'] == 'Save') {
      $data['country_id'] = $this->input->post('country_id');
      $data['name'] = $this->input->post('country_name');
      $data['phonecode'] = $this->input->post('country_phonecode');
      $this->country->add($data);
      redirect('country/listing'); // back to the add form
    }
    else {
      redirect('country/listing');
    }
  }
}
