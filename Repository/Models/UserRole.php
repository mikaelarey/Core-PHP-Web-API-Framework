<?php

namespace Repository\Models;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(
 *     name="user_roles",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="name_unique", columns={"name"})
 *     }
 * )
 */
class UserRole
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true, nullable=false)
     */
    private $name;


    public function __construct() { }

    public function get_id(): int
    {
        return $this->id;
    }

    public function get_name(): string 
    {
        return $this->name;
    }

    public function set_name($name): self
    {
        $this->name = $name;
        return $this;
    }

}
