<?php

namespace ctapu4ok\VkMessengerSdk\Exceptions;

use ctapu4ok\VkMessengerSdk\API\VKApiError;

class VKApiException extends VKException
{
    /**
     * @var int
     */
    protected int $error_code;

    /**
     * @var string
     */
    protected string $description;

    /**
     * @var string
     */
    protected string $error_message;

    /**
     * @var VKApiError
     */
    protected VKApiError $error;

    /**
     * VKApiException constructor.
     *
     * @param int        $error_code
     * @param string     $description
     * @param VKApiError $error
     */
    public function __construct(int $error_code, string $description, VKApiError $error)
    {
        $this->error_code = $error_code;
        $this->description = $description;
        $this->error_message = $error->getErrorMsg();
        $this->error = $error;
        parent::__construct($error->getErrorMsg(), $error_code);
    }

    /**
     * @return int
     */
    public function getErrorCode(): int
    {
        return $this->error_code;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->error_message;
    }

    /**
     * @return VKApiError
     */
    public function getError(): VKApiError
    {
        return $this->error;
    }
}
