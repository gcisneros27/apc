<?php

/**
 * This is the model class for table "seguridad.authitemchild".
 *
 * The followings are the available columns in table 'seguridad.authitemchild':
 * @property string $parent
 * @property string $child
 * @property string $usuario_id_aud
 *
 * The followings are the available model relations:
 * @property Authitem $child
 * @property Authitem $parent
 */
class Authitemchild extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'seguridad.authitemchild';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent, child', 'required'),
			array('parent, child', 'length', 'max'=>64),
			array('usuario_id_aud', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('parent, child, usuario_id_aud', 'safe', 'on'=>'search'),
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
			'child' => array(self::BELONGS_TO, 'Authitem', 'child'),
			'parent' => array(self::BELONGS_TO, 'Authitem', 'parent'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'parent' => 'Parent',
			'child' => 'Child',
			'usuario_id_aud' => 'Usuario Id Aud',
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

		$criteria->compare('parent',$this->parent,true);
		$criteria->compare('child',$this->child,true);
		$criteria->compare('usuario_id_aud',$this->usuario_id_aud,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Authitemchild the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function detectLoop($itemName,$childName)
	{
		if($childName===$itemName)
			return true;
		$a = Yii::app()->authManager;
		foreach($a->getItemChildren($childName) as $child)
		{
			if($this->detectLoop($itemName,$child->getName()))
				return true;
		}
		return false;
	}
}
