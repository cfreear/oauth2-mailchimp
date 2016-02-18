<?php

namespace CFreear\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class MailChimpResourceOwner implements ResourceOwnerInterface
{
    /**
     * Raw response
     * @var
     */
    private $response;

    /**
     * Returns the identifier of the authorized resource owner.
     *
     * @return mixed
     */
    public function getId()
    {
        // TODO: Implement getId() method.
    }

    /**
     * Return all of the owner details available as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [];
    }
}