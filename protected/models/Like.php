<?php

/**
 * This is the model class for table "likes".
 *
 * The followings are the available columns in table 'likes':
 * @property integer $id
 * @property integer $user_id
 * @property integer $share_id
 * @property integer $created
 * @property integer $updated
 *
 * The followings are the available model relations:
 * @property Shares $share
 * @property Users $user
 */
class Like extends CActiveRecord
{
    /**
	 * Adds the CTimestampBehavior to this class
	 * @return array
	 */
	public function behaviors()
	{
		return array(
			'CTimestampBehavior' => array(
				'class' 			=> 'zii.behaviors.CTimestampBehavior',
				'createAttribute' 	=> 'created',
				'updateAttribute' 	=> 'updated',
				'setUpdateOnCreate' => true
			)
		);
	}

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'likes';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, share_id', 'required'),
            array('user_id, share_id, created, updated', 'numerical', 'integerOnly'=>true),
            array('id, user_id, share_id, created, updated', 'safe', 'on'=>'search'),
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
            'share' => array(self::BELONGS_TO, 'Share', 'share_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'share_id' => 'Share',
            'created' => 'Created',
            'updated' => 'Updated',
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
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('share_id',$this->share_id);
        $criteria->compare('created',$this->created);
        $criteria->compare('updated',$this->updated);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Like the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
