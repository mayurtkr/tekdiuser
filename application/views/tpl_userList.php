<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>title</title>

    <script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="<?PHP echo base_url();?>css/jquery.dataTables.min.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?PHP echo base_url();?>css/style.css" type="text/css" media="screen">






    <!--<link rel="stylesheet" href="<?PHP echo base_url();?>css/jquery-ui.min.css" type="text/css" media="screen">
    <script type="text/javascript" src="<?php echo base_url();?>js/dataTables.jqueryui.min.js"></script>-->

    <script type="text/javascript">

        $(document).ready(function() {
            $('#userTable').DataTable( {
                "pagingType": "full_numbers"
            } );
        } );

        $(document).ready(function() {
            
           $('#add_btn').click(function() {
                window.location.href = '<? echo base_url();?>user/addUser';
                return false;
           }); 

        });

        function confirmSubmit(uid){
            
            var msg;
            msg= "Are you sure you want to delete this user ? ";
            if(!confirm(msg)){
                return false;
            }
           
                $.ajax({
                        type: 'POST',
                        url: "<?PHP echo base_url();?>user/deleteUser",
                        data: {uid:uid},
                        dataType: 'html',
                        success: function (data){
                        if(parseInt(data)==1)
                        {
                            location.reload();
                        }
                            return false;
                        }
                });

        }
    </script>

  </head>
  <body>

<div class="headClass">
    <h3>User Module</h3>
</div>

<div class="addclass">
    <input type="button" value="Add user" id="add_btn">
</div>
  

<table id="userTable" class="display" cellspacing="0" width="100%">

        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Country</th>
                <th>Email</th>
                <th>Mobile Number</th>
                <th>About You</th>
                <th>Birthday</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
   
        <tbody>

            <?php
                if($record_count > 0){

                    foreach ($results as $row) { ?>

                        <tr>
                            <td><?PHP echo (isset($row['user_id']))?$row['user_id']:'';?></td>
                            <td><?PHP echo (isset($row['user_name']))?$row['user_name']:'';?></td>
                            <td><?PHP echo (isset($row['user_country']))?$row['user_country']:'';?></td>
                            <td><?PHP echo (isset($row['user_email']))?$row['user_email']:'';?></td>
                            <td><?PHP echo (isset($row['user_mobile']))?$row['user_mobile']:'';?></td>
                            <td><?PHP echo (isset($row['user_about']))?$row['user_about']:'';?></td>
                            <td><?PHP echo (isset($row['user_bday']))?$row['user_bday']:'';?></td>

                            <td>
                                <?PHP echo anchor(base_url().'user/editUser/'.$row['user_id'],"<img src='".base_url()."/images/edit.png'/>",'');?>
                            </td>

                            <td>
                                <img src="<?php echo base_url();?>images/delete.png" onclick="confirmSubmit(<? echo $row['user_id']; ?>)">
                            </td>

                        </tr>       

                    <?  } //end of forloop
                }else{ ?>
                    <tr>
                        <td colspan="6" align="center">No result found.</td>
                    </tr>
                <? } ?>
           
        </tbody>

    </table>

  </body>
</html>