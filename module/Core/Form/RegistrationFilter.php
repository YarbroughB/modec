<?php

namespace Core\Form;

use Zend\InputFilter\InputFilter;

class RegistrationFilter extends InputFilter
{
	public function __construct($sm)
	{
		$this->add(array(
			'name'     => 'username',
			'required' => true,
			'filters'  => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim'),
			),
			'validators' => array(
				array(
					'name'    => 'StringLength',
					'options' => array(
						'encoding' => 'UTF-8',
						'min'	  => 1,
						'max'	  => 50,
					),
				),
				array(
					'name'    => 'Zend\Validator\Db\NoRecordExists',
					'options' => array(
						'table'   => 'users',
						'field'   => 'username',
						'adapter' => $sm->get('Zend\Db\Adapter\Adapter'),
					),
				),
			),
		));

		$this->add(array(
			'name'     => 'password',
			'required' => true,
			'filters'  => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim'),
			),
			'validators' => array(
				array(
					'name'    => 'StringLength',
					'options' => array(
						'encoding' => 'UTF-8',
						'min'	  => 6
					),
				),
			),
		));	

		$this->add(array(
			'name'     => 'password_confirm',
			'required' => true,
			'filters'  => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim'),
			),
			'validators' => array(
				array(
					'name'    => 'StringLength',
					'options' => array(
						'encoding' => 'UTF-8',
						'min'	  => 6,
					),
				),
				array(
					'name'    => 'Identical',
					'options' => array(
						'token' => 'password',
					),
				),
			),
		));		
	}
}