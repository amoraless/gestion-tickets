<?php 
class TicketsController
{
	public function index()
	{
		require_once("app/model/LevelSignificanceModel.php");
		$level_significance=new LevelSignificanceModel();

		require_once("app/model/TicketsModel.php");
		$tickets=new TicketsModel();

		$data['level_significance']= $level_significance->listLevel();
		$data['tickets']= $tickets->listTickets("","","");
		$data['view']="tickets/tickets.php";
		
		require_once("app/view/template.php");
	}
	public function insert()
	{
		if(isset($_REQUEST['ajax'])){
			require_once("app/model/TicketsModel.php");
			$tickets = new TicketsModel();

			$ls_id				=	trim($_REQUEST['ls_id']);
			$tic_name			=	trim($_REQUEST['tic_name']);
			$tic_description	=	trim($_REQUEST['tic_description']);
			
			$result  			=  	$tickets->insert($ls_id,$tic_name,$tic_description);

			echo json_encode($result);
		}else{
			header('Location: index.php');
		}
		
	}
	public function listTickets()
	{
		if(isset($_REQUEST['ajax'])){
			require_once("app/model/TicketsModel.php");
			$tickets=new TicketsModel();
			
			echo json_encode($tickets->listTickets($_REQUEST['filter'],$_REQUEST['search'],$_REQUEST['option']));
		}else{
		 	header('Location: index.php');
		}
	}
	public function getTickets()
	{
		if(isset($_REQUEST['ajax'])){
			require_once("app/model/TicketsModel.php");
			$tickets=new TicketsModel();
			$tic_id=trim($_REQUEST['tic_id']);
			echo json_encode($tickets->getTickets($tic_id));
		}else{
		 	header('Location: index.php');
		}
	}
	public function getId($value='')
	{
		# code...
	}
	public function update()
	{
		if(isset($_REQUEST['ajax'])){
			require_once("app/model/TicketsModel.php");
			$tickets = new TicketsModel();

			$tic_id				=	trim($_REQUEST['tic_id']);
			$ls_id				=	trim($_REQUEST['ls_id']);
			$tic_description	=	trim($_REQUEST['tic_description']);
			
			$result  			=  	$tickets->update($tic_id,$ls_id,$tic_description);

			echo json_encode($result);
		}else{
			header('Location: index.php');
		}
	}
	public function delete()
	{
		if(isset($_REQUEST['ajax'])){
			require_once("app/model/TicketsModel.php");
			$tickets = new TicketsModel();

			$tic_id				=	trim($_REQUEST['tic_id']);			
			$result  			=  	$tickets->delete($tic_id);

			echo json_encode($result);
		}else{
			header('Location: index.php');
		}
	}
}