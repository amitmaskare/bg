function create_action()
{
  var admin_url=$('#admin_url').val();
  var floor=$('#floor').val();

    if(floor=="")
    {
        $("#floor_err").fadeIn().html("Required").css("color","red");
          setTimeout(function(){$("#floor_err").fadeOut("&nbsp;");},2000)
    
        $("#floor").focus();
        return false;
    } 
         var form_data= new FormData();
    
        form_data.append('floor',floor);
          $.ajax({
          type:"post",
          url:admin_url+"property/save_ageofproperty",
          cache:false,
          contentType: false,   
          processData:false,
          async:false,
          data:form_data,
          success:function(returndata)
          {

          if(returndata==1)
          {
          $('#floor').val('');
            location.reload();
           
          }
          else{
           $("#floor_err").fadeIn().html("This Property type already exits ").css("color","red");
          setTimeout(function(){$("#floor_err").fadeOut("&nbsp;");},2000)
            $("#floor").focus();
                  return false;
          }

            
          }
      });

}

function getValue(id)
{
   var admin_url = $("#admin_url").val();
    
        $.ajax({
          type:'post',
          cache:false,

          url:admin_url+'property/ageofpropertyValue',
          data:{
            id:id,
          },
          success:function(returndata)
          {

            var obj=$.parseJSON(returndata);

            $("#edit_floor").val(obj.floor);
            $("#id").val(obj.id);
           
          }
      });

}

function update_action()
{
  var admin_url=$('#admin_url').val();
  var floor=$('#edit_floor').val();
  
   var id=$("#id").val();
    if(floor=="")
    {
        $("#edit_floor_err").fadeIn().html("Required").css("color","red");
          setTimeout(function(){$("#edit_floor_err").fadeOut("&nbsp;");},2000)
    
        $("#edit_floor").focus();
        return false;
    } 
         var form_data= new FormData();
    
        form_data.append('floor',floor);
      
          form_data.append('id',id);
          $.ajax({
          type:"post",
          url:admin_url+"property/update_ageofproperty",
          cache:false,
          contentType: false,   
          processData:false,
          async:false,
          data:form_data,
          success:function(returndata)
          {

          if(returndata==1)
          {

            location.reload();
           
          }
          else{
           $("#edit_floor_err").fadeIn().html("This floor already exits ").css("color","red");
          setTimeout(function(){$("#edit_floor_err").fadeOut("&nbsp;");},2000)
            $("#edit_floor").focus();
                  return false;
          }

            
          }
      });

}




