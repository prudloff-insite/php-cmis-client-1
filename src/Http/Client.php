<?php

namespace CMIS\Http;

use CMIS\Session\Session;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;

class Client
{

    /**
     * CMIS user name.
     * @var string
     */
    private string $user;

    /**
     * CMIS password.
     * @var string
     */
    private string $password;

    /**
     * @var \GuzzleHttp\Client
     */
    private \GuzzleHttp\Client $httpClient;


    /**
     * @return $this
     */
    public function initialize(): static
    {
        $this->httpClient = new \GuzzleHttp\Client(
            [
                "auth" => [
                    $this->user,
                    $this->password
                ]
            ]
        );
        return $this;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $user
     * @return Client
     */
    public function setUser(string $user): static
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function getHttpClient(): \GuzzleHttp\Client
    {
        return $this->httpClient;
    }

    /**
     * @param string $password
     * @return Client
     */
    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Creates a new post request.
     *
     * @param Request $request
     * @return Response
     * @throws GuzzleException
     */
    public function post(Request $request): Response
    {
        return $this->httpClient->post($request->getUrl(), ["form_params" => $request->getMergedPostFields()]);
    }
}
