<?php


namespace ShareMyArt\Model\Validation\Rule;


use DateTime;

class DateInputValidator extends RuleCommand
{

    /**
     * @param array $userInsertedData
     * @return array
     * @throws \Exception
     */
    public function validate(array $userInsertedData): array
    {
        if (array_key_exists('captureDate', $userInsertedData)
            && !$this->isDateValid($userInsertedData['captureDate'])
        ) {
            return ['captureDateError' => 'Unless you are from the future, the date you entered is not valid'];
        }

        return [];

    }

    /**
     * @param string $date
     * @return bool
     * @throws \Exception
     */
    function isDateValid(string $date): bool
    {
        $date = new DateTime($date);
        $currentDate = new DateTime();

        if ($date <= $currentDate) {
            return true;
        }
        return false;
    }
}