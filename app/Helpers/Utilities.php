<?php
namespace App\Helpers;

use App\Models\User;

class Utilities{

 public static function createNamesFromFullName( $validated = [] )
    {
      $names = isset( $validated['full_name'] ) ? explode(" ",$validated['full_name']) : null;

      $validated['first_name'] = isset($names[0]) ? $names[0] : 'user';

      if(isset($names[2])) $validated['middle_name'] = $names[1];

      if(isset($names[2])) $validated['lats_name'] = $names[2];

      if(count($names) == 2) $validated['last_name'] = $names[1];

      if(count($names) == 1) $validated['last_name'] = $names[0];


     
      return $validated;
    }
}

