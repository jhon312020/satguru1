<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Country_model extends CI_Model {
 
  public function __construct() {
    parent::__construct();
  }
 
  /**
   * This funtion takes id as a parameter and will fetch the record.
   * If id is not provided, then it will fetch all the records form the table.
   * @param int $id
   * @return mixed
   */
  public function get($id = null) {
    $this->db->select()->from('country');
 
    // where condition if id is present
    if ($id != null) {
      $this->db->where('country_id', $id);
    }
    else {
      $this->db->order_by('country_id');
    }
 
    $query = $this->db->get();
 
    if ($id != null) {
      return $query->row_array(); // single row
    }
    else {
      return $query->result_array(); // array of result
    }
  }
 
  /**
   * This function will delete the record based on the id
   * @param $id
   */
  public function remove($id) {
    $this->db->where('country_id', $id);
    $this->db->delete('country');
  }
 
  /**
   * This function will take the post data passed from the controller
   * If id is present, then it will do an update
   * else an insert. One function doing both add and edit.
   * @param $data
   */
  public function add($data) {
    if (isset($data['country_id'])) {
      $this->db->where('country_id', $data['country_id']);
      $this->db->update('country',$data); // update the record
    }
    else {
      $this->db->insert('country', $data); // insert new record
    }
  }
}
