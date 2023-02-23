<?php

namespace CFreear\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;

class MailChimp extends AbstractProvider
{
    use BearerAuthorizationTrait;

    /**
     * MailChimp base auth domain
     */
    public $authDomain = 'https://login.mailchimp.com';

    /**
     * MailChimp oauth base url
     */
    public $oAuthUrl = '/oauth2';

    /**
     * Returns the base URL for authorizing a client.
     *
     * @return string
     */
    public function getBaseAuthorizationUrl(): string
    {
        return $this->authDomain.$this->oAuthUrl.'/authorize';
    }

    /**
     * Returns the base URL for requesting an access token.
     *
     * @param array $params
     * @return string
     */
    public function getBaseAccessTokenUrl(array $params): string
    {
        return $this->authDomain.$this->oAuthUrl.'/token';
    }

    /**
     * Returns the URL for requesting the resource owner's details.
     *
     * @param AccessToken $token
     * @return string
     */
    public function getResourceOwnerDetailsUrl(AccessToken $token):string
    {
        return $this->authDomain.$this->oAuthUrl.'/metadata';
    }

    /**
     * Returns the default scopes used by this provider.
     *
     * No scopes for MailChimp!
     *
     * @return array
     */
    protected function getDefaultScopes(): array
    {
        return [];
    }

    /**
     * Checks a provider response for errors.
     *
     * @throws IdentityProviderException
     * @param  ResponseInterface $response
     * @param  array|string $data Parsed response data
     * @return void
     */
    protected function checkResponse(ResponseInterface $response, $data): void
    {
        if ($response->getStatusCode() >= 400) {
            throw new IdentityProviderException(
                $data['error'] ?: $response->getReasonPhrase(),
                $response->getStatusCode(),
                $response->getBody()
            );
        }
    }

    /**
     * Generates a resource owner object from a successful resource owner
     * details request.
     *
     * @param  array $response
     * @param  AccessToken $token
     * @return MailChimpResourceOwner
     */
    protected function createResourceOwner(array $response, AccessToken $token): MailChimpResourceOwner
    {
        return new MailChimpResourceOwner($response);
    }
}
