<?php

// Make Info for 1099s #4488

class Controller_Api_Script_InfoFor1099 extends Crunchbutton_Controller_RestAccount {

	const YEAR = 2015;

	public function init() {

		if( !c::admin()->permission()->check( [ 'global' ] ) ){
			return false;
		}


		$this->year = ( c::getPagePiece( 3 ) ? c::getPagePiece( 3 ) : Controller_Api_Script_InfoFor1099::YEAR );

		$this->inforFor1099();

	}

	public function inforFor1099(){

		$query = 'SELECT
							  p.id_driver,
							  a.name,
							  a.phone,
							  a.email,
							  SUM( amount ) AS payment
							  FROM payment p
							  INNER JOIN admin a ON a.id_admin = p.id_driver
							  WHERE YEAR( p.date ) = ' . $this->year . ' AND p.pay_type = "payment" AND p.balanced_id IS NOT NULL AND p.env = "live" AND p.balanced_status = "succeeded"
							GROUP BY id_driver
							ORDER BY a.name ASC';

		$payments = c::db()->get( $query );
		$out = [];
		$out[] = join( ';', [	'ID', 'Name', 'SSN','Amount', 'Phone', 'Email' ] );
		foreach( $payments as $payment ){
			$driver = Admin::o( $payment->id_driver );
			$ssn = $driver->ssn();
			$out[] = join( ';', [	$payment->id_driver,
														$payment->name,
														$ssn,
														$payment->payment,
														$payment->phone,
														$payment->email
								] );
		}
		header('Expires: 0');
		header('Cache-control: private');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Content-Description: File Transfer');
		header('Content-Type: text/csv');
		header('Content-disposition: attachment; filename="info-for-1099-year-' . $this->year . '.csv"');

		echo preg_replace(["/\r\n/","/\r/"],["\n","\n"], join( "\n", $out ) );
	}
}