<p class="lead">The results downloaded here are the edges and nodes needed for Gephi analysis.</p>

<a href="<?php echo site_url("convert/download"); ?>" class="btn btn-info">Download Edges</a>
<a href="<?php echo site_url("convert/downloadnodes"); ?>" class="btn btn-primary">Download Nodes</a>
<a href="<?php echo site_url("convert/delete_database"); ?>" class="btn btn-default">Refresh Database</a>

<hr />
<?php 
    $this->load->library('table');
    $tmpl = array ( 'table_open'  => '<table class="table table-bordered">' );
	$this->table->set_template($tmpl);
	
	//loop through the authors and see in which coauthor groups they appear
	foreach($authors as $key => $list){
	        echo '<strong>Author of interest</strong>'.' - '.$list['author'];
	        echo '<br />';
	        foreach($coauthors as $key => $co){
	            if(array_search($list['author'], $co)){
	                //put the results in a table
	                $this->table->add_row($co);
	                echo $this->table->generate();


	            }
	        }
	        echo '<hr>';
	    }
?>
