<?php

/**
 * This is the model class for table "factura".
 *
 * The followings are the available columns in table 'factura':
 * @property integer $id
 * @property string $numero
 * @property double $monto
 * @property string $fecha
 * @property string $estado
 * @property integer $clientes_id
 * @property integer $usuarios_id
 *
 * The followings are the available model relations:
 * @property Abono[] $abonos
 * @property Cliente $clientes
 * @property Usuario $usuarios
 */
class Factura extends CActiveRecord {
	/**
	 * @return string the associated database table name
	 */
	public static $estado = array('1' => 'Cancelada', '0' => 'Por Cancelar');
	public static $MontoCancelado;
	public function tableName() {
		return 'factura';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		 array('numero, monto, fecha, estado, clientes_id, usuarios_id', 'required'),
		 array('clientes_id, usuarios_id', 'numerical', 'integerOnly' => true), 
		 array('monto', 'numerical'),
		  array('numero', 'length', 'max' => 20),
		   array('estado', 'length', 'max' => 45),
		    array('numero', 'unique', 'message' => 'Ya se encuentra registrado el numero de factura'),
		// The following rule is used by search().
		// @todo Please remove those attributes that should not be searched.
		array('id, numero, monto, fecha, estado, clientes_id, usuarios_id', 'safe', 'on' => 'search'), );
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array('abonos' => array(self::HAS_MANY, 'Abono', 'factura_id'), 'clientes' => array(self::BELONGS_TO, 'Cliente', 'clientes_id'), 'usuarios' => array(self::BELONGS_TO, 'Usuario', 'usuarios_id'), );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array('id' => 'ID', 'numero' => 'Numero', 'monto' => 'Monto Total (Bs.)', 'fecha' => 'Fecha', 'estado' => 'Estado', 'clientes_id' => 'Clientes', 'usuarios_id' => 'Usuarios', 'factura.numero' => 'Numero de Factura', 'MontoCancelado' => 'Monto Cancelado (Bs.)', );
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
	public function search() {
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;
		$criteria -> compare('id', $this -> id);
		$criteria -> compare('numero', $this -> numero, true);
		$criteria -> compare('monto', $this -> monto);
		$criteria -> compare('fecha', $this -> fecha, true);
		$criteria -> compare('estado', $this -> estado, true);
		$criteria -> compare('clientes_id', $this -> clientes_id);
		$criteria -> compare('usuarios_id', $this -> usuarios_id);

		return new CActiveDataProvider($this, array('criteria' => $criteria, 
		'sort'=>array('defaultOrder'=>'numero ASC'), // orden por defecto según el atributo nombre
    	'pagination'=>array('pageSize'=>10)));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Factura the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	public static function getListUsuario() {
		return CHtml::listData(Usuario::model() -> findAll(array('order' => 't.nombre')), 'id', 'NombreCompleto');
	}

	public static function getListCliente() {
		return CHtml::listData(Cliente::model() -> findAll(array('order' => 't.nombre')), 'id', 'NombreCompleto');
	}

	public function getEstado() {
		if ($this -> estado == 1)
			return 'Cancelada';
		elseif ($this -> estado == 0)
			return 'Por Cancelar';
	}

	public function getListaEstado() {
		return self::$estado;
	}

	public function getFullNameUsuario() {
		return $this -> usuarios -> nombre . ' ' . $this -> usuarios -> apellido;
	}

	public function getMontoCancelado() {
		$sql = "Select SUM(monto) as total from Abono where factura_id= ".$this -> id;
		$sqlAbono = Yii::app() -> db -> createCommand($sql) -> queryRow();	
		if ($sqlAbono['total'] == NULL)
			return '0';
		else
			return $sqlAbono['total'];
		
		
	}
#Busqueda de cliente factura
	public function clienteFactura($id = NULL) {
		$criteria = new CDbCriteria;
		$criteria -> addCondition('clientes_id=' . $id);
		return new CActiveDataProvider($this, array('criteria' => $criteria, ));
	}


}
