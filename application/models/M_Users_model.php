<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Users_model extends CI_Model
{

    public function read()
    {
        $query = $this->db->get('tbl_user');
        return $query->result();
    }

    public function read_by($id)
    {
        $this->db->where('user_id', $id);
        $query = $this->db->get('tbl_user');
        return $query->row();
    }

    public function create($data)
    {
        $result = $this->db->insert('tbl_user', $data);
        return $result;
    }

    public function update($user_id, $data)
    {
        $this->db->where('user_id', $user_id);
        $this->db->update('tbl_user', $data);
    }

    public function delete($id)
    {
        $this->db->where('user_id', $id);
        $this->db->delete('tbl_user');
    }
}
