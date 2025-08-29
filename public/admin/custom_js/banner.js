function create_banner()
{
	var admin_url=$('#admin_url').val();
	var name=$('#name').val();
	var image=$('#image').val();

   
     if(image=="")
    {
      	$("#image_err").fadeIn().html("Required").css("color","red");
          setTimeout(function(){$("#image_err").fadeOut("&nbsp;");},2000)
    
        $("#image").focus();
        return false;
    } 
         var form_data= new FormData();
    	var image=$('#image')[0].files[0];
	      form_data.append('image',image);
	      form_data.append('name',name);
	      	$.ajax({
	        type:"post",
	        url:admin_url+"manage_home/Banner/create_action",
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
	        	$('#image').val('');
	          location.reload();
	         
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

	        url:admin_url+'manage_home/Banner/get_value',
	        data:{
	          id:id,
	        },
	        success:function(returndata)
	        {

		        var obj=$.parseJSON(returndata);

		        $("#edit_name").val(obj.heading);
		        $("#id").val(obj.id);
		        $("#show_img").html(obj.image);
		        $("#old_image").val(obj.old_image);
	        }
      });

}

function update_banner()
{
	var admin_url=$('#admin_url').val();
	var name=$('#edit_name').val();
	 var old_image=$("#old_image").val();
   var id=$("#id").val();
     
         var form_data= new FormData();
    	var image=$('#edit_image')[0].files[0];
	      form_data.append('image',image);
	      form_data.append('name',name);
	      form_data.append('old_image',old_image);
	      	form_data.append('id',id);
	      	$.ajax({
	        type:"post",
	        url:admin_url+"manage_home/Banner/update_action",
	        cache:false,
	        contentType: false,   
	        processData:false,
	        async:false,
	        data:form_data,
	        success:function(returndata)
	        {

	        if(returndata==1)
	        {
	        	$('#edit_name').val('');
	        	$('#edit_image').val('');
	          location.reload();
	         
	        }
	        
	        }
	    });

}

