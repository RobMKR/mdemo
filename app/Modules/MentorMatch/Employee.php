<?php

namespace App\Modules\MentorMatch;

class Employee
{
    private $uid;
    private $name;
    private $email;
    private $division;
    private $age;
    private $timezone;

    /**
     * @param $colName
     * @param $colKey
     * @param $employee
     */
    protected function setCol($colName, $colKey, &$employee)
    {
        $colName = strtolower($colName);

        $this->uid = 'UID_' . md5(microtime());

        if (property_exists($this, $colName)) {
            $this->{$colName} = $employee[$colKey];
        }
    }

    /**
     * Employee constructor.
     * @param array $employee
     * @param array $headers
     */
    public function __construct(array $employee, array $headers)
    {
        foreach ($headers as $key => $header) {
            $this->setCol($header, $key, $employee);
        }
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->uid;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getDivision(): string
    {
        return $this->division;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @return int
     */
    public function getTimezone(): int
    {
        return $this->timezone;
    }
}
