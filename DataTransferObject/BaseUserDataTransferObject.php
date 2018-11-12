<?php

namespace SumoCoders\FrameworkMultiUserBundle\DataTransferObject;

use SumoCoders\FrameworkMultiUserBundle\DataTransferObject\Interfaces\UserDataTransferObject;
use SumoCoders\FrameworkMultiUserBundle\User\Interfaces\User;
use SumoCoders\FrameworkMultiUserBundle\Entity\BaseUser;

class BaseUserDataTransferObject implements UserDataTransferObject
{
    /** @var int|null */
    public $id;

    /** @var string|null */
    public $userName;

    /** @var string|null */
    public $displayName;

    /** @var string|null */
    public $email;

    /** @var string|null */
    public $plainPassword;

    /** @var User */
    protected $user;

    public static function fromUser(User $user): UserDataTransferObject
    {
        $baseUserTransferObject = new static();
        $baseUserTransferObject->user = $user;
        $baseUserTransferObject->id = $user->getId();
        $baseUserTransferObject->userName = $user->getUsername();
        $baseUserTransferObject->displayName = $user->getDisplayName();
        $baseUserTransferObject->email = $user->getEmail();
        if ($user->hasPlainPassword()) {
            $baseUserTransferObject->plainPassword = $user->getPlainPassword();
        }

        return $baseUserTransferObject;
    }

    public function getEntity(): User
    {
        if ($this->user) {
            $this->user->change($this);

            return $this->user;
        }

        return new BaseUser(
            $this->userName,
            $this->plainPassword,
            $this->displayName,
            $this->email
        );
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }
}