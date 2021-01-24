<?php
class User {
	function __construct($oData) {
	    $this->data = $oData;
	    include(MODULE_PATH."user/actions.php");
	    $this->actions = $user_actions;
	}

	function hash_password($password){
		return password_hash($password, PASSWORD_DEFAULT);
	}

	function create_user_array($allowed_keys){
		$aUser = array();
		foreach($allowed_keys as $key){
		    if ($key === "password") {
			if(isset($this->data->payload[$key])){
				$aUser['password_hash'] = $this->hash_password($this->payload[$key]);
			}
		    }
		    else {
			if(isset($this->data->payload[$key])){
			    $aUser[$key] = $this->data->payload[$key];
			}
		    }
		}
		if (DEBUG) {
		    echo "Created array:<br>";
		    var_dump($aUser);
		    echo "<br>";
		}
		return $aUser;
	}

	function register() {
	    //returns user_ID or -1 on failure
		$aUser = array();
		if(isset($this->data->payload['forename'])){
			$aUser['forename'] = $this->data->payload['forename'];
		}
		if(isset($this->data->payload['surname'])){
			$aUser['surname'] = $this->data->payload['surname'];
		}
		if(isset($this->data->payload['email'])){
			$aUser['email'] = $this->data->payload['email'];
		}
		if(isset($this->data->payload['language'])){
			$aUser['language'] = $this->data->payload['language'];
		}
		if(isset($this->data->payload['password'])){
			$aUser['password_hash'] = $this->hash_password($this->data->payload['password']);
		}
		$aUser['role'] = 1;
		if (DEBUG) {
		    echo "Registering User with:<br>";
		    var_dump($aUser);
		}
		return $this->save_user($aUser);
	}
	function save_user($aUser){
		/*
		args:
			Array $aUser
				Array of user information which will be saved.
				e.g.	array(
						'forename' => String $forname,
						'surname' => String $surname,
						'email' => String $email,
						'language' => String $language,
						'role' => Int $role, as decribed in config/permissions.php
						'password_hash' => password_hash(String $password, PASSWORD_DEFAULT)
					);

		returns:
			None or -1 if saving fails
		Function will save user Information given in $aUser. If user exists it will
		overwrite existing data but not delete not-specified data
		*/
		$aFields = $aUser;
		$user_ID = $aUser['user_ID'];
		if (DEBUG) {
		    echo "User that will be saved<br>";
		    var_dump($aFields);
		}
		if ((isset($user_ID) and ($user_ID != ""))){
			return $this->data->store_data(TABLE_USER, $aFields, 'user_ID' , $user_ID);
		}
		else {
		    return $this->ID=$this->data->store_data(TABLE_USER, $aFields, NULL , NULL);
		}
	}

	function delete_user($user_ID){
		$aFields = array (
			'user_ID' => $user_ID
		);
		$this->removed=$this->data->delete_rows(TABLE_USER, $aFields);
	}

	function get_user ($user_ID = NULL, $forename = NULL, $surname = NULL, $email = NULL, $language = NULL){
		$aUser= array();
		$aFields= array();
		if((isset($user_ID)) and ($user_ID!= "")){
			$aFields["user_ID"] = $user_ID;
		}
		if((isset($forename)) and ($forename!= "")){
			$aFields["forename" ]= $forename;
		}
		if((isset($surname)) and ($surname != "")){
			$aFields["surname"] = $surname;
		}
		if((isset($email)) and ($email!= "")){
			$aFields["email"] = $email;
		}
		if((isset($this->oLang->language)) and ($language!= "")){
			$aFields["language"] = $language;
		}
		$aOrder = array("-user_ID");
		$this->p_result = $this->data->select_rows(TABLE_USER, $aFields, $aOrder);
		while($aRow=mysqli_fetch_assoc($this->p_result)){
			$aUser[$aRow['user_ID']] = $aRow;
		}
		return $aUser;
	}
}

?>

