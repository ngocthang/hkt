<?php
/**
 * @author tran.duc.thang
 * BModel - Base Model - extends the Model class of Phalcon, with various of features included.
 * When you create a new model, remember to extend from BModel instead of Model to use
 * convenient features of Base Phalcon
 */
use Phalcon\Mvc\Model\Behavior\Timestampable;
use \Phalcon\Mvc\Model;

class BModel extends Model
{
    /**
     * Attach timestamp behaviour to all model instance
     */
    public function initialize()
    {
        $this->addBehavior(new Timestampable(
            [
                'beforeCreate' => [
                    'field' => 'created_at',
                    'format' => 'Y-m-d H:i:s',
                ],
                'beforeUpdate' => [
                    'field' => 'updated_at',
                    'format' => 'Y-m-d H:i:s',
                ],
            ]
        ));
    }

    /**
     * Get all attributes
     * @return array attributes
     */
    public function getAttributes()
    {
        return $this->getModelsMetaData()->getAttributes($this);
    }

    /*
     * Return the all the save attributes, which can be use in mass assignment or display in create/update form
     * @return array save attributes
     */
    public function getSaveAttributes()
    {
        return [];
    }

    /**
     * @return the Label of each attribute, which will be displayed in create/edit form
     */
    public function getAttributeLabels()
    {
        return [];
    }

    /**
     * Check whether the attribute is save or not
     * @param $att string
     * @return boolean
     */
    public function isSaveAttribute($att)
    {
        $save_attributes = $this->getSaveAttributes();
        return isset($save_attributes[$att]);
    }

    /**
     * Get the label of an attribute. If the label is not defined in the attributeLabels() function,
     * it will be generate be the snakeToWords() function, which will convert a snake_case string to Words
     * with the first letter capitalized.
     * @param $att string
     * @return string
     */
    public function getAttributeLabel($att)
    {
        $attribute_label = $this->getAttributeLabels();
        if (isset($attribute_label[$att])) {
            return $attribute_label[$att];
        }
        return BText::snakeToWords($att, true);
    }

    /**
     * The function to do mass assignment with the inputted attributes. If the attributes is empty,
     * all the save attributes can be changed via mass assignment.
     * @param $params
     * @param array $attributes
     */
    public function load($params, $attributes=[])
    {
        if (!$attributes) {
            $attributes = $this->getSaveAttributes();
        }
        foreach ($attributes as $att) {
            if (isset($params[$att])) {
                $this->$att = $params[$att];
            }
        }
    }
}