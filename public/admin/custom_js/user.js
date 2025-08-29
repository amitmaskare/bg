function status(id)
{
	var admin_url = $("#admin_url").val();
  var cnf = confirm('Are you sure to change the status?');
  var status=$("#status"+id).val();
  if(cnf==true)
  {
  	 $.ajax({
        type:"POST",
        url:admin_url+"users/change_status",
        data:{id:id,status:status,},
        cache:false,
        success:function(returndata)
        {
        	table.draw();
        }
      });
  }
}

function Delete(obj,cid)
{
  var admin_url=$('#admin_url').val();
  var ask = confirm("Do you want to delete this record?");
  if(ask==true)
  {
    $(".id"+cid).fadeOut();
    var datastring="cid="+cid;
    $.ajax({
        type:"POST",
        url:admin_url+'users/delete',
        data:datastring,
        cache:false,
        success:function(returndata)
        {
          table.draw();

        }
      });
  }
}
