<?php

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{
		$this->load->view('upload_form', array('error' => ' ' ));
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
                        'author1'=>$row['author1'],
                        'author2'=>$row['author2'],
                        'author3'=>$row['author3'],
                        'author4'=>$row['author4'],
                        'author5'=>$row['author5'],
                        'author6'=>$row['author6'],
                        'author7'=>$row['author7'],
                        'author8'=>$row['author8'],
                        'author9'=>$row['author9'],
                        'author10'=>$row['author10'],
                        'author11'=>$row['author11'],
                        'author12'=>$row['author12'],
                        'author13'=>$row['author13'],
                        'author14'=>$row['author14'],
                        'author15'=>$row['author15'],
                        'author16'=>$row['author16'],
                        'author17'=>$row['author17'],
                        'author18'=>$row['author18'],
                        'author19'=>$row['author19'],
                        'author20'=>$row['author20'],
                        'author21'=>$row['author21'],
                        'author22'=>$row['author22'],
                        'author23'=>$row['author23'],
                        'author24'=>$row['author24'],
                        'author25'=>$row['author25'],
                        'author26'=>$row['author26'],
                        'author27'=>$row['author27'],
                    );
                    $this->load->model('csv_model');
                    $this->csv_model->insert_csv($insert_data);
                }
                echo 'it worked';
			}else{
			    echo 'error';
			}
		}
	}
}
?>