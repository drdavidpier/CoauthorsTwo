<?php
 
class Csv_model extends CI_Model {
 
    function __construct() {
        parent::__construct();
 
    }
 
    function get_coauthors() {     
        $this->db->select('*');
        //$this->db->from('author');
        $get = $this->db->get('author');
        
        if($get->num_rows > 0) return $get->result_array();
        return array();
    }
    
    function get_number($id) {     
        $this->db->select('count');
        $this->db->where('id', $id);
        
        $query = $this->db->get('authorlist');
        $ret = $query->row();
        return $ret->count;
    }
    
    function insert_number($id, $data) {
        $this->db->insert('authorlist', $data);
    }
    
    function update_number($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('authorlist', $data);
    }
    
    function get_authorlist() {     
        $this->db->select('*');
        //$this->db->from('author');
        $get = $this->db->get('authorlist');
        
        if($get->num_rows > 0) return $get->result_array();
        return array();
    }
    
    function get_author_id($authorname){
        $this->db->select('id');
        $this->db->where('author', $authorname);
        
        $query = $this->db->get('authorlist');
        if($query->num_rows > 0) {$ret = $query->row();
        return $ret->id;}
        else{return '0';}
    }
    
    function get_author_pair($authoriddata, $author)
    {
        $this->db->select('weight');
        $this->db->where('source', $author);
        $this->db->where('target', $authoriddata);
        
        $query = $this->db->get('edges');
        if($query->num_rows > 0) {$ret = $query->row();
        return $ret->weight;}
        else{return '0';}
    }
 
    function insert_csv($data) {
        $this->db->insert('author', $data);
    }
    
    function insert_authors($data) {
        $this->db->insert('authorlist', $data);
    }
    
    function delete_edge() {
        //drop the contents of the table
        $this->db->truncate('edges'); 
    }
    
    function insert_edge($data) {
        $this->db->insert('edges', $data);
    }
    
    function update_edge($authoriddata, $author, $data)
    {
        $this->db->where('source', $author);
        $this->db->where('target', $authoriddata);
        $this->db->update('edges', $data);
    }
}
/*END OF FILE*/