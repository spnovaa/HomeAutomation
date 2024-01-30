<?php

namespace App\HelperClasses\Messages;

use App\HelperClasses\Enums\ServiceMessage\ServiceMessageCode;
use App\Traits\JsonSerializable;

class ServiceMessage implements \JsonSerializable
{
    private $code;
    private $message;
    private $extra_info;

    public function __construct(string $code = null, string $message = null)
    {
        $this->code = $code;
        $this->message = $message;
    }

    public static function Error(?string $message): ServiceMessage
    {
        return new self(ServiceMessageCode::ERROR, $message);
    }

    public static function Success(?string $message): ServiceMessage
    {
        return new self(ServiceMessageCode::SUCCESS, $message);
    }

    public function makeMessage(string $status, ?string $Identifier, string $message): ServiceMessage
    {
        $this->code = $status;
        if (empty($Identifier))
            $this->message = $message;
        else
            $this->message = $Identifier . ' : ' . $message;

        return $this;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getExtraInfo()
    {
        return $this->extra_info;
    }

    /**
     * @param mixed $extra_info
     */
    public function setExtraInfo($extra_info): void
    {
        $this->extra_info = $extra_info;
    }

    public function isErrorType(): bool
    {
        return $this->getCode() == ServiceMessageCode::ERROR;
    }

    public function isSuccessType(): bool
    {
        return $this->getCode() == ServiceMessageCode::SUCCESS;
    }


    /**
     * <p>This method might be more handy for key messages e.g: SERVER_ERROR</p>
     *
     * <p><b>i.e: $res->isMessage('SERVER_ERROR') ~ $res->getMessage = 'SERVER_ERROR'</b></p>
     * @param string|null $message
     * @return bool
     * <p>If the argument matches the instance message, the return value would be true.</p>
     */
    public function isMessage(?string $message): bool
    {
        if (is_null($message)) return is_null($this->getMessage());

        return strtolower($this->getMessage()) == strtolower($message);
    }

    use JsonSerializable;
}