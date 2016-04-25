<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>title</title>
     <link rel="stylesheet" href="<?PHP echo base_url();?>css/style.css" type="text/css" media="screen">
     <script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.12.0.min.js"></script>

     <link rel="stylesheet" href="<?php echo  base_url();?>js/datepicker/css/jquery-ui.css" type="text/css" media="screen"/> 
     <script src="<?php echo  base_url();?>js/jquery-1.10.2.js" type="text/javascript" ></script>
     <script src="<?php echo  base_url();?>js/jquery-ui.js" type="text/javascript" ></script>


     <!--<script src="<?php echo  base_url();?>js/validation.js" type="text/javascript" ></script>-->
      
     <script type="text/javascript">

        $(document).ready(function() {
            
           $('#cancel_btn').click(function() {
                window.location.href = '<? echo base_url();?>user';
                return false;
           }); 

        });

        $(document).ready(function(){ 
            var $j = jQuery.noConflict();           
            $j("#user_bday").datepicker({dateFormat:  "yy-mm-dd"});            
        });


$(document).ready(function(){ 

    var w = jQuery(window).width();
      w = (w*40)/100;
      var h = jQuery(window).height();
      h = (h*40)/100;

    var jQ = jQuery.noConflict();
    jQ( "#successMsg" ).dialog({
        autoOpen: false,
        modal: true,
        width: w,
        height: h,
         show: {
          effect: "blind",
          duration: 100
        },
        hide: {
          effect: "blind",
          duration: 200
        }
    });



     $('#submit_btn').click(function(){ 

            //alert("Form clicked");
        
            if(validates()){
                
                    var form_id='#userform';
                    var var_form_data= $(form_id).serialize(); 
                    
                    $.ajax({
                        type: 'POST',
                        url: "<?PHP echo base_url();?>user/editUserAjax",
                        data: var_form_data,
                        dataType: 'html',
                        success: function (data){
                        if(parseInt(data)==1)
                        { 
                            var mp = jQuery.noConflict();
                            mp( "#successMsg" ).dialog( "open" );
                            setTimeout('redirectPage()',2000); 
                        }
                        return false;
                        }
                    });
                    return false;
        } else {
                //$('#loader').hide();
                alert("Please answer all mandatory questions");
                return false;

        }
    }); 


    //For mobile number
    $('#user_mobile').keydown(function(event) {
            // Allow special chars + arrows 
            if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 
                || event.keyCode == 27 || event.keyCode == 13 
                || (event.keyCode == 65 && event.ctrlKey === true) 
                || (event.keyCode >= 35 && event.keyCode <= 39)){
                    $('#msg_user_mobile').html('').hide(); 
                    return;
            }else {
                // If it's not a number stop the keypress
                if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                    event.preventDefault();
                    $('#msg_user_mobile').html('Please enter only numeric value').show(); 
                }   
            }
    });





});


function redirectPage(){
    window.location="<?PHP echo base_url();?>user";
}


//for validation
 function validates(){

     var isValid= true;

     var un = $.trim($('#user_name').val()) ;
       if(!un && un.length <= 0){
         isValid = false;
         $('#msg_user_name').html('This is a required field').show();
       }else{
         $('#msg_user_name').html('').hide();
       }
         
       var un = $.trim($('#user_country').val()) ;
       if(!un && un.length <= 0){
         isValid = false;
         $('#msg_user_country').html('This is a required field').show();
       }else{
         $('#msg_user_country').html('').hide();
       }

       //validate email
       var email = $.trim($('#user_email').val()) ;
       if(email && email.length > 0){
       if(!isValidEmailAddress(email)){
         isValid = false;
         $('#msg_user_email').html('Email is invalid').show();           
       }else{
         $('#msg_user_email').html('').hide();
       }
       }else{
         isValid = false;
         $('#msg_user_email').html('This is a required field').show();
       }

       var un = $.trim($('#user_about').val()) ;
       if(!un && un.length <= 0){
         isValid = false;
         $('#msg_user_about').html('This is a required field').show();
       }else{
         $('#msg_user_about').html('').hide();
       }

       var un = $.trim($('#user_bday').val()) ;
       if(!un && un.length <= 0){
         isValid = false;
         $('#msg_user_bday').html('This is a required field').show();
       }else{
         $('#msg_user_bday').html('').hide();
       }

       var un = $.trim($('#user_mobile').val()) ;
        if(!un && un.length <= 0){
             isValid = false;
            $('#msg_user_mobile').html('This is a required field').show();  
        }else{
            $('#msg_user_mobile').html('').hide();
        }





     return isValid;

 }

 function isValidEmailAddress(email) {
      var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      return regex.test(email);
 }
    
    


     </script>


  </head>
  <body>
  



<!--My-->
<div class="form-style">

<h1>Edit User</h1>

<? //echo "<pre>"."Here - ";print_r($records);exit;  ?>

<?PHP $attributes = array('id' => 'userform','name' => 'userform'); echo form_open_multipart('', $attributes); ?>
<table width="100%" border="0">
  <?php echo form_hidden('user_id',$user_id);?>
  <tr class="rowClass">
    <td align="left" valign="top" >Name:<span class="required">*</span></td>
    <td>&nbsp;</td>
    <td align="left">
        <?PHP echo form_input('user_name', set_value('user_name', $records->user_name),'class="input-field" id="user_name"');?>
        <span class="required" id="msg_user_name"></span>
    </td>
  </tr>

  <tr class="rowClass">
   <td align="left" valign="top" >Country:<span class="required">*</span></td>
    <td>&nbsp;</td>
    <td align="left">
        <?PHP echo form_input('user_country', set_value('user_country', $records->user_country),'class="input-field" id="user_country"');?>
        <span class="required" id="msg_user_country"></span>
    </td>
  </tr>
  
  <tr class="rowClass">
   <td align="left" valign="top" >Email:<span class="required">*</span></td>
    <td>&nbsp;</td>
    <td align="left">
        <?PHP echo form_input('user_email', set_value('user_email', $records->user_email),'class="input-field" id="user_email"');?>
        <span class="required" id="msg_user_email"></span>
    </td>
  </tr>

  <tr class="rowClass">
   <td align="left" valign="top" >Mobile Number:<span class="required">*</span></td>
    <td>&nbsp;</td>
    <td align="left">
        <?PHP echo form_input('user_mobile', set_value('user_mobile', $records->user_mobile),'class="input-field" id="user_mobile"');?>
        <span class="required" id="msg_user_mobile"></span>
    </td>
  </tr>

  <tr class="rowClass">
   <td align="left" valign="top" >About You:<span class="required">*</span></td>
    <td>&nbsp;</td>
    <td align="left">
        <?PHP echo form_input('user_about', set_value('user_about', $records->user_about),'class="input-field" id="user_about"');?>
        <span class="required" id="msg_user_about"></span>
    </td>
  </tr>

  <tr class="rowClass">
   <td align="left" valign="top" >Birthday:<span class="required">*</span></td>
    <td>&nbsp;</td>
    <td align="left">
        <?PHP echo form_input('user_bday', set_value('user_bday', $records->user_bday),'class="input-field" id="user_bday" ');?>
        <span class="required" id="msg_user_bday"></span>
    </td>
  </tr>
   
  <tr class="rowClass">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="left" valign="middle">
                  <input type="button" value="Submit" id="submit_btn" name="submit_btn">
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <?PHP echo form_reset('reset', 'Reset',''); ?>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <?PHP echo form_button('cancel_btn', 'Cancel','id="cancel_btn"'); ?>
    </td>
  </tr>

  
</table>

<div id="successMsg" title="Message" style="display:none;">
  <p>User record updated successfully.</p>
</div>

<?PHP echo form_close(); ?>   


</div>






  </body>
</html>