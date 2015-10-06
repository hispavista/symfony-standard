<?php

// src/Acme/UserBundle/Entity/User.php

namespace Hispavista\WebBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;

/**
 * User
 */
class User extends BaseUser {

    public function __construct() {
        parent::__construct();
        // your own logic
    }

    /**
     * @var integer
     */
    protected $id;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    public function getRoles(){
        return parent::getRoles();
    }
}
