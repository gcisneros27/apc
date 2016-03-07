<?php 

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	private $_id;
	
	public function autenticar() {
		$record=  Usuario::model()->find('lower(tx_usuario)=:tx_usuario and bo_activado=true',array(':tx_usuario'=>strtolower($this->username)));
                    if($record===null)
				$this->errorCode=self::ERROR_USERNAME_INVALID;
			else if($record->tx_contrasena!==md5($this->password))
				$this->errorCode=self::ERROR_PASSWORD_INVALID;
			else if(!$record->bo_activado) {
				$this->errorCode=3;
			} else {
				$this->_id=$record->id_usuario;
				//$this->setState('rol', $record->rol->tx_rol);
				
				$this->errorCode=self::ERROR_NONE;
			}
			return !$this->errorCode;
	}
	
	public function getId() {
        return $this->_id;
    }
    
}