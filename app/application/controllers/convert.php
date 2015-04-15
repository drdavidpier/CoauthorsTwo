<?php

class Convert extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{
        @set_time_limit(-1);
        
	    $this->title = 'Convert and Review';
        $this->menu = '';
	    
	    $this->load->model('csv_model');
	    $this->csv_model->delete_edge();
	    $this->load->helper('url');
	    //get co author list - this will give a long list of null for most
	    $coauthors = $this->csv_model->get_coauthors();
	    $tabledata['coauthors'] = $coauthors;
	    //get long list of authors
	    $authors = $this->csv_model->get_authorlist();
	    $tabledata['authors'] = $authors;
	    
	    $this->load->library('table');
	    $tmpl = array ( 'table_open'  => '<table class="table table-bordered">' );
	    $this->table->set_template($tmpl);
	    
	    //loop through the authors and see in which coauthor groups they appear
	    foreach($authors as $key => $list){
            $searchword = $list['author'];
	    
            foreach($coauthors as $key => $co){
	            //if(array_search($list['author'], $co)){
	            
                $matches = array_filter($co, function($var) use ($searchword) { return preg_match("/\b$searchword/i", $var); });
                        
                echo '<h2>';
                echo $co['id'];
                echo '</h2>';
                
	            if($matches){
                
	                foreach($co as $coauthorlist){
	                    //get the author id from their name. If no name passed return a result of zero
	                    //$authoriddata = (int) $this->csv_model->get_author_id($coauthorlist); //THIS DOES NOT WORK BECAUSE IT IS USING LONG AUTHORNAME TO LOOK FOR SHORT AUTHOR NAME - ARSE!!!!
                        //instead go through the cleaned author list AGAIN and find the author
                        
                        $authoriddata = 0;
                        
                        foreach($authors as $key => $shortauthornames){
                            //echo $shortauthornames['author'];
                            $finalmatch = strpos($coauthorlist, $shortauthornames['author']);

                            //var_dump($finalmatch);

                            if($finalmatch === 0){
                                $authoriddata = (int) $this->csv_model->get_author_id($shortauthornames['author']);
                            }
                        }
                        
	                    //if author id is valid then insert into database 

                        echo $authoriddata;
                        echo '<br />';

	                    if($authoriddata > 0){
                            
	                        //check if author pair already exist and add to edge weight
                            echo "pair coauthor - ";
                            var_dump($authoriddata);
                            echo '<br />';
                            echo " author - ";
                            $listid = (int) $list['id'];
                            var_dump($listid);
                            echo '<br />';
                            
                            //$authoriddata = 1;
                            //$listid = 1;
                            
	                        $pair_exist = $this->csv_model->get_author_pair($authoriddata, $listid);
	                        $pair_exist = (int) $pair_exist;
                            echo "pair exists? - ";
                            var_dump($pair_exist);
	                        
                            if($pair_exist > 0){
	                        $dataa = array(
                                'source' => $listid,
                                'target'=> $authoriddata,
                                'weight'=> $pair_exist + 1,
                            );
                                echo '<br />';
                                echo "boom";
                                echo "<hr>";
                            $this->csv_model->update_edge($authoriddata, $listid, $dataa);
	                        }else{
	                           $data3 = array(
                                'source' => $listid,
                                'target'=> $authoriddata,
                                'weight'=> '1',
                            );
                                echo '<br />';
                                echo "nope";
                                echo '<hr />';
                            $this->csv_model->insert_edge($data3); 
	                        }
	                    }
                        
                        
	                }
	            }
                echo "end of code";
	        }
	    }
	    $this->load->view('results', $tabledata);

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