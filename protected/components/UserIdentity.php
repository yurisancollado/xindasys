<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	const ERROR_DISABLED= 69;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user=Usuario::model()->find('LOWER(username)=?',array(strtolower($this->username)));
		
		if($user===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if(!$user->validatePassword($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else if(!$user->estado===0){			
			$this->errorCode=self::ERROR_DISABLED;
		}else{
			$this->_id=$user->id;
			$this->username=$user->username;
			$this->errorCode=self::ERROR_NONE;			
			//Yii::app()->user->id; 
			//Yii::app()->user->getState('nombre'); 
			$this->setState('last_login',$user->last_login);
			$this->setState('superuser',$user->admin);
			$this->setState('nombre',$user->nombre.' '.$user->apellido);			
			
			/*Actualizamos el last_login del usuario que se esta autenticando ($user->username) */
			$sql = "update usuario set last_login = now() where username='$user->username'";
			$connection = Yii::app() -> db;
			$command = $connection -> createCommand($sql);
			$command -> execute();
		}	
		return $this->errorCode==self::ERROR_NONE;
	}
	public function getId(){
		return $this->_id;
	}
}