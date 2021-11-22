<?php
namespace App\Helpers;

use App\Models\User;

class Utilities{

 public static function createNamesFromFullName( $validated = [] )
    {
      $names = isset( $validated['full_name'] ) ? explode(" ",$validated['full_name']) : null;
      $validated['first_name'] = isset($names[0]) ? $names[0] : 'user';
      $validated['middle_name'] = count($names)>2 ? $names[1] : null;
      $validated['last_name'] = count($names) > 2 ? $names[2] : null;
      $validated['last_name'] = count($names) < 2 ? $names[0] : null;
      return $validated;
    }
}

