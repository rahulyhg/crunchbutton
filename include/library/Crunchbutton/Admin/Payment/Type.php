<?php

class Crunchbutton_Admin_Payment_Type extends Cana_Table {

	const PAYMENT_METHOD_DEPOSIT = 'deposit';
	const PAYMENT_TYPE_HOURS = 'hours';
	const PAYMENT_TYPE_ORDERS = 'orders';

	public function __construct($id = null) {
		parent::__construct();
		$this
			->table('admin_payment_type')
			->idVar('id_admin_payment_type')
			->load($id);
	}

	function byAdmin( $id_admin ){
		if( $id_admin ){
			$payment = Crunchbutton_Admin_Payment_Type::q( 'SELECT * FROM admin_payment_type WHERE id_admin = ' . $id_admin . ' ORDER BY id_admin_payment_type DESC LIMIT 1' );
			if( $payment->id_admin_payment_type ){
				return Crunchbutton_Admin_Payment_Type::o( $payment->id_admin_payment_type );
			}
		}
		return false;
	}
}