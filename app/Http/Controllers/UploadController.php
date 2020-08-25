<?php

namespace App\Http\Controllers;

use App\Modules\MentorMatch\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class UploadController extends Controller
{
    /**
     * Logic for getting file
     * Here we can store it somewhere
     * Or return directly from tmp folder
     *
     * @param UploadedFile $file
     * @return array|false
     */
    private function getFile(UploadedFile $file)
    {
        return file($file->getRealPath());
    }

    /**
     * Parse csv
     *
     * @param array $data
     * @return array
     * @throws \Exception
     */
    private function parseCsv(array $data)
    {
        if (count($data) === 0) {
            throw new \Exception('Empty csv');
        }

        return [
            $data[0],
            array_slice($data, 1)
        ];
    }

    /**
     * @param $_employees Employee[]
     */
    private function store($_employees)
    {
        // We will put data in session
        // To be able to use in other pages
        // Cause we haven't connected database to our app ;)
        session()->put('employees', $_employees);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'csv' => 'required|file|mimes:csv,txt'
        ]);

        try {
            if (!$request->file('csv')->isValid()) {
                throw new \Exception('Invalid File');
            }

            $data = array_map('str_getcsv', $this->getFile($request->file('csv')));

            list($headers, $employees) = $this->parseCsv($data);

            $_employees = [];

            foreach ($employees as $employee) {
                $_employees[] = new Employee($employee, $headers);
            }

            $this->store($_employees);

            return redirect('/employees');
        } catch (\Exception $e) {
            // Here we need to flush error message and redirect back to show error messages in front end
            // Also it would be better to throw custom Exception instead of global, to be able to detect manual errors
        }
    }
}
