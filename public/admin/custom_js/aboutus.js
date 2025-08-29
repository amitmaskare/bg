function create_about()
{
	var admin_url=$('#admin_url').val();
	var title=$('#title').val();
	 var description=$('#description').val();

    if(title=="")
    {
      	$("#title_err").fadeIn().html("Please Enter title").css("color","red");
          setTimeout(function(){$("#title_err").fadeOut("&nbsp;");},2000)
    
        $("#title").focus();
        return false;
    } 
    if(description=="")
      {
          $("#description_err").fadeIn().html("Please enter description").css('color','red');
          setTimeout(function(){$("#description_err").html("&nbsp;");},3000);
          $("#description").focus();
          return false;
      }
         var form_data= new FormData();

	      form_data.append('title',title);
	       form_data.append('description',description);
	      	$.ajax({
	        type:"post",
	        url:admin_url+"manage_home/aboutus/create_action",
	        cache:false,
	        contentType: false,   
	        processData:false,
	        async:false,
	        data:form_data,
	        success:function(returndata)
	        {

	        if(returndata==1)
	        {
            $('#title').val('');
            $('#description').val('');
	          location.reload();
	         
	        }
	        else{
	         $("#title_err").fadeIn().html("This title already exits ").css("color","red");
          setTimeout(function(){$("#title_err").fadeOut("&nbsp;");},2000)
            $("#title").focus();
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

        url:admin_url+'manage_home/aboutus/get_value',
        data:{
          id:id,
        },
        success:function(returndata)
        {
         var obj=$.parseJSON(returndata);
         if(obj.id==3)
         {
          $('#if_video').show();
           $("#show_video").html(obj.video);
            $("#old_video").val(obj.old_video);
          
         }else{
         
            $('#if_video').hide();
         }
         $("#edit_title").val(obj.title);
          $("#id").val(obj.id);
        
       $("#edit_description").summernote("code", obj.description);
        }
      })
 }

 function update_about()
  {
      var admin_url = $("#admin_url").val();
      var title=$("#edit_title").val().trim();    
      var id=$("#id").val(); 
      var description=$('#edit_description').val();
      var old_video=$("#old_video").val();
      if(title=="")
      {
          $("#edit_title_err").fadeIn().html("Please enter title").css('color','red');
          setTimeout(function(){$("#edit_title_err").html("&nbsp;");},3000);
          $("#edit_title").focus();
          return false;
      }
       if(description=="")
      {
          $("#edit_description_err").fadeIn().html("Please enter description").css('color','red');
          setTimeout(function(){$("#edit_description_err").html("&nbsp;");},3000);
          $("#edit_description").focus();
          return false;
      }
       var form_data= new FormData();
        var video=$('#video')[0].files[0];
        form_data.append('video',video);
        form_data.append('old_video',old_video);
      form_data.append('title',title); 
     form_data.append('description',description);
      form_data.append('id',id);
      
      $.ajax({
        type:'post',
        cache:false,
        contentType: false,   
        processData:false,
        url:admin_url+'manage_home/aboutus/update_action',
        data:form_data,
        success:function(returndata)
        {
          if(returndata==1)
          {
            location.reload();
          }
          else
          {
             $("#edit_title_err").fadeIn().html("This title already exits").css('color','red');
          setTimeout(function(){$("#edit_title_err").html("&nbsp;");},3000);
          $("#edit_title").focus();
          return false;
          }
        }
      })
  }

  