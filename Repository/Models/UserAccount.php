<?php

namespace Repository\Models;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(
 *     name="user_accounts",
 *     indexes={
 *         @ORM\Index(name="email_index", columns={"email"}),
 *         @ORM\Index(name="username_index", columns={"username"}),
 *     },
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="email_unique", columns={"email"}),
 *         @ORM\UniqueConstraint(name="username_unique", columns={"username"}),
 *     }
 * )
 */
class UserAccount
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $middlename;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     */
    private $user_role_id;



    public function __construct() { }

    public function get_id(): int {
        return $this->id;
    }

    public function get_firstname(): string {
        return $this->firstname;
    }

    public function get_middlename(): string {
        return $this->middlename;
    }

    public function get_lastname(): string {
        return $this->lastname;
    }

    public function get_username(): string {
        return $this->username;
    }

    public function get_email(): string {
        return $this->email;
    }

    public function get_user_role_id(): int {
        return $this->user_role_id;
    }

    public function set_id($id): self {
        $this->id = $id;
        return $this;
    }

    public function set_firstname($firstname): self {
        $this->firstname = $firstname;
        return $this;
    }

    public function set_middlename($middlename): self {
        $this->middlename = $middlename;
        return $this;
    }

    public function set_lastname($lastname): self {
        $this->lastname = $lastname;
        return $this;
    }

    public function set_username($username): self {
        $this->username = $username;
        return $this;
    }

    public function set_email($email): self {
        $this->email = $email;
        return $this;
    }

    public function set_password($password): self {
        $this->password = $password;
        return $this;
    }

    public function set_user_role_id($user_role_id): self {
        $this->user_role_id = $user_role_id;
        return $this;
    }
}
