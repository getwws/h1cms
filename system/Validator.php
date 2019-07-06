<?php


namespace system;

/**
 * required - Field is required
 * equals - Field must match another field (email/password confirmation)
 * different - Field must be different than another field
 * accepted - Checkbox or Radio must be accepted (yes, on, 1, true)
 * numeric - Must be numeric
 * integer - Must be integer number
 * boolean - Must be boolean
 * array - Must be array
 * length - String must be certain length
 * lengthBetween - String must be between given lengths
 * lengthMin - String must be greater than given length
 * lengthMax - String must be less than given length
 * min - Minimum
 * max - Maximum
 * in - Performs in_array check on given array values
 * notIn - Negation of in rule (not in array of values)
 * ip - Valid IP address
 * email - Valid email address
 * url - Valid URL
 * urlActive - Valid URL with active DNS record
 * alpha - Alphabetic characters only
 * alphaNum - Alphabetic and numeric characters only
 * slug - URL slug characters (a-z, 0-9, -, _)
 * regex - Field matches given regex pattern
 * date - Field is a valid date
 * dateFormat - Field is a valid date in the given format
 * dateBefore - Field is a valid date and is before the given date
 * dateAfter - Field is a valid date and is after the given date
 * contains - Field is a string and contains the given string
 * creditCard - Field is a valid credit card number
 * instanceOf - Field contains an instance of the given class
 * optional - Value does not need to be included in data array. If it is however, it must pass validation.
 **/
//https://github.com/vlucas/valitron
//http://respect.github.io/Validation/docs/validators.html


/**
 * Class Validator
 * @package system
 */
class Validator extends \Valitron\Validator
{

    const RULE_REQUIRED = 'required';
    const RULE_EMAIL = 'email';
    const RULE_EQUALS = 'equals';
    const RULE_DIFFERENT = 'different';
    const RULE_ACCEPTED = 'accepted';
    const RULE_NUMERIC = 'numeric';
    const RULE_INTEGER = 'integer';
    const RULE_BOOLEAN = 'boolean';
    const RULE_ARRAY = 'array';
    const RULE_LENGTH = 'length';
    const RULE_LENGTH_BETWEEN = 'lengthBetween';
    const RULE_LENGTH_MIN = 'lengthMin';
    const RULE_LENGTH_MAX = 'lengthMax';
    const RULE_MIN = 'min';
    const RULE_MAX = 'max';
    const RULE_IN = 'in';
    const RULE_NOT_IN = 'notIn';
    const RULE_IP = 'ip';
    const RULE_URL = 'url';
    const RULE_URL_ACTIVE = 'urlActive';
    const RULE_ALPHA = 'alpha';
    const RULE_ALPHA_NUM = 'alphaNum';
    const RULE_SLUG = 'slug';
    const RULE_REGEX = 'regex';
    const RULE_DATE = 'date';
    const RULE_DATE_FORMAT = 'dateFormat';
    const RULE_DATE_BEFORE = 'dateBefore';
    const RULE_DATE_AFTER = 'dateAfter';
    const RULE_CONTAINS = 'contains';
    const RULE_CREDITCARD = 'creditCard';
    const RULE_INSTANCE_OF = 'instanceOf';
    const RULE_OPTIONAL = 'optional';


    public static function make($data, $fields = [], $lang = 'zh-cn')
    {
        $instance = new static($data, $fields, $lang);
        $instance->init();
        return $instance;
    }

    /**
     * Get array of error messages
     *
     * @param  null|string $field
     * @return array|bool
     */
    public function first($field = null)
    {
        $error = $this->errors($field);
        if (is_array($error)) {
            return \getw\Arr::get($error, 0);
        }
        return $error;

    }

    public function hasError($field = null)
    {
        if ($field !== null) {
            return isset($this->_errors[$field]);
        }

        return empty($this->_errors);

    }

    protected function init(){

    }


}