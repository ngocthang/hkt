<?php
class Item extends BModel
{

    /**
     *
     * @var integer
     */
    public $id;
     
    /**
     *
     * @var string
     */
    public $name;
     
    /**
     *
     * @var integer
     */
    public $price;
     
    /**
     *
     * @var integer
     */
    public $type;
     
    /**
     *
     * @var integer
     */
    public $status;
     
    /**
     *
     * @var string
     */
    public $description;
     
    /**
     *
     * @var string
     */
    public $img;
     
    /**
     *
     * @var integer
     */
    public $public_range;
     
    /**
     *
     * @var integer
     */
    public $created_by;
     
    /**
     *
     * @var integer
     */
    public $approved_by;
     
    /**
     *
     * @var string
     */
    public $approved_at;
     
    /**
     *
     * @var string
     */
    public $created_at;
     
    /**
     *
     * @var string
     */
    public $updated_at;
     
    /**
     *
     * @var string
     */
    public $deleted_at;

    public function getSaveAttributes()
    {
        return ['name', 'price', 'type', 'description', 'img', 'public_range'];
    }

    public function getAttributeLabels()
    {
        return [
            'img' => 'Image Path',
        ];
    }
}
