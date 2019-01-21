<?php
/*require 'Kapazit-ts-bersicht\EmailValidator.php';*/
require 'C:\Users\Nadine\Documents\HS Furtwangen\Vorlesung\BAM\BAM2\Software Projektmanagement\Kaue-Repo\Kapazit-ts-bersicht\EmailValidator.php';
use PHPUnit\Framework\TestCase;
class EmailValidatorTest extends TestCase
{
    /**
     * @var EmailValidator
     */
    protected $emailValidator;

    /**
     * Setup the test class.
     */
    public function setUp()
    {
        $this->emailValidator = new EmailValidator();
    }

    /**
     * Test if the email validation validates email addresses.
     *
     * @dataProvider emailDataProvider
     *
     * @param string  $email
     * @param bool    $result
     */
    public function testEmailValidation(string $email, bool $result)
    {
        $validated = $this->emailValidator->isValid($email);

        $this->assertEquals($result, $validated, 'The provided email address is not valid.');
    }

    
/**
* Return the email validation dataProvider based on yaml fixture file.
*
* @return array
*/
public function emailDataProvider()
{
    return [
        ['test@example.com', true],
        ['invalidemail.com', false],
    ];
}
}
?>