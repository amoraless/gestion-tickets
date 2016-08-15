$(document).ready(function(){

  save_or_udate_tickets();
  getTickets();
  showModal();
  deleteTicktets();
  btnReset();
  filter_importance();
  search();
});
function save_or_udate_tickets(){
	$(document).on('submit','#form_tickets',function (event) {
		event.preventDefault();
		$("#form_tickets input[name='name']").prop("disabled",false);
		var tic_id=$.trim($("#form_tickets input[name='tic_id']").val());
		if(tic_id==""){
			save_tickets("insert")
		}else if (tic_id!=""  && tic_id>0){
			save_tickets("update")
		}
	});	
}
function save_tickets(acction) {
		var tic_id=$.trim($("#form_tickets input[name='tic_id']").val());
		var ls_id=$("#form_tickets select[name='ls_id']").val();
		var ls_name=$("#form_tickets select[name='ls_id'] > option[value='"+ls_id+"']").html();
		var tic_name=$("#form_tickets input[name='name']").val();
		var tic_description=$("#form_tickets textarea[name='description']").val();
		if(ls_id!="" && ls_name!="" && tic_name!="" && tic_description!=""){
			$.ajax({
		        type:'post',
		        dataType:'json',
		        url: "index.php?c=Tickets&a="+acction,
		        data: {
		          'ajax'	 		: true,
		          'tic_id'			: tic_id,
		          'ls_id'  			: ls_id,
		          'tic_name' 		: tic_name,
		          'tic_description' : tic_description,
		        },
		        success: function(data){
		        	if(acction=="insert"){
		        		listTickets("","","");
		        	}else if(acction=="update"){
		        		$("#tbl_tickets tbody tr#"+tic_id+" td:eq(1)").html(ls_id);
		        		$("#tbl_tickets tbody tr#"+tic_id+" td:eq(2)").html(ls_name);
		        		$("#tbl_tickets tbody tr#"+tic_id+" td:eq(3)").html(tic_name);
		        		$("#tbl_tickets tbody tr#"+tic_id+" td:eq(4)").html(tic_description);
		        	}
		        	$("#form_tickets input").val("");
		        	$("#form_tickets select").val("");
		        	$("#form_tickets textarea").val("");
		        	
		        	$("#form_tickets .message span").html("los datos se guardaron con éxito");
					$("#form_tickets .message span").addClass("text-success");
		        }
	      	});
		}else{
			$("#form_tickets .message span").html("los campos deben estar llenos");
			$("#form_tickets .message span").addClass("text-danger");
		}
	
}
function listTickets(filter,search,option){
	$.ajax({
        type:'post',
        dataType:'json',
        url: "index.php?c=Tickets&a=listTickets",
        data:{
        	'ajax' : true,
        	'filter':filter,
        	'search':search,
        	'option': option
        },
        success: function(data){
        	var html="";
	        $.each(data,function(index,row) {
	          	html+="<tr id='"+row.tic_id+"'>";
		          	html+="<td>"+(index+1)+"</td>";
		          	html+="<td class='ds-nn'>"+row.ls_id+"</td>";
		          	html+="<td>"+row.ls_name+"</td>";
		          	html+="<td>"+row.tic_name+"</td>";
		          	html+="<td>"+row.tic_description+"</td>";
		          	html+="<td>"
		          		html+="<a href='#' class='edit'>Editar</a>";
		          		html+="<a href='#' class='delete'>eliminar</a>";
		          	html+="</td>";
	          	html+="</tr>";
	        });
          $("#tbl_tickets tbody").html(html);
        }
      });
}
function getTickets(){
	$(document).on('click','#tbl_tickets tbody a.edit',function (event) {
		event.preventDefault();
		var index=$(this).parent().parent().index();
		$("#form_tickets input[name='name']").prop("disabled",true);
		var tic_id=$.trim($("#tbl_tickets tbody tr:eq("+index+")").attr("id"));
		$.ajax({
	        type:'post',
	        dataType:'json',
	        url: "index.php?c=Tickets&a=getTickets",
	        data: {
	          'ajax'	 		: true,
	          'tic_id'  		: tic_id
	        },
	        success: function(data){
	        	$("#form_tickets input[name='tic_id']").val(data[0].tic_id);
	        	$("#form_tickets select[name='ls_id']").val(data[0].ls_id);
				$("#form_tickets input[name='name']").val(data[0].tic_name);
				$("#form_tickets textarea[name='description']").val(data[0].tic_description);
	        }
      	});
		
	});
}

function showModal() {
		$(document).on('click','.show_delete',function(event){
			event.preventDefault();
			var index=$(this).parent().parent().index();
			var tic_id=$("#tbl_tickets tbody tr:eq("+index+")").attr("id");
			$("#myModal .confirm_delete").attr("id",tic_id);
		});
}
function deleteTicktets() {
	$(document).on("click","#myModal .confirm_delete",function(){
		var tic_id= $("#myModal .confirm_delete").attr("id");
		$.ajax({
	        type:'post',
	        dataType:'json',
	        url: "index.php?c=Tickets&a=delete",
	        data: {
	          'ajax'	 		: true,
	          'tic_id'  		: tic_id
	        },
	        success: function(data){
	        	$("#tbl_tickets tbody tr#"+tic_id).fadeOut("slow",function(){
	        		$("#tbl_tickets tbody tr#"+tic_id).remove();
	        	});
	        	$("#form_tickets .message span").html("El ticket fue eliminado con éxito");
				$("#form_tickets .message span").addClass("text-success");
	        }
      	});
	});
}
function btnReset(){
	$(document).on("click","button[type='reset']",function(){
		$("#form_tickets input[name='name']").prop("disabled",false);
	});
}
function filter_importance() {
	$(document).on("change",'select[name="ls_filtro"]',function() {
		var filter=$(this).val();
		listTickets(filter,"","");
	});
}
function search() {
	$(document).on("click",'button[name="btn_search"]',function() {
		var search=$("input[name='search']").val();
		var option=$("input[name='search_name']:checked").val();
		listTickets("",search,option);
	});
}