function create_city()
{
	var admin_url=$('#admin_url').val();
	var city_name=$('#city_name').val();

    if(city_name=="")
    {
      	$("#city_err").fadeIn().html("Required").css("color","red");
          setTimeout(function(){$("#city_err").fadeOut("&nbsp;");},2000)
    
        $("#city_name").focus();
        return false;
    } 
         var form_data= new FormData();
    
	      form_data.append('city_name',city_name);
	      	$.ajax({
	        type:"post",
	        url:admin_url+"city/create_action",
	        cache:false,
	        contentType: false,   
	        processData:false,
	        async:false,
	        data:form_data,
	        success:function(returndata)
	        {

	        if(returndata==1)
	        {
	        $('#city_name').val('');
	          location.reload();
	         
	        }
	        else{
	         $("#city_err").fadeIn().html("This city already exits ").css("color","red");
          setTimeout(function(){$("#city_err").fadeOut("&nbsp;");},2000)
            $("#city_name").focus();
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

	        url:admin_url+'city/get_value',
	        data:{
	          id:id,
	        },
	        success:function(returndata)
	        {

		        var obj=$.parseJSON(returndata);

		        $("#edit_city_name").val(obj.city_name);
		        $("#id").val(obj.id);
		       
	        }
      });

}

function update_city()
{
	var admin_url=$('#admin_url').val();
	var city_name=$('#edit_city_name').val();
	
   var id=$("#id").val();
    if(city_name=="")
    {
      	$("#edit_city_err").fadeIn().html("Please enter city Name").css("color","red");
          setTimeout(function(){$("#edit_city_err").fadeOut("&nbsp;");},2000)
    
        $("#edit_city_name").focus();
        return false;
    } 
         var form_data= new FormData();
    
	      form_data.append('city_name',city_name);
	    
	      	form_data.append('id',id);
	      	$.ajax({
	        type:"post",
	        url:admin_url+"city/update_action",
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
	         $("#edit_city_err").fadeIn().html("This city already exits ").css("color","red");
          setTimeout(function(){$("#edit_city_err").fadeOut("&nbsp;");},2000)
            $("#edit_city_name").focus();
                  return false;
	        }

	          
	        }
	    });

}

