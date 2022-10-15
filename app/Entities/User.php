<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class User extends Entity
{
  public function activation_hash()
  {
        $token = random_string('sha1');
      
        $this->activation_hash =
            $token;
  }

}
