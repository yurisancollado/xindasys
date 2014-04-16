<?php

/**
 * This is the model class for table "producto".
 *
 * The followings are the available columns in table 'producto':
 * @property integer $id
 * @property string $detalle
 * @property string $descripcion
 * @property string $binaryfile
 * @property string $fileName
 * @property string $fileType
 *
 * The followings are the available model relations:
 * @property Pedido[] $pedidos
 */
class Producto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	 public static $Image="";
	public function tableName()
	{
		return 'producto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('detalle, binaryfile, fileName, fileType', 'required'),
			array('detalle, descripcion', 'length', 'max'=>150),
			array('fileName', 'length', 'max'=>100),
			array('fileType', 'length', 'max'=>25),
			array('binaryfile', 'file', 
	        	'types'=>'jpg, gif, png, bmp, jpeg',
	            'maxSize'=>1024 * 1024 * 10, // 10MB
	                'tooLarge'=>'The file was larger than 10MB. Please upload a smaller file.',
	            'allowEmpty' => true
         	),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, detalle, descripcion, binaryfile, fileName, fileType', 'safe', 'on'=>'search'),
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
			'pedidos' => array(self::MANY_MANY, 'Pedido', 'pedido_has_productos(productos_id, pedido_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'detalle' => 'Detalle',
			'descripcion' => 'Descripcion',
			'binaryfile' => 'Imagen',
			'fileName' => 'File Name',
			'fileType' => 'File Type',
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
		$criteria->compare('detalle',$this->detalle,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('binaryfile',$this->binaryfile,true);
		$criteria->compare('fileName',$this->fileName,true);
		$criteria->compare('fileType',$this->fileType,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
        'defaultOrder'=>'detalle ASC',
    ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Producto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
