function create_action()
{
	var admin_url=$('#admin_url').val();
	var name=$('#name').val();

    if(name=="")
    {
      	$("#name_err").fadeIn().html("Required").css("color","red");
          setTimeout(function(){$("#name_err").fadeOut("&nbsp;");},2000)
    
        $("#name").focus();
        return false;
    } 
         var form_data= new FormData();
    
	      form_data.append('name',name);
	      	$.ajax({
	        type:"post",
	        url:admin_url+"property/save_amenities",
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
	          location.reload();
	         
	        }
	        else{
	         $("#name_err").fadeIn().html("This amenities already exits ").css("color","red");
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

	        url:admin_url+'property/amenitiesValue',
	        data:{
	          id:id,
	        },
	        success:function(returndata)
	        {

		        var obj=$.parseJSON(returndata);

		        $("#edit_name").val(obj.name);
		        $("#id").val(obj.id);
		       
	        }
      });

}

function update_action()
{
	var admin_url=$('#admin_url').val();
	var name=$('#edit_name').val();
	
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
	    
	      	form_data.append('id',id);
	      	$.ajax({
	        type:"post",
	        url:admin_url+"property/update_amenities",
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
	         $("#edit_name_err").fadeIn().html("This amenities already exits ").css("color","red");
          setTimeout(function(){$("#edit_name_err").fadeOut("&nbsp;");},2000)
            $("#edit_name").focus();
                  return false;
	        }

	          
	        }
	    });

}

