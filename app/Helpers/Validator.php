<?php

namespace App\Helpers;

use App\Models\Model;
use Exception;
use PDO;

/* 
  USAGE



   $validator = new Validator();
      $validators  = [
        'name' => [
          'value' => $_POST['name'],
          'validators' => [
            'required' => true,
            'minLength' => 30,
            'maxLength' => 30
          ]
        ],
        'name cím' => [
          'value' => $_POST['email'],
          'validators' => [
            'required' => true,
            'minLength' => 50,
            'maxLength' => 30
          ]
        ],
      ];

      $validated = $validator->validate($validators);
      $hasValidateErrors = $this->hasValidateErrors($validated); // Itt már ha vannak gondok kiirja true-val és lehet dobni a sessionbe; hasValidateErrors metódus a controller.php-ban
      exit;
*/

class Validator

{
  protected $Model;

  public function __construct()
  {
    $this->Model = new Model();
  }

  private function structureValidators($validators)
  {
    $ret = [];
    foreach ($validators as $key => $validator) {
      $validator['name'] = $key;
      $ret[] = $validator;
    }
    return $ret;
  }
  public function validate($validators)
  {
    $ret = [];
    $data = self::structureValidators($validators);

    foreach ($data as $index => $validatorsData) {
      $value = $data[$index]['value'];
      $name = $data[$index]['name'];
      foreach ($validatorsData['validators'] as $validatorName => $validatorValue) {
        $ret[$name][$index][$validatorName] = [

          'status' => $this->{$validatorName}($value, $validatorValue),
          'errorMessage' => !$this->{$validatorName}($value, $validatorValue) ? self::errorMessages($validatorName, $name, $validatorValue) : ''
        ];
      }
    }

    return $ret;
  }

  public function checkIsIdentityNumExist($value)
  {
    try {
      $user = $this->Model->selectByRecord('users', 'ident_number', $value, PDO::PARAM_INT);
      if ($user) {
        return false;
      }
      return true;
    } catch (Exception $e) {
      http_response_code(500);
      echo "Internal Server Error" . $e->getMessage();
      exit;
    }
  }

  public function required($value)
  {
    if (!$value || $value === '') return false;
    return true;
  }

  public function minLength($value, $minLength)
  {
    if (strlen($value) < $minLength) return false;
    return true;
  }

  public function maxLength($value, $maxLength)
  {
    if (strlen($value) > $maxLength) return false;
    return true;
  }

  public function errorMessages($validator, $field = '', $param = '')
  {
    $messages = [
      'required' => [
        'Hu' => 'Ez biza kötlező!'
      ],
      'minLength' => [
        'Hu' => "A mezőnek legalább {$param} karakter hosszúnak kell lennie."
      ],
      'maxLength' => [
        'Hu' => "A mező nem lehet hosszabb, mint {$param} karakter."
      ],
      'checkIsIdentityNumExist' => [
        'Hu' => "Ezzel a törzsszámmal már regisztráltak!"
      ],

    ];

    return $messages[$validator]['Hu'];
  }
}
