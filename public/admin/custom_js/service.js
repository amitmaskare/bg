function create_service()
{
	var admin_url=$('#admin_url').val();
	var service_name=$('#service_name').val();

    if(service_name=="")
    {
      	$("#service_err").fadeIn().html("Required").css("color","red");
          setTimeout(function(){$("#service_err").fadeOut("&nbsp;");},2000)
    
        $("#service_name").focus();
        return false;
    } 
         var form_data= new FormData();
    
	      form_data.append('service_name',service_name);
	      	$.ajax({
	        type:"post",
	        url:admin_url+"master/create_action",
	        cache:false,
	        contentType: false,   
	        processData:false,
	        async:false,
	        data:form_data,
	        success:function(returndata)
	        {

	        if(returndata==1)
	        {
	        $('#service_name').val('');
	          location.reload();
	         
	        }
	        else{
	         $("#service_err").fadeIn().html("This service already exits ").css("color","red");
          setTimeout(function(){$("#service_err").fadeOut("&nbsp;");},2000)
            $("#service_name").focus();
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

	        url:admin_url+'master/get_value',
	        data:{
	          id:id,
	        },
	        success:function(returndata)
	        {

		        var obj=$.parseJSON(returndata);

		        $("#edit_service_name").val(obj.service_name);
		        $("#id").val(obj.id);
		       
	        }
      });

}

function update_service()
{
	var admin_url=$('#admin_url').val();
	var service_name=$('#edit_service_name').val();
	
   var id=$("#id").val();
    if(service_name=="")
    {
      	$("#edit_service_err").fadeIn().html("Required").css("color","red");
          setTimeout(function(){$("#edit_service_err").fadeOut("&nbsp;");},2000)
    
        $("#edit_service_name").focus();
        return false;
    } 
         var form_data= new FormData();
    
	      form_data.append('service_name',service_name);
	    
	      	form_data.append('id',id);
	      	$.ajax({
	        type:"post",
	        url:admin_url+"master/update_action",
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
	         $("#edit_service_err").fadeIn().html("This service already exits ").css("color","red");
          setTimeout(function(){$("#edit_service_err").fadeOut("&nbsp;");},2000)
            $("#edit_service_name").focus();
                  return false;
	        }

	          
	        }
	    });

}

 function deleteservice(serviceId) {
 	
  var admin_url=$('#admin_url').val();
    swal({
      title: 'Are You sure want to delete ?',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#A5DC86',
      cancelButtonColor: '#DD6B55',
      confirmButtonText: 'Yes',
      cancelButtonText: 'No',
      closeOnConfirm: true,
      closeOnCancel: true
    }, function(isConfirm) {
      if (isConfirm) {
        window.location.href = admin_url+'services/deleteservice/'+serviceId;
      }
    });
  }


function create_subcategory()
{
	var admin_url=$('#admin_url').val();
	var serviceId=$('#serviceId').val();
	var subcategory=$('#subcategory').val();

    if(serviceId=="")
    {
      	$("#serviceId_err").fadeIn().html("Required").css("color","red");
          setTimeout(function(){$("#serviceId_err").fadeOut("&nbsp;");},2000)
    
        $("#serviceId").focus();
        return false;
    } 
    if(subcategory=="")
    {
      	$("#subcategory_err").fadeIn().html("Required").css("color","red");
          setTimeout(function(){$("#subcategory_err").fadeOut("&nbsp;");},2000)
    
        $("#subcategory").focus();
        return false;
    } 
         var form_data= new FormData();
    
	      form_data.append('serviceId',serviceId);
	      form_data.append('subcategory',subcategory);
	      	$.ajax({
	        type:"post",
	        url:admin_url+"services/addsubcategory",
	        cache:false,
	        contentType: false,   
	        processData:false,
	        data:form_data,
	        success:function(returndata)
	        {

	        if(returndata==1)
	        {
	        $('#serviceId').val('');
	        $('#subcategory').val('');
	          location.reload();
	         
	        }
	        else{
	         $("#subcategory_err").fadeIn().html("This subcategory already exits ").css("color","red");
          setTimeout(function(){$("#subcategory_err").fadeOut("&nbsp;");},2000)
            $("#subcategory").focus();
                  return false;
	        }

	          
	        }
	    });

}

function getsubcategory(subcategoryId)
{
	 var admin_url = $("#admin_url").val();
    
        $.ajax({
	        type:'post',
	        cache:false,

	        url:admin_url+'services/getsubcategory',
	        data:{
	          subcategoryId:subcategoryId,
	        },
	        success:function(returndata)
	        {

		        var obj=$.parseJSON(returndata);

		        $("#editserviceId").val(obj.serviceId);
		        $("#editsubcategory").val(obj.subcategory);
		        $("#subcategoryId").val(obj.subcategoryId);
		       
	        }
      });

}

function update_subcategory()
{
	var admin_url=$('#admin_url').val();
	var serviceId=$('#editserviceId').val();
	var subcategory=$('#editsubcategory').val();
   var subcategoryId=$("#subcategoryId").val();
    if(serviceId=="")
    {
      	$("#editserviceId_err").fadeIn().html("Required").css("color","red");
          setTimeout(function(){$("#editserviceId_err").fadeOut("&nbsp;");},2000)
    
        $("#editserviceId").focus();
        return false;
    } 
     if(subcategory=="")
    {
      	$("#editsubcategory_err").fadeIn().html("Required").css("color","red");
          setTimeout(function(){$("#editsubcategory_err").fadeOut("&nbsp;");},2000)
    
        $("#editsubcategory").focus();
        return false;
    } 
         var form_data= new FormData();
    
	      form_data.append('serviceId',serviceId);
	      form_data.append('subcategory',subcategory);
	    	form_data.append('subcategoryId',subcategoryId);
	      	$.ajax({
	        type:"post",
	        url:admin_url+"services/updatesubcategory",
	        cache:false,
	        contentType: false,   
	        processData:false,
	        data:form_data,
	        success:function(returndata)
	        {

	        if(returndata==1)
	        {

	          location.reload();
	         
	        }
	        else{
	         $("#editsubcategory_err").fadeIn().html("This service already exits ").css("color","red");
          setTimeout(function(){$("#editsubcategory_err").fadeOut("&nbsp;");},2000)
            $("#editsubcategory").focus();
                  return false;
	        }

	          
	        }
	    });

}

function deletesubcategory(subcategoryId) {
  var admin_url=$('#admin_url').val();
    swal({
      title: 'Are You sure want to delete ?',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#A5DC86',
      cancelButtonColor: '#DD6B55',
      confirmButtonText: 'Yes',
      cancelButtonText: 'No',
      closeOnConfirm: true,
      closeOnCancel: true
    }, function(isConfirm) {
      if (isConfirm) {
        window.location.href = admin_url+'services/deletesubcategory/'+subcategoryId;
      }
    });
  }




