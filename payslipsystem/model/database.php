<?php

/**
　* database
　*
　* This class are used to perform database related process
　* 
　* @author kulasekaran.
　*
　*/
class database {
	/**
	 * This databaseConnection method are used to get connection with database
	 * @return nothing will be return
	 * @author kulasekaran.
	 *
	 */
	public function databaseConnection()
	{
		$this->con = mysql_connect("localhost","root","") or die("Connection failed : ".mysql_error());
		mysql_select_db("payslip",$this->con);
		return $this->con;
	}

}
?>