<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

    public function get_by_email($email)
    {
        return $this->db->get_where('usuarios', ['email' => $email])->row();
    }
}