<?php

/**
 * This is the model class for table "chapter".
 *
 * The followings are the available columns in table 'chapter':
 * @property string $id
 * @property string $_title
 * @property string $_slug
 * @property string $_book_id
 * @property string $created
 * @property string $modified
 *
 * The followings are the available model relations:
 * @property Book $book
 */
class Chapter extends CActiveRecord
{

	/**
     * Define behaviors
     * @return array
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            array(
                'i18n-attribute-messages' => array(
                    'class' => 'I18nAttributeMessagesBehavior',
                    'translationAttributes' => array(
                        'title',
                        'slug',
                        'book_id',
                    ),
                    'languageSuffixes' => array_keys(Yii::app()->params["languages"]),
                ),
            )
        );
    }

    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Chapter the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'chapter';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('_book_id', 'required'),
			array('_title, _slug', 'length', 'max'=>255),
			array('_book_id', 'length', 'max'=>20),
			array('created, modified', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, _title, _slug, _book_id, created, modified', 'safe', 'on'=>'search'),
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
			'book' => array(self::BELONGS_TO, 'Book', '_book_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'_title' => 'Title',
			'_slug' => 'Slug',
			'_book_id' => 'Book',
			'created' => 'Created',
			'modified' => 'Modified',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('_title',$this->_title,true);
		$criteria->compare('_slug',$this->_slug,true);
		$criteria->compare('_book_id',$this->_book_id,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}