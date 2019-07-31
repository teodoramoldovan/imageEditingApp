<?php


namespace ShareMyArt\Model\Validation\Rule;


class PriceInputValidator extends RuleCommand
{
    /**
     * @param array $userInsertedData
     * @return array
     */
    public function validate(array $userInsertedData): array
    {
        if (array_key_exists('price', $userInsertedData) && !$this->isPriceValid($userInsertedData['price'])) {
            return ['priceError' => 'The price you entered is not valid. It must be a positive number'];
        }

        return [];
    }

    /**
     * Will check if the price is numeric and positive
     *
     * @param string $price
     * @return bool
     */
    function isPriceValid(string $price): bool
    {
        return is_numeric($price) && (float)$price > 0;
    }

}