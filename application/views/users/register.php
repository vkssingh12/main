<style>
    p {
        margin: 0 0 0px;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Register</h3>
                </div>
                <?php if($this->session->flashdata('msg_success')) { ?>
                    <div class="alert alert-success">
                         <?php echo $this->session->flashdata('msg_success'); ?>       
                    </div>
                 <?php } ?>
                 <?php if($this->session->flashdata('msg_error')) { ?>
                    <div class="alert alert-danger">
                         <?php echo $this->session->flashdata('msg_error'); ?>       
                    </div>
                <?php } ?>
                <div class="panel-body">
                           <form method="post" action="<?php echo base_url()?>register " enctype="multipart/form-data">
                    <fieldset>

                        <div class="form-group">
                            <label class="control-label" ></label>
                            <input class="form-control" placeholder="Enter First Name" name="firstname" type="text" autofocus>
                        <span class="error"><?php echo form_error('firstname'); ?></span>
                        </div>

                        <div class="form-group ">
                            <label class="control-label" ></label>
                            <input class="form-control" placeholder="Enter Last Name" name="lastname" type="text" >
                             <span class="error"><?php echo form_error('lastname'); ?></span>
                        </div>

                          <div class="form-group ">
                            <label class="control-label"></label>
                            <input class="form-control" placeholder="Phone no" name="phone_no" type="text" value="<?php echo set_value('phone_no'); ?>" id="phone_no">
                        </div>


                        <div class="form-group ">
                            <label class="control-label"></label>
                            <input class="form-control" placeholder="E-mail" name="email" type="email" id="email" value="">
                        </div>

                       
                         <div class="form-group ">
                            <label class="control-label"></label>
                            <input class="form-control" placeholder="Password" name="password" type="password">
                        </div>

                           <div class="form-group ">
                            <label class="control-label" ></label>

                            <textarea class="form-control" placeholder="Address" name="address"></textarea>
                     
                        </div>


                       <div class="form-group">
                            <input class="form-control" placeholder="dob" name="dob" type="date" value="" name="date" id="dob" onchange="ageCalculator()" required="true">
                            <span id="message"></span>
                            <p><span id="result" style="color:red;"></span></p>
                        </div>



                         <div class="form-group ">
                            <label class="control-label" >Resume upload</label>
                            <input class="form-control" placeholder="Resume" name="resume" type="file" value="">
                        </div>


                           <div class="form-group ">
                            <label class="control-label" for="inputError">Gender</label>
                            <input type="radio" id="" name="gender" value="Male" checked="checked" >Male
                            <input type="radio" id="" name="gender" value="Female">Female
                        </div>




                 

                         <div class="form-group ">
                      
                            <input class="form-control" placeholder="file upload"  type="file" value="" name="profile_image" id="cropzee-input">
                            
                            <div id="" class="image-previewer" >
                                <img src="" id="cropbox" class="img" style="height:100px;width:100px;" /><br />
                            </div>
                             <div id="btn">
        <input type='button' id="crop" value='CROP'>
    </div>
    <div>
        <img src="#" id="cropped_img" style="display: none;">
    </div>
                        </div>


                        <button class="btn btn-success btn-block" type="submit" name="sub">Register</button>
                        <div style="padding-top: 10px;">
                        <a href="<?php echo base_url('users/login');?>" class="pull-right"><label style="cursor: pointer;">Login</label></a>
                        </div>
                    </fieldset>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script> 
function ageCalculator() {  
    var userinput = document.getElementById("dob").value;  
    var dob = new Date(userinput);  
    if(userinput==null || userinput=='') {  
      document.getElementById("message").innerHTML = "**Choose a date please!";    
      return false;   
    } else {  
      
    //calculate month difference from current date in time  
    var month_diff = Date.now() - dob.getTime();  
      
    //convert the calculated difference in date format  
    var age_dt = new Date(month_diff);   
      
    //extract year from date      
    var year = age_dt.getUTCFullYear();  
      
    //now calculate the age of the user  
    var age = Math.abs(year - 1970);  
    if(age<18)
    {
        alert("Sorry you are not eligible");
        document.getElementById("dob").value="";
        document.getElementById("message").innerHTML = "**you are not eligible!allowed only 18+"; 


    }
      
    //display the calculated age  
    return document.getElementById("result").innerHTML = "Age is: " + age + " years. ";  
    }  
    }
</script> 
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script type="text/javascript">
   const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');
image = document.getElementById("source");
ctx.drawImage(image, 33, 71, 104, 124, 21, 20, 87, 104);

function readURL() {
          var myimg = document.getElementById("source");
          var input = document.getElementById("myfile");
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
            console.log("changed");
              myimg.src = e.target.result;
              drawimg(e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
          }
}

document.querySelector('#myfile').addEventListener('change',function(){
    readURL()
});


function drawimg(idata) {
  var img = new Image();
  img.onload = function(){
    ctx.drawImage(img, 33, 71, 104, 124, 21, 20, 87, 104);
  };
  img.src = idata;
}
  $(document).ready(function(){

    $("#cropzee-input").change(function(){
//        var name = document.getElementById("cropzee-input").files[0].name;
//        var form_data = new FormData();
//        var img1= $(this).val();
// alert(name);
//     $("#cropbox1").attr('src',name);  
 // if (this.files && this.files[0]) {
 //            var reader = new FileReader();
 //            reader.onload = function (e) {
 //                $('#cropbox').attr('src', e.target.result);
 //            }
 //            reader.readAsDataURL(this.files[0]);
 //        }   
 var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("cropzee-input").files[0]);
  var f = document.getElementById("cropzee-input");
  var c = document.getElementById("cropbox");

  
 //
  $("#cropbox").attr("src",f);
  const reader = new FileReader();
        reader.onload = e => {
            console.log("changed");
            c.src = e.target.result;

        };
        reader.readAsDataURL(f.files[0]);

    });
        var size;
        $('#cropbox').Jcrop({
          aspectRatio: 1,
          onSelect: function(c){
           size = {x:c.x,y:c.y,w:c.w,h:c.h};   
           $("#crop").css("visibility", "visible");  
          }
        });
     
        $("#crop").click(function(){
            var img = $("#cropbox").attr('src');
            $("#cropped_img").show();
           x=size.x;
           y=size.y;
           w=size.w;
           h=size.h;
            $("#cropped_img").attr('src','<?=base_url()?>assets/image-crop.php?x='+x+'&y='+y+'&w='+w+'&h='+h+'&img='+img);
            $("#cropzee-input").attr('value','<?=base_url()?>assets/image-crop.php?x='+x+'&y='+y+'&w='+w+'&h='+h+'&img='+img);
           
        });
  });
</script>
<script type="text/javascript">
    $("#phone_no").keydown(function(){
        var phone_no=$("#phone_no").val();
      //  alert(phone_no);
        var pattern=/^[6-9]{1}[0-9]{8}$/;
    if(pattern.test(phone_no)==true)
    {
        $(this).attr("style","border:1px solid green");
    }
    else
    {
         $(this).attr("style","border:1px solid red");
         $(this).attr("required","true");

    }
    });
    $("#email").keyup(function(){
        var email=$("#email").val();
      //  alert(phone_no);
        var pattern=/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
;
if($(this).val()=="")
{
      $(this).attr("style","border:1px solid red");
         $(this).attr("required","true");
}
else
{
    if(pattern.test(email)==true)
    {
        $(this).attr("style","border:1px solid green");
    }
    else
    {
         $(this).attr("style","border:1px solid red");
         $(this).attr("required","true");

    }
}
    });
</script>
<script>
 // Init Simple Cropper
$('.cropme').simpleCropper();

$('#portrait').hide();
$('.switch').click(function (){
    $(this).text("Switch to "+($('#portrait').is(":visible") ? "Portrait" : "Landscape"));
  $('#portrait').toggle();
  $('#landscape').toggle();
});
</script>