<?php

class Citnumber extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{
	    $this->title = 'Convert and Review';
        $this->menu = '';
	    
	    $this->load->model('csv_model');
	    $this->csv_model->delete_edge();
	    $this->load->helper('url');
	    //get co author list - this will give a long list of null for most
	    $coauthors = $this->csv_model->get_coauthors();
	    $tabledata['coauthors'] = $coauthors;
	    //get long list of suthors
	    $authors = $this->csv_model->get_authorlist();
	    $tabledata['authors'] = $authors;
	    
	    $this->load->library('table');
	    $tmpl = array ( 'table_open'  => '<table class="table table-bordered">' );
	    $this->table->set_template($tmpl);
	    
	    //loop through the authors and see in which coauthor groups they appear
	    foreach($authors as $key => $list){

	        foreach($coauthors as $key => $co){
	            //if(array_search($list['author'], $co)){
	            $searchword = $list['author'];
	            $id = $list['id'];
                $matches = array_filter($co, function($var) use ($searchword) { return preg_match("/\b$searchword\b/i", $var); });
	            if($matches){
	                
	                //check if a number already present
	                //$number_exist = $this->csv_model->get_number($list['id']);
	                //echo $number_exist;
	                //if($list['count'] > 0){
	                
	                /*
	                echo $list['count'];
	                echo $co['count'];
	                echo '<br>';
	                echo $total = $list['count'] + $co['count'];
	                echo '<br>';
	                */
	                
	                $currentNumber = $this->csv_model->get_number($id);
	                
	                echo "current ".$currentNumber;
	                echo '<br>';
	                
	                echo "to add ".$co['count'];
	                echo '<br>';
	                
	                
	                $newCount = $currentNumber + $co['count'];
	                echo "new sum ".$newCount;
	                echo '<br>';
	                
	                    $data = array(
                        'count'=> $newCount,
                        );
                        $this->csv_model->update_number($list['id'], $data);

	                //}else{
	                //    $data = array(
                        //'id' => $list['id'],
                        //'author'=> $list['author'],
                     //   'count'=> $co['count'],
                     //   );
                    //    $this->csv_model->update_number($list['id'], $data);
	               // }
	                
	                
	                /*
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
	                }*/
	                
	            }
	            
	            
	        }
	        echo '<hr>';
	    }
	    $this->load->view('counts', $tabledata);

	}
	
	function delete_database()
	{
	    $this->load->model('csv_model');
	    $this->csv_model->delete_edge();
	    redirect("uploadauthors");
	}
	
	function download()
	{
	    $this->load->dbutil();
	    $this->load->helper('download');
	    $query = $this->db->query("SELECT * FROM edges");
	    $data = $this->dbutil->csv_from_result($query);

	    $name = 'edges.csv';
	    force_download($name, $data);
	    
	}
	
	function downloadnodes()
	{
	    $this->load->dbutil();
	    $this->load->helper('download');
	    $query = $this->db->query("SELECT * FROM authorlist");
	    $data = $this->dbutil->csv_from_result($query);

	    $name = 'nodes.csv';
	    force_download($name, $data);
	    
	}

}
?>