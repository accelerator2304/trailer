<?php
class Suplier extends Model {

	function Schema(){
		$this->Fields = array(
			'id' => 'integer',
			'name' => 'varchar'
		);

		$this->Associations = array(
			'suplier_site' => 'has_many',
			'suplier_bill' => 'has_many'
		);

		$this->Indexes = array(
			'id' => 'primary'
		);
	}

}
?>