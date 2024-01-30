<?php

namespace App\Services\User\Update\Validation;

use App\HelperClasses\Messages\ServiceMessage;
use App\Models\User;
use Throwable;

class Service
{
    public function __construct()
    {
        $this->messages = array_merge($this->messages, [

        ]);
    }


    // This array contains chain of responsibility classes that check if creating is ok or not.
    // according to getValidatorInstanceList method, the head of the chain would be the last
    // element, and they run from bottom to the top. If you intend to add extra checker, you might
    // create a new checker class and add it to the list bellow.
    private array $validator_list = [

    ];


    /**
     * @param User $user
     * @return ServiceMessage
     */
    public function validate(User $user): ServiceMessage
    {
        try {
            $validator_instance_list = $this->getValidatorInstanceList();

            $head = end($validator_instance_list);
            $head->check($user);

        } catch (Throwable $throwable) {
            // If the message is code
            if (array_key_exists($throwable->getMessage(), $this->messages))
                return ServiceMessage::Error($this->messages[$throwable->getMessage()]);

            // If the message is an exception
            return ServiceMessage::Error($throwable->getMessage());
        }

        return ServiceMessage::Success('VALIDATION_OK');
    }


    /**
     * Surf through validator list, make instances of them and set the successor for
     * each of them (except the head of the chain).
     * Note: the successor would be the prior class. So the chain head is the last item
     * @return array
     */
    private function getValidatorInstanceList(): array
    {
        $validator_instance_list = [];
        foreach ($this->validator_list as $index => $validator) {

            $validator_instance = new $validator();
            if ($index > 0) $validator_instance->succeedWith($validator_instance_list[$index - 1]);
            $validator_instance_list[] = $validator_instance;
        }
        return $validator_instance_list;
    }
}
