<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Adddress Book Project</title>

    </head>
 
    <body>
 
        
             <br>
 
             <?php if (isset($error)): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('success') == TRUE): ?>
                <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
            <?php endif; ?>
 
            <h2>CI Addressbook Import</h2>
                <form method="post" action="<?php echo base_url() ?>csv/importcsv" enctype="multipart/form-data">
                    <input type="file" name="userfile" ><br><br>
                    <input type="submit" name="submit" value="UPLOAD" class="btn btn-primary">
                </form>
 
            <br><br>
            <table class="table table-striped table-hover table-bordered">
                <caption>Address Book List</caption>
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($addressbook == FALSE): ?>
                        <tr><td colspan="4">There are currently No Addresses</td></tr>
                    <?php else: ?>
                        <?php foreach ($addressbook as $row): ?>
                            <tr>
                                <td><?php echo $row['firstname']; ?></td>
                                <td><?php echo $row['lastname']; ?></td>
                                <td><?php echo $row['phone']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
 
 
            <hr>
            <footer>
                <p>&copy;My Address Book</p>
            </footer>
 
        </div>
 
 
 
    </body>
</html>