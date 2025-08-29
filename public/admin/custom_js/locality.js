function create_action()
{
	var admin_url=$('#admin_url').val();
	var cityId=$('#cityId').val();
	var name=$('#name').val();
	
    if(cityId=="")
    {
      	$("#city_err").fadeIn().html("Required").css("color","red");
          setTimeout(function(){$("#city_err").fadeOut("&nbsp;");},2000)

        $("#cityId").focus();
        return false;
    }
     if(name=="")
    {
      	$("#locality_err").fadeIn().html("Required").css("color","red");
          setTimeout(function(){$("#locality_err").fadeOut("&nbsp;");},2000)

        $("#name").focus();
        return false;
    }
    
         var form_data= new FormData();
	      form_data.append('cityId',cityId);
	      form_data.append('name',name);
	     
	      	$.ajax({
	        type:"post",
	        url:admin_url+"locality/create_action",
	        cache:false,
	        contentType: false,
	        processData:false,
	        async:false,
	        data:form_data,
	        success:function(returndata)
	        {

	        if(returndata==1)
	        {

	         $('#cityId').val('');
	         $('#name').val('');
	          location.reload();

	        }
	        else{
				$("#locality_err").fadeIn().html("This locality already exits !").css("color","red");
		          setTimeout(function(){$("#locality_err").fadeOut("&nbsp;");},2000)
					
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

	        url:admin_url+'locality/get_value',
	        data:{
	          id:id,
	        },
	        success:function(returndata)
	        {

		        var obj=$.parseJSON(returndata);

		        $("#editCityId").val(obj.cityId);
		        $("#edit_name").val(obj.name);
		        $("#id").val(obj.id);
		       
	        }
      });

}

function update_action()
{

	var admin_url=$('#admin_url').val();
	var cityId=$('#editCityId').val();
	var name=$('#edit_name').val();
   var id=$("#id").val();
    if(cityId=="")
    {
      	$("#edit_city_err").fadeIn().html("Required").css("color","red");
          setTimeout(function(){$("#edit_city_err").fadeOut("&nbsp;");},2000)

        $("#editCityId").focus();
        return false;
    }
     if(name=="")
    {
      	$("#edit_locality_err").fadeIn().html("Required").css("color","red");
          setTimeout(function(){$("#edit_locality_err").fadeOut("&nbsp;");},2000)

        $("#edit_name").focus();
        return false;
    }
     
         var form_data= new FormData();
    	
	      form_data.append('cityId',cityId);
	      form_data.append('name',name);
	     
	      	form_data.append('id',id);
	      	$.ajax({
	        type:"post",
	        url:admin_url+"locality/update_action",
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
	         $("#edit_locality_err").fadeIn().html("This locality already exits ").css("color","red");
          setTimeout(function(){$("#edit_locality_err").fadeOut("&nbsp;");},2000)
            $("#edit_name").focus();
                  return false;
	        }


	        }
	    });

}
