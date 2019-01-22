<?php
/**
 * Created by PhpStorm.
 * User: Lisac1
 * Date: 22/01/2019
 * Time: 04:03
 */

class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private $nickname;

    /**
     * @ORM\Column(type="string", length=80, unique=true)
     */
    private $email;
}