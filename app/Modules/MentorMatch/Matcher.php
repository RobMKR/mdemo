<?php

namespace App\Modules\MentorMatch;

use Illuminate\Support\Arr;

class Matcher
{
    private $employees;
    private $totalCount;
    private $matches;

    /**
     * Matcher constructor.
     * @param Employee[] $employees
     */
    public function __construct(array $employees)
    {
        $this->employees = $employees;
        $this->totalCount = count($employees);

        foreach ($this->employees as $index => $employee) {
            $this->getMatches($employee, $index);
        }

        $this->normalize();
    }

    /**
     * Normalize matches array
     *
     * @return $this
     */
    private function normalize()
    {
        $tmp = [];
        $tmpRels = [];

        foreach ($this->matches as $cId => $match) {
            // We will ski[ all duplicates from matches array
            if (isset($tmpRels[$cId])) {
                continue;
            }

            $tmp[] = Arr::only($match, ['score', 'employees']);
            $tmpRels[$match['rel']] = 1;
        }

        $this->matches = $tmp;

        return $this;
    }

    /**
     * @param Employee $employee1
     * @param Employee $employee2
     * @param false $reversed
     * @return string
     */
    private function getCompositeKey(Employee $employee1, Employee $employee2, $reversed = false) {
        if ($reversed) {
            return $employee2->getId() . '|' . $employee1->getId();
        }

        return $employee1->getId() . '|' . $employee2->getId();
    }

    /**
     * @param Employee $employee1
     * @param Employee $employee2
     * @param $score
     */
    private function addScore(Employee $employee1, Employee $employee2, $score)
    {
        $key    = $this->getCompositeKey($employee1, $employee2);
        $revKey = $this->getCompositeKey($employee1, $employee2, true);

        if (!isset($this->matches[$key])) {
            $this->matches[$key]['score']       = $score;
            $this->matches[$revKey]['score']    = $score;
            $this->matches[$key]['rel']         = $revKey;
            $this->matches[$revKey]['rel']      = $key;

            $this->matches[$key]['employees']   = [
                $employee1,
                $employee2
            ];
            $this->matches[$revKey]['employees']   = [
                $employee1,
                $employee2
            ];
        } else {
            $this->matches[$key]['score']       += $score;
            $this->matches[$revKey]['score']    += $score;
        }
    }

    /**
     * @param Employee $employee
     * @param int $index
     */
    private function getMatches(Employee $employee, int $index)
    {
        // We need to start from next employee
        $index = $index + 1;

        while (isset($this->employees[$index])) {
            $nextEmployee = $this->employees[$index];

            if ($employee->getDivision() === $nextEmployee->getDivision()) {
                $this->addScore($employee, $nextEmployee, 30);
            }

            if ($employee->getTimezone() === $nextEmployee->getTimezone()) {
                $this->addScore($employee, $nextEmployee, 40);
            }

            if (abs($employee->getAge() - $nextEmployee->getAge()) <= 5) {
                $this->addScore($employee, $nextEmployee, 30);
            }

            $index++;
        }
    }

    /**
     * Get all employees which have matched
     *
     * @return mixed
     */
    public function getMatchedEmployees()
    {
        return $this->matches;
    }

    /**
     * Get average matching score
     *
     * @return float
     */
    public function getAverage()
    {
        $total = 0;
        $totalMatched = 0;

        foreach ($this->matches as $match) {
            $total += $match['score'];
            $totalMatched++;
        }

        return round($total / $totalMatched, 2);
    }
}
