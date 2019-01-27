<?php
/**
 * Created by PhpStorm.
 * User: Lisac1
 * Date: 23/01/2019
 * Time: 14:55
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="`user`")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
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
    private $username;

    /**
     * @ORM\Column(type="string", length=4096)
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
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     * @ORM\Column(type="string", length=80, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $gender;

    /**
     * @ORM\Column(type="date")
     */
    private $joindate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthdate;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $role;

    /**
     * 0: Never Played
     * 1: Unranked
     * 2: Silver 1
     * 3: Silver 2
     * 4: Silver 3
     * 5: Silver 4
     * 6: Silver Elite
     * 7: Silver Elite Master
     * 8: Nova 1
     * 9: Nova 2
     * 10: Nova 3
     * 11: Nova Master
     * 12: Master Guardian
     * 13: Master Guardian 2
     * 14: Master Guardian Elite
     * 15: Distinguished Master Guardian
     * 16: Legendary Eagle
     * 17: Legendary Eagle Master
     * 18: Supreme Master First Class
     * 19: The Global Elite
     * @ORM\Column(type="integer", nullable=true)
     */
    private $csgoActualRank;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $csgoBestRank;

    /**
     * 0: Never Played
     * 1: Unranked
     * 2: Bronze
     * 3: Silver
     * 4: Gold
     * 5: Platinum
     * 6: Diamond
     * 7: Master
     * 8: GrandMaster
     * 9: Top 500
     * @ORM\Column(type="integer", nullable=true)
     */
    private $owActualRank;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $owBestRank;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $pubgLink;

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        // Salt is a way to encript password, but i'm already encrypting the password with bcrypt in security.yaml
        return null;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized, array('allowed_classes' => false));
    }

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
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
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
        return $this->csgoActualRank;
    }

    /**
     * @param mixed $csgoActualRank
     */
    public function setCsgoActualRank($csgoActualRank): void
    {
        $this->csgoActualRank = $csgoActualRank;
    }

    /**
     * @return mixed
     */
    public function getCsgoBestRank()
    {
        return $this->csgoBestRank;
    }

    /**
     * @param mixed $csgoBestRank
     */
    public function setCsgoBestRank($csgoBestRank): void
    {
        $this->csgoBestRank = $csgoBestRank;
    }

    /**
     * @return mixed
     */
    public function getOwActualRank()
    {
        return $this->owActualRank;
    }

    /**
     * @param mixed $owActualRank
     */
    public function setOwActualRank($owActualRank): void
    {
        $this->owActualRank = $owActualRank;
    }

    /**
     * @return mixed
     */
    public function getOwBestRank()
    {
        return $this->owBestRank;
    }

    /**
     * @param mixed $owBestRank
     */
    public function setOwBestRank($owBestRank): void
    {
        $this->owBestRank = $owBestRank;
    }

    /**
     * @return mixed
     */
    public function getPubgLink()
    {
        return $this->pubgLink;
    }

    /**
     * @param mixed $pubgLink
     */
    public function setPubgLink($pubgLink): void
    {
        $this->pubgLink = $pubgLink;
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