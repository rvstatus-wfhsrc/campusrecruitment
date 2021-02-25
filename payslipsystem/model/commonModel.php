<?php

/**
　* common Model
　*
　* This Model are used to perform commonly
　* 
　* @author kulasekaran.
　*
　*/
class commonModel {

	/**
	 * This getYear method are used get the all available years 
	 * @return a $yearArray value to called function on any controller
	 * @author kulasekaran.
	 *
	 */
	public function getYear()
	{
		$inserted = array('' => 'Select Year');
		$original = array_combine(range(date("Y"), date("Y")-1), range(date("Y"), date("Y")-1));
		$yearArray = $inserted+$original;
		return $yearArray;
	}

	/**
	 * This getEmpIDColor method are used to apply the color for employee id
	 * @param it contains the employee id
	 * @return the color
	 * @author kulasekaran.
	 *
	 */
	public function getEmpIDColor($empID) {
        $empsub=substr($empID,0,2);
        if($empsub=="MB"){
            return "#0000FF";
        } elseif($empsub=="AD"){
            return "#04B404";
        }else{
            return "#AC4E00";
        }
    }

}
?>