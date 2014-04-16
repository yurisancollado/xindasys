<?php

/**
 * This is the model class for table "usuario".
 *
 * The followings are the available columns in table 'usuario':
 * @property integer $id
 * @property string $cedula
 * @property string $nombre
 * @property string $apellido
 * @property string $username
 * @property string $password
 * @property integer $estado
 * @property string $created_at
 * @property string $last_login
 * @property integer $admin
 *
 * The followings are the available model relations:
 * @property Abono[] $abonos
 * @property Factura[] $facturas
 * @property Pedido[] $pedidos
 */
class Usuario extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public static $tipoUsuario=array('1'=>'Administrador','2'=>'Vendedor');
	public static $estado=array('1'=>'Activo','0'=>'Inactivo');
	public function tableName()
	{
		return 'usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cedula, nombre, apellido, username, password, estado', 'required'),
			array('estado, admin', 'numerical', 'integerOnly'=>true),
			array('cedula', 'length','min'=>7, 'max'=>8),
			array('username', 'length','min'=>4, 'max'=>15),
			array('nombre, apellido', 'length', 'min'=>1,'max'=>45),
			array('cedula','unique', 'message'=>'Ya se encuentra registrado el numero cedula'),
			array('username','unique', 'message'=>'Ya se encuentra registrado el Username'),
			array('created_at, last_login', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cedula, nombre, apellido, username, password, estado, created_at, last_login, admin', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'abonos' => array(self::HAS_MANY, 'Abono', 'usuarios_id'),
			'facturas' => array(self::HAS_MANY, 'Factura', 'usuarios_id'),
			'pedidos' => array(self::HAS_MANY, 'Pedido', 'usuarios_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cedula' => 'Cedula',
			'nombre' => 'Nombre',
			'apellido' => 'Apellido',
			'username' => 'Username',
			'password' => 'Password',
			'estado' => 'Estado',
			'created_at' => 'Created At',
			'last_login' => 'Last Login',
			'admin' => 'Admin',			
			'NombreCompleto'=>'Vendendor',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('cedula',$this->cedula,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('apellido',$this->apellido,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('last_login',$this->last_login,true);
		$criteria->compare('admin',$this->admin);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array('defaultOrder'=>'cedula ASC'), // orden por defecto según el atributo nombre
    	'pagination'=>array('pageSize'=>10),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usuario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/**
	 * @return un boolean si es el password son iguales o no.
	 */
	public function validatePassword($password){
		return $this->hashPassword($password)===$this->password;		
	}
	/**
	 * @return un string con el password con md5.
	 */
	public function hashPassword($password){
		return md5($password);
	}
	
	public function getEstado(){
		if($this->estado==1)
			return 'Activo';
		elseif($this->estado==0)
			return 'Inactivo';
	}
	public function getTipoUsuario(){
		if($this->admin==1)
			return 'Administrador';
		elseif($this->admin==2)
			return 'Vendedor';
	}
	public function getListaEstado(){
		return self::$estado;
	}
	public function getListaTipoUsuario(){
		return self::$tipoUsuario;
	}
	
	public function getNombreCompleto(){
		return $this->nombre.' '.$this->apellido;
	}
}
