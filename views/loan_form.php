<?php
$form = '<form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post">
	<input type = hidden name="ac" value = "loan_save">
	';
$form .= 
	USER_ID.': <input type="text" name="user_ID" value="'; 
if(isset($this->aRow['user_ID'])){
	$form .= $oObject->aRow['user_ID'];
} 
$form .= '"> <br>'.
	TYPE.': <input type="radio" id="book" name="type" value="book"';
if ($this->aRow['type']== "book"){
	 $form .= 'checked';
}
$form .= '>
	<label for="book">'.BOOK.'</label>
	<input type="radio" id="material" name="type" value="material"'; 
if ($this->aRow['type']=="material"){
	$form .= 'checked';
}
$form .= '>
	<label for id ="material">'.MATERIAL.'</label><br>'.	
	ID.': <input type="text" name="ID" value="';
if(isset($this->aRow['ID'])){
	$form .= $oObject->aRow['ID'];
} 
$form .=  '"> <br>'.
	LENT_ON.': <input type="text" name="pickup_date" value="'; 
if(isset($this->aRow['pickup_date'])){
	$form .= $oObject->aRow['pickup_date'];
} 
$form .=  '"> <br>'.
	RETURNED_ON.': <input type="text" name="return_date" value="'; 
if(isset($this->aRow['return_date'])){
	$form .= $oObject->aRow['return_date'];
} 
$form .= '"> <br>
		<input type="submit" value="'.BUTTON_SEND.'">
		<input type="reset" value="'.BUTTON_RESET.'">	
</form>';
echo $form;


