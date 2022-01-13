<?php
namespace App\Helpers;

use App\Models\User;

class Utilities{

 public static function createNamesFromFullName( $validated = [] )
    {
      $names = isset( $validated['full_name'] ) ? explode(" ",$validated['full_name']) : null;

      $validated['first_name'] = isset($names[0]) ? $names[0] : 'user';

      if(count($names) == 3) $validated['last_name'] = $names[2];

      if(count($names) == 2) $validated['last_name'] = $names[1];

      if(count($names) == 1) $validated['last_name'] = 'null'; //$names[0];

      if(count($names) == 3) $validated['middle_name'] = $names[1];


     
      return $validated;
    }
}

