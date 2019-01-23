<?php
/**
 * Created by PhpStorm.
 * User: Lisac1
 * Date: 23/01/2019
 * Time: 14:55
 */

namespace App\Entity;


class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80, nullable=false, unique=true)
     */
    private $nickname;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=80, nullable=false, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $joindate;
}