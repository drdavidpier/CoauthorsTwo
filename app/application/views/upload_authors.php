<p>The data must be in exactly the right format to work. Use the CSV file <a href="">here</a> as a template.</p>
<?php echo $error;?>

<?php echo form_open_multipart('uploadauthors/do_upload');?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" class="btn btn-warning"/>

</form>
