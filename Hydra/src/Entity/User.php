<?php
/**
 * Created by PhpStorm.
 * User: Lisac1
 * Date: 23/01/2019
 * Time: 14:55
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
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
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=80, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $gender;
    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $joindate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $birthdate;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $role;

    /**
     * 1: Silver 1
     * 2: Silver 2
     * 3: Silver 3
     * 4: Silver 4
     * 5: Silver Elite
     * 6: Silver Elite Master
     * 7: Nova 1
     * 8: Nova 2
     * 9: Nova 3
     * 10: Nova Master
     * 11: Master Guardian
     * 12: Master Guardian 2
     * 13: Master Guardian Elite
     * 14: Distinguished Master Guardian
     * 15: Legendary Eagle
     * 16: Legendary Eagle Master
     * 17: Supreme Master First Class
     * 18: The Global Elite
     * @ORM\Column(type="integer", nullable=true)
     */
    private $csgo_actual_rank;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $csgo_best_rank;

    /**
     * 1: Bronze
     * 2: Silver
     * 3: Gold
     * 4: Platinum
     * 5: Diamond
     * 6: Master
     * 7: GrandMaster
     * 8: Top 500
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ow_actual_rank;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ow_best_rank;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $pubg_link;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getpseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param mixed $pseudo
     */
    public function setpseudo($pseudo): void
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getJoindate()
    {
        return $this->joindate;
    }

    /**
     * @param mixed $joindate
     */
    public function setJoindate($joindate): void
    {
        $this->joindate = $joindate;
    }

    /**
     * @return mixed
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * @param mixed $birthdate
     */
    public function setBirthdate($birthdate): void
    {
        $this->birthdate = $birthdate;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role): void
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getCsgoActualRank()
    {
        return $this->csgo_actual_rank;
    }

    /**
     * @param mixed $csgo_actual_rank
     */
    public function setCsgoActualRank($csgo_actual_rank): void
    {
        $this->csgo_actual_rank = $csgo_actual_rank;
    }

    /**
     * @return mixed
     */
    public function getCsgoBestRank()
    {
        return $this->csgo_best_rank;
    }

    /**
     * @param mixed $csgo_best_rank
     */
    public function setCsgoBestRank($csgo_best_rank): void
    {
        $this->csgo_best_rank = $csgo_best_rank;
    }

    /**
     * @return mixed
     */
    public function getOwActualRank()
    {
        return $this->ow_actual_rank;
    }

    /**
     * @param mixed $ow_actual_rank
     */
    public function setOwActualRank($ow_actual_rank): void
    {
        $this->ow_actual_rank = $ow_actual_rank;
    }

    /**
     * @return mixed
     */
    public function getOwBestRank()
    {
        return $this->ow_best_rank;
    }

    /**
     * @param mixed $ow_best_rank
     */
    public function setOwBestRank($ow_best_rank): void
    {
        $this->ow_best_rank = $ow_best_rank;
    }

    /**
     * @return mixed
     */
    public function getPubgLink()
    {
        return $this->pubg_link;
    }

    /**
     * @param mixed $pubg_link
     */
    public function setPubgLink($pubg_link): void
    {
        $this->pubg_link = $pubg_link;
    }

    /**
     * @return mixed
     */
    public function getgender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setgender($gender): void
    {
        $this->gender = $gender;
    }
}