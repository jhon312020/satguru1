<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Country extends CI_Controller {

	// calling the constructor
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('country/country_model', 'country');
	}

	/**
	 * Function listing()
	 * This function will redirect to the listing page
	 * Params null
	 * @return redirects to listing page
	 */
	public function index() 
	{
		redirect('country/listing');
	}

	/**
	 * Function listing()
	 * This function will display the list of country
	 * data coming from the model
	 * Params null
	 * @return Loads the listing page
	 */
	public function listing() 
	{
		$data['header']['title'] = 'Country listing';
		$data['footer']['scripts']['homescript.js'] = 'home';
		$data['view_name'] = 'country/country_listing_view';
		$data['view_data'] = $this->country->get();
		$this->load->view('country/page_view', $data);
	}

	/**
	 * Function add()
	 * This function will display the form to add a new country
	 * Author megamind Computing solutions
	 * Params null
	 * @return Loads the add page form
	 */
	public function add() 
	{
		$data['header']['title'] = 'Add a new country';
		$data['footer']['scripts']['homescript.js'] = 'home';
		$data['view_name'] = 'country/country_add_view';
		$data['view_data'] = '';
		$this->load->view('country/page_view', $data);
	}
 
	/**
	 * Function update()
	 * This function will display the form for editing a country
	 * the get function used to fetch the country info
	 * [If no id, then it should displays error page]
	 * Author megamind Computing solutions
	 * Get Params $country_id
	 * @return redirects to listing page
	 */
	public function update($id = null) 
	{
		if ($id == null)
		{
			show_error('No identifier provided', 500);
		}
		else 
		{
			$data['header']['title'] = 'Edit a country';
			$data['footer']['scripts']['homescript.js'] = 'home';
			$data['view_name'] = 'country/country_edit_view';
			$data['view_data'] = $this->country->get($id);
			$this->load->view('country/page_view', $data);
		}
	}
 
	/**
	 * Function delete()
	 * This function deletes a country from the database
	 * and redirects back to the listing page
	 * Author megamind Computing solutions
	 * Get Params $country_id
	 * @return redirects to listing page
	 */
	public function delete($id = null) 
	{
		if ($id == null) 
		{
			show_error('No identifier provided', 500);
		}
		else 
		{
			$this->country->remove($id);
			// Set flash data 
			$this->session->set_flashdata('message', '<div style="text-align:center; color:#4C8C18">Successfully deleted the  country information!</div>');
			redirect('country/listing'); // back to the listing
		}
	}

	/**
	 * Function save()
	 * This function will add a new country
	 * Author megamind Computing solutions
	 * Post Params $method, $name and $phonecode
	 * @return redirects to listing page
	 */
	public function save() 
	{
		if (isset($_POST) && $_POST['save'] == 'Add') 
		{
			$data['name'] = $this->input->post('country_name');
			$data['phonecode'] = $this->input->post('country_phonecode');
			// Set flash data 
			$this->session->set_flashdata('message', '<div style="text-align:center; color:#4C8C18">Successfully added a new country!</div>');
			$this->country->add($data);
		}
		redirect('country/listing');
	}
 
	/**
	 * Function update()
	 * This function will update the info of the existing country
	 * Author megamind Computing solutions
	 * Post Params $country_id, $name and $phonecode
	 * @return redirects to listing page
	 */
	public function update_country() 
	{
		if (isset($_POST) && $_POST['save'] == 'Save') 
		{
			$data['country_id'] = $this->input->post('country_id');
			$data['name'] = $this->input->post('country_name');
			$data['phonecode'] = $this->input->post('country_phonecode');
			// Set flash data 
			$this->session->set_flashdata('message', '<div style="text-align:center; color:#4C8C18">Successfully update the  country information!</div>');
			$this->country->add($data);
		}
		redirect('country/listing');
	}
}
