<?php
$open_form ='

	<form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post">
	<input type = hidden name="ac" value = "open_save">
 	<table>
	<th>'.$this->oLang->texts['W_DAY'].'</th>
	<th>'.$this->oLang->texts['W_START'].'</th>
	<th>'.$this->oLang->texts['W_END'].'</th>
	<th>'.$this->oLang->texts['W_NOTICE'].'</th>';
	foreach($this->settings['opening_days'] as $day){
		$open_form .= '<tr>
			<td>'.$this->aLang->texts[strtoupper($day)].'</td>
			<td><input type="text" name="'.$day.'_s" value="';
		if (isset($this->aOpen[$day]["start"])){
			$open_form.= $this->aOpen[$day]["start"];
		}
		$open_form .= '"></td>
			<td><input type="text" name="'.$day.'_e" value="';
		if (isset($this->aOpen[$day]["end"])){
			$open_form.= $this->aOpen[$day]["end"];
		}
		
		$open_form .= '"></td>
			<td><input type="text" name="'.$day.'_n" value="';
		if (isset($this->aOpen[$day]["notice"])){
			$open_form.= $this->aOpen[$day]["notice"];
		}
		$open_form .='"></td>
		</tr>';
	}	
$open_form .= '</table>
	<input type="submit" value="'.$this->oLang->texts['BUTTON_SEND'].'">
</form>';
echo $open_form;
?>


