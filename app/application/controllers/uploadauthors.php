<?php

class Uploadauthors extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{
	    $this->title = 'Upload Author List';
        $this->menu = '';
		$this->load->view('upload_authors', array('error' => ' ' ));
	}

	function do_upload()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png|text/comma-separated-values|application/csv|application/excel|application/vnd.ms-excel|application/vnd.msexcel|text/anytext|text/plain|text/csv|csv';
		$config['max_size']	= '10000';
		$config['max_width']  = '10240';
		$config['max_height']  = '7680';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$file_path = $data['upload_data']['full_path'];
			$this->load->spark('csv-import');
			if($this->csvimport->get_array($file_path)){
			    $csv_array = $this->csvimport->get_array($file_path);

			    foreach ($csv_array as $row) {
                    $insert_data = array(
                        //'title'=>$row['title'],
                        'author'=>$row['author'],
                    );
                    $this->load->model('csv_model');
                    $this->csv_model->insert_authors($insert_data);
                }
                echo 'it worked';
			}else{
			    echo 'error';
			}
		}
	}
}
?>