

<img src="<?php echo base_url('./uploads/convert.png'); ?>" style="width:50%" class="pull-right">
<p class="lead">This is a converter that will take a list of coauthors and a full list of authors and output the nodes and edges needed for SNA in Gephi</p>
<h3>Step 1: <small>Upload a list of coauthors.</small></h3>
<p>The data must be in exactly the right format to work. Use the CSV file <a href="">here</a> as a template.</p>

<?php echo $error;?>

<?php echo form_open_multipart('upload/do_upload');?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" class="btn btn-info"/>

</form>