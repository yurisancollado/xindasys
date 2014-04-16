<?php

/**
 * This is the model class for table "pedido".
 *
 * The followings are the available columns in table 'pedido':
 * @property integer $id
 * @property integer $numero
 * @property string $fecha
 * @property integer $estado
 * @property integer $usuarios_id
 * @property integer $clientes_id
 *
 * The followings are the available model relations:
 * @property Cliente $clientes
 * @property Usuario $usuarios
 * @property Producto[] $productos
 */
class Pedido extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pedido';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('numero, fecha, clientes_id', 'required'),
			array('numero, estado, usuarios_id, clientes_id', 'numerical', 'integerOnly'=>true),
			array('numero', 'unique', 'message' => 'Ya se encuentra registrado el numero de pedido'),
			
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, numero, fecha, estado, usuarios_id, clientes_id', 'safe', 'on'=>'search'),
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
			'clientes' => array(self::BELONGS_TO, 'Cliente', 'clientes_id'),
			'usuarios' => array(self::BELONGS_TO, 'Usuario', 'usuarios_id'),
			'productos' => array(self::MANY_MANY, 'Producto', 'pedido_has_productos(pedido_id, productos_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'numero' => 'Numero',
			'fecha' => 'Fecha',
			'estado' => 'Estado',
			'usuarios_id' => 'Vendedor',
			'clientes_id' => 'Clientes',
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
		$criteria->compare('numero',$this->numero);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('usuarios_id',$this->usuarios_id);
		$criteria->compare('clientes_id',$this->clientes_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pedido the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
