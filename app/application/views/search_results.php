<?php 
    $tmpl = array ( 'table_open'  => '<table class="table table-bordered">' );
	$this->table->set_template($tmpl);
    echo $this->table->generate($searchResults);
?>