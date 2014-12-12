<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 02.12.14
 * Time: 14:45
 */

class SK_Measurements_Model_Resource_Setup extends Mage_Eav_Model_Entity_Setup
{
    public function getDefaultEntities()
    {
        return array(
            SK_Measurements_Model_Profile::ENTITY => array(
                'entity_model' => 'sk_measurements/profile',
                'table' => 'sk_measurements/profile',
                'attributes' => array(
                    'weight' => array(
                        'type'  => 'varchar',
                        'label' => 'Weight',
                        'input' => 'text',
                        'required' => true,
                        'sort_order' => 10,
                        'position' => 10,
                        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL
                    ),
                    'height' => array(
                        'type' => 'varchar',
                        'label' => 'Height',
                        'input' => 'text',
                        'required' => true,
                        'sort_order' => 20,
                        'position' => 20,
                        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL
                    ),
                    'age' => array(
                        'type' => 'varchar',
                        'label' => 'Age',
                        'input' => 'text',
                        'required' => true,
                        'sort_order' => 30,
                        'position' => 30,
                        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL
                    ),
                    'press' => array(
                        'type' => 'varchar',
                        'label' => 'Bench Press',
                        'input' => 'text',
                        'required' => true,
                        'sort_order' => 40,
                        'position' => 40,
                        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL
                    ),
                    'deadlift' => array(
                        'type' => 'varchar',
                        'label' => 'Deadlift',
                        'input' => 'text',
                        'required' => true,
                        'sort_order' => 50,
                        'position' => 50,
                        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL
                    ),
                    'squat' => array(
                        'type' => 'varchar',
                        'label' => 'Squat',
                        'input' => 'text',
                        'required' => true,
                        'sort_order' => 60,
                        'position' => 60,
                        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL
                    ),
                ),
            )
        );
    }
}