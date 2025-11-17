<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function obtener_menu()
    {
        $this->db->order_by('orden', 'ASC');
        $query = $this->db->get('menu');
        return $query->result();
    }
}
