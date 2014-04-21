<?php

/**
 * This is the model class for table "cliente".
 *
 * The followings are the available columns in table 'cliente':
 * @property integer $id
 * @property string $cedula
 * @property string $nombre
 * @property string $apellido
 * @property string $telefono
 * @property string $direccion
 * @property string $rif
 * @property integer $estado
 *
 * The followings are the available model relations:
 * @property Factura[] $facturas
 * @property Pedido[] $pedidos
 */
class Cliente extends CActiveRecord {
	/**
	 * @return string the associated database table name
	 */
	public static $estado = array('1' => 'Activo', '0' => 'Inactivo');
	public function tableName() {
		return 'cliente';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array( array('cedula, nombre, apellido, telefono', 'required'), array('estado', 'numerical', 'integerOnly' => true), array('cedula', 'length', 'min' => 7, 'max' => 12), array('nombre, apellido, telefono, rif', 'length', 'max' => 45), array('cedula', 'unique', 'message' => 'Ya se encuentra registrado el numero cedula'), array('rif', 'unique', 'message' => 'Ya se encuentra registrado el numero RIF'), array('direccion', 'length', 'max' => 100),
		// The following rule is used by search().
		// @todo Please remove those attributes that should not be searched.
		array('id, cedula, nombre, apellido, telefono, direccion, rif, estado', 'safe', 'on' => 'search'), );
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array('facturas' => array(self::HAS_MANY, 'Factura', 'clientes_id'), 'pedidos' => array(self::HAS_MANY, 'Pedido', 'clientes_id'), );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array('id' => 'ID', 'cedula' => 'Cedula', 'nombre' => 'Nombre', 'apellido' => 'Apellido', 'telefono' => 'Telefono', 'direccion' => 'Direccion', 'rif' => 'Rif', 'estado' => 'Estado', 'NombreCompleto' => 'Cliente','TotalPedido'=>'Total de Pedidos');
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
		$criteria -> compare('cedula', $this -> cedula, true);
		$criteria -> compare('nombre', $this -> nombre, true);
		$criteria -> compare('apellido', $this -> apellido, true);
		$criteria -> compare('telefono', $this -> telefono, true);
		$criteria -> compare('direccion', $this -> direccion, true);
		$criteria -> compare('rif', $this -> rif, true);
		$criteria -> compare('estado', $this -> estado);

		return new CActiveDataProvider($this, array('criteria' => $criteria, 'sort' => array('defaultOrder' => 'cedula ASC'), // orden por defecto según el atributo nombre
		'pagination' => array('pageSize' => 10), ));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cliente the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	public function getEstado() {
		if ($this -> estado == 1)
			return 'Activo';
		elseif ($this -> estado == 0)
			return 'Inactivo';
	}

	public function getListaEstado() {
		return self::$estado;
	}

	public function getNombreCompleto() {
		return $this -> nombre . ' ' . $this -> apellido;
	}

	#Dar el numero de factura
	public function getTotalFactura() {
		$sql = "SELECT  COUNT(*) as total from factura where clientes_id= " . $this -> id;
		$sqlFactura = Yii::app() -> db -> createCommand($sql) -> queryRow();
		return $sqlFactura['total'];
	}

	#Dar la Sumatoria del monto de las facturas
	public function getMontoFacturado() {
		$sql = "Select SUM(monto) as total from factura where clientes_id=" . $this -> id;
		$sqlFactura = Yii::app() -> db -> createCommand($sql) -> queryRow();
		if ($sqlFactura['total'] == 0)
			return 0;
		else
			return $sqlFactura['total'];
	}

	#Dar la sumatoria del monto cancelado
	public function getMontoCancelado() {
		$sql = "Select sum(monto) as total from abono where factura_id in (Select id from factura where clientes_id=" . $this -> id . " )";
		$sqlFactura = Yii::app() -> db -> createCommand($sql) -> queryRow();
		return $sqlFactura['total'];
	}

	#Dar la deuda
	public function getDeuda() {
		if ($this -> getMontoFacturado() == 0)
			return 0;
		else
			return $this -> getMontoFacturado() - $this -> getMontoCancelado();
	}
	#Dar total de pedidos
	public function getTotalPedido() {
		$sql = "Select COUNT(*)  as total from pedido where clientes_id=" . $this -> id;
		$sqlFactura = Yii::app() -> db -> createCommand($sql) -> queryRow();
		return $sqlFactura['total'];
	}
	

}
