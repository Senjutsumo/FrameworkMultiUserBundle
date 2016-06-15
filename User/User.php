<?php

namespace SumoCoders\FrameworkMultiUserBundle\User;

use SumoCoders\FrameworkMultiUserBundle\Security\PasswordResetToken;

class User implements UserInterface, PasswordReset
{
    /** @var string */
    private $username;

    /** @var string */
    private $password;

    /** @var string */
    private $displayName;

    /** @var */
    private $passwordResetToken;

    /** @var */
    private $email;

    /**
     * @param string $username
     * @param string $password
     * @param string $displayName
     */
    public function __construct($username, $password, $displayName, $email)
    {
        $this->username = $username;
        $this->password = $password;
        $this->displayName = $displayName;
        $this->email = $email;
    }

    /**
     * {@inheritDoc}
     */
    public function getRoles()
    {
        return [ 'ROLE_USER' ];
    }

    /**
     * {@inheritDoc}
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * {@inheritDoc}
     */
    public function getSalt()
    {
        return;
    }

    /**
     * {@inheritDoc}
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * {@inheritDoc}
     */
    public function eraseCredentials()
    {
        return;
    }

    /**
     * {@inheritDoc}
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return $this->getDisplayName();
    }

    /**
     * {@inheritdoc}
     */
    public function clearPasswordResetToken()
    {
        $this->passwordResetToken = null;

        return $this;
    }

    /**
     * @return self
     */
    public function generatePasswordResetToken()
    {
        $this->passwordResetToken = PasswordResetToken::getToken();

        return $this;
    }

    /**
     * @return string
     */
    public function getPasswordResetToken()
    {
        return $this->passwordResetToken;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param $password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}
