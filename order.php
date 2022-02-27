<?php 
	
	include 'backend/function.php';
	include 'backend/dbconfig.php';

	$cart = $_POST['cart'];
	$cartarr = json_decode($cart);

	$voucherno = uniqid();
	$total = 0;
	foreach ($cartarr as $value) {
		if ($value!=NULL) {
			
		$odetail =array(
			'voucherno' => $voucherno,
			'bookid' => $value->id,
			'qty' => $value->quantity,
			'perprice' =>$value->perprice
		);

		$total +=($value->quantity * $value->perprice);
		$table = 'orderdetails';
		insert($table,$odetail,$connection);
	}
	}

	if ($total > 0) {
		$table = 'orders';
		$new_order = array(
			'voucherno' => $voucherno,
			'customerid' =>1,
			'total' => $total
		);

		insert($table,$new_order,$connection);
	}
	echo 'success';
?>