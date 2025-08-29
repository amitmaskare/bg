function create_action()
{
  var admin_url=$('#admin_url').val();
  var name=$('#name').val();
  var type=$('#type').val();
  var property_type=$('#property_type').val();

    if(name=="")
    {
        $("#name_err").fadeIn().html("Required").css("color","red");
          setTimeout(function(){$("#name_err").fadeOut("&nbsp;");},2000)
    
        $("#name").focus();
        return false;
    } 
         var form_data= new FormData();
    
        form_data.append('name',name);
        form_data.append('type',type);
        form_data.append('property_type',property_type);
          $.ajax({
          type:"post",
          url:admin_url+"property/save_propertytype",
          cache:false,
          contentType: false,   
          processData:false,
          async:false,
          data:form_data,
          success:function(returndata)
          {

          if(returndata==1)
          {
          $('#name').val('');
          $('#type').val('');
          $('#property_type').val('');
            location.reload();
           
          }
          else{
           $("#name_err").fadeIn().html("This Property type already exits ").css("color","red");
          setTimeout(function(){$("#name_err").fadeOut("&nbsp;");},2000)
            $("#name").focus();
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

          url:admin_url+'property/propertyTypeValue',
          data:{
            id:id,
          },
          success:function(returndata)
          {

            var obj=$.parseJSON(returndata);

            $("#edit_name").val(obj.name);
            $("#edit_type").val(obj.type);
            $("#editproperty_type").val(obj.property_type);
            $("#id").val(obj.id);
           
          }
      });

}

function update_action()
{
  var admin_url=$('#admin_url').val();
  var name=$('#edit_name').val();
  var type=$('#edit_type').val();
  var property_type=$('#editproperty_type').val();
  
   var id=$("#id").val();
    if(name=="")
    {
        $("#edit_name_err").fadeIn().html("Required").css("color","red");
          setTimeout(function(){$("#edit_name_err").fadeOut("&nbsp;");},2000)
    
        $("#edit_name").focus();
        return false;
    } 
         var form_data= new FormData();
    
        form_data.append('name',name);
        form_data.append('type',type);
        form_data.append('property_type',property_type);
      
          form_data.append('id',id);
          $.ajax({
          type:"post",
          url:admin_url+"property/update_propertytype",
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
           $("#edit_name_err").fadeIn().html("This city already exits ").css("color","red");
          setTimeout(function(){$("#edit_name_err").fadeOut("&nbsp;");},2000)
            $("#edit_name").focus();
                  return false;
          }

            
          }
      });

}

