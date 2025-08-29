function addOwner()
{
  var admin_url=$('#admin_url').val();
  var owner_name=$('#owner_name').val();
  var phone=$('#phone').val();
  var segment=$('#segment').val();
  
    if(owner_name=="")
    {
        $("#owner_err").fadeIn().html("Required").css("color","red");
          setTimeout(function(){$("#owner_err").fadeOut("&nbsp;");},2000)

        $("#owner_name").focus();
        return false;
    }
     if(phone=="")
    {
        $("#phone_err").fadeIn().html("Required").css("color","red");
          setTimeout(function(){$("#phone_err").fadeOut("&nbsp;");},2000)

        $("#phone").focus();
        return false;
    }
    if(phone.length!=10)
    {
        $("#phone_err").fadeIn().html("Please Enter 10 digit number").css("color","red");
          setTimeout(function(){$("#phone_err").fadeOut("&nbsp;");},2000)

        $("#phone").focus();
        return false;
    }
          $.ajax({
          type:"post",
          url:admin_url+"users/create_action",
          cache:false,
          data:{owner_name:owner_name,phone:phone,segment:segment},
          success:function(returndata)
          {

          if(returndata==1)
          {
           $('#createModal').modal('hide');
         //  getOwnerList();
          alert_func(["Added Successfully",'success',"#A5DC86"]);
           getOwnerList();
         
           $('#owner_name').val('');
           $('#phone').val('');

          }
          else{
            alert_func(["Phone already exits", "error", "#DD6B55"]); 
          }
          
          }
      });

}

getOwnerList();
function getOwnerList()
{
    var admin_url = $("#admin_url").val();
    var button = $("#button").val();
    if(button=='Update')
    {
        var userId=$('#userId1').val();
    }
    else{
        var userId='';
    }
    
   $.ajax({
       type:"post",
       cache:false,
       url:admin_url+'property/getOwnerData',
       data:{userId:userId},
       beforeSend:function(){},
       success:function(returndata)
       {
           $('#userId').html(returndata);
       }
   });
}

function getTypeValue(val)
    {
      if(val==1)
      {
        $('#showDeposit').show();
      }
      if(val==2)
      {
        $('#showDeposit').hide();
      }
    }

 $("#carpetarea").on("input", function(e) {
        var carpetarea=$('#carpetarea').val();
        var builtuparea=$('#builtuparea').val();
        if(parseFloat(builtuparea)<parseFloat(carpetarea))
        {
           swal({
           title: "Built area should be greater than carpet area.",
           type: "warning",
           confirmButtonColor: '#A5DC86',
           closeOnConfirm: true,
       }, function(isConfirm){
           if (isConfirm) {
               swal.close();
           }
       });
           $('#btnhide').prop('disabled', true);
             
        }
        else{
        $('#btnhide').removeAttr('disabled',true);
          
        }
       });

function multiple_image(id)
{
   
    var admin_url=$('#admin_url').val();
  var ask = confirm("Do you want to delete this image ?");
  if(ask==true)
  {
    
    $.ajax({
        type:"POST",
        url:admin_url+'property/multipleimg_delete',
        data:{id:id},
        cache:false,
        success:function(returndata)
        {
         $('#deleteImg'+id).fadeOut('fast');
        }
      });
  }
}


