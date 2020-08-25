<?php

namespace App\Modules\MentorMatch;

class Mentor
{
    private $employee;
    private $mentor;

    /**
     * MatchedEmployee constructor.
     * @param Employee $employee
     * @param Employee $mentor
     */
    public function __construct(Employee $employee, Employee $mentor)
    {
        $this->employee = $employee;
        $this->mentor = $mentor;
    }
}
