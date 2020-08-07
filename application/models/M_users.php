<?php

  /**
   *
   */
  class M_users extends CI_Model
  {

    var $tb_user = 'tb_user';


//  ===============================================SETTER===============================================
    // daftar user baru
    /**
     * setter untuk membuat user baru, yang bisa diakses melalui
     * halaman register atau dibuat manual oleh admin/superadmin
     * @param array $data [berisi 8 data]
     */
    public function set_new_user($data){
      // echo "<pre>";
      // print_r($data);
      $createdAt = unix_to_human(now(), true, 'europe');
  		$data = array(
  		  "username"          => $data['username'],
  		  "email"             => $data['email'],
        "fullname"          => $data['fullname'],
        "phone_number"      => $data['phoneNumber'],
        "gender"            => $data['gender'],
        "avatar"            => mt_rand(1,6).'.png',
  		  "password"          => $data['password'],
  		  "privilege"         => $data['privilege'],
        "is_active"         => '0',
        "created_at"        => $createdAt,
        "activation_code"   => $data['activation_code'],
  		);
      // echo "<hr>";
      // print_r($data);
      // die();
  		return $this->db->insert($this->tb_user, $data);
    }
    // update data profil admin
    public function set_update_admin_profile($params, $where){
      $this->db->where($where);
  		return $this->db->update($this->tb_user, $params);
    }
    // update data password user
    public function set_update_password($params, $where){
      $this->db->where($where);
  		return $this->db->update($this->tb_user, $params);
    }


//  ===============================================GETTER===============================================
    // get 1 user berdasarkan username / email
    // masukkan parameter kedua sebagai nama kolom pada database, untuk select kolom
    public function get_user_by_email_or_username($emailUsername, $select = '*'){
      // insert data register ke db
      $this->db->select($select);
      $this->db->from($this->tb_user);
      $this->db->where('email', $emailUsername);
      $this->db->or_where('username', $emailUsername);
      $query = $this->db->get();
      if ( $query->num_rows() == 1) {
        return $query;
      }
      return false;
    }
    // get 1 user berdasarkan username / email
    // masukkan parameter kedua sebagai nama kolom pada database, untuk select kolom
    public function get_user_hashed_password_by_username($username, $select = 'password'){
      // insert data register ke db
      $this->db->select($select);
      $this->db->from($this->tb_user);
      $this->db->where('username', $username);
      $query = $this->db->get();
      if ( $query->num_rows() == 1) {
        return $query;
      }
      return false;
    }

// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    // daftar user baru
    public function create($name, $username, $email, $phone, $gender, $password, $privilege, $activation_code){
      // insert data register ke db
      $created_at = unix_to_human(now(), true, 'europe');
      return $this->db->query("INSERT INTO {$this->tb_user} (name, username, email, phone, gender, password, privilege, activation_code, created_at)
                              VALUES ('{$name}', '{$username}', '{$email}', '{$phone}', '{$gender}', '{$password}', '{$privilege}', '{$activation_code}', '{$created_at}');");
    }

    // ganti info pada settings
    function set_info($email, $name, $phone, $username){
      return $this->db->query( "UPDATE {$this->tb_user} SET email='{$email}', name='{$name}', phone='{$phone}' WHERE username='{$username}';" );
    }

    function set_reset_code($email, $code){
      return $this->db->query( "UPDATE {$this->tb_user} SET reset_code='{$code}' WHERE email='{$email}';" );
    }

    // ambil semua user dan data usernya
    public function get_all(){
      $this->db->order_by('id', 'ASC');
      $this->db->from($this->tb_user);
      // fetch seluruh hasil pada db berupa array
      return $this->db->get()->result();
    }

    // ambil reset code untuk reset password
    public function get_reset_code($code){
      $this->db->from($this->tb_user);
      $this->db->where('reset_code', $code);
      // fetch seluruh hasil pada db berupa array
      return $this->db->get();
    }

    // ambil user berdasarkan email / username
    public function get_user($emailUsername){
      $this->db->from($this->tb_user);
      $this->db->where('email', $emailUsername);
      $this->db->or_where('username', $emailUsername);
      $this->db->where('privilege', 'basicUser');
      // fetch seluruh hasil pada db berupa array
      return $this->db->get();
    }

    // ambil admin berdasarkan username
    public function get_admin_by_username($username){
      $this->db->from($this->tb_user);
      $this->db->where('username', $username);
      $this->db->where('privilege', 'adminUser');
      // fetch seluruh hasil pada db berupa array
      return $this->db->get();
    }

  }


 ?>
