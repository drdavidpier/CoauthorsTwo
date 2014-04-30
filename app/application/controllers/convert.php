<?php

class Convert extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{
	    $this->load->model('csv_model');
	    //$this->csv_model->delete_edge();
	    $this->load->helper('url');
	    //get co author list - this will give a long list of null for most
	    $coauthors = $this->csv_model->get_coauthors();
	    //get long list of suthors
	    $authors = $this->csv_model->get_authorlist();
	    
	    $this->load->library('table');
	    $tmpl = array ( 'table_open'  => '<table border="1" cellpadding="2" cellspacing="1" class="mytable">' );
	    $this->table->set_template($tmpl);
	    
	    //loop through the authors and see in which coauthor groups they appear
	    foreach($authors as $key => $list){
	        echo $list['author'];
	        echo '<br />';
	        foreach($coauthors as $key => $co){
	            if(array_search($list['author'], $co)){
	                //put the results in a table
	                $this->table->add_row($co);
	                echo $this->table->generate();

	                foreach($co as $coauthorlist){
	                    //get the author id from their name. If no name passed return a result of zero
	                    $authoriddata = $this->csv_model->get_author_id($coauthorlist);
	                    //if author id is valid then insert into database
	                    if($authoriddata > 0){
	                        //check if author pair already exist and add to edge weight
	                        $pair_exist = $this->csv_model->get_author_pair($authoriddata, $list['id']);
	                        
	                        if($pair_exist > 0){
	                        $data = array(
                                'source' => $list['id'],
                                'target'=> $authoriddata,
                                'weight'=> $pair_exist + 1,
                            );
                            $this->csv_model->update_edge($authoriddata, $list['id'], $data);
	                        }else{
	                           $data = array(
                                'source' => $list['id'],
                                'target'=> $authoriddata,
                                'weight'=> '1',
                            );
                            $this->csv_model->insert_edge($data); 
	                        }
	                    }
	                }
	            }
	        }
	        echo '<hr>';
	    }
		$this->load->view('results');
	}
	
	function delete_database()
	{
	    $this->load->model('csv_model');
	    $this->csv_model->delete_edge();
	    redirect("convert");
	}

}
?>