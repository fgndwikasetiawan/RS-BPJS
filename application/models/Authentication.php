<?php

Class Authentication extends CI_Model {

  public function login($data) {
    $condition = "USERNAME =" . "'" . $data['username'] . "'";
    $this->db->select('*');
    $this->db->from('PENGGUNA');
    $this->db->where($condition);
    // $this->db->limit(1);
    $query = $this->db->get()->row();
    if ($query) {
      if(password_verify($data['password'], $query->PASSWORD_HASH)){
        return true;
      }
    }
    return false;
  }
}

?>
