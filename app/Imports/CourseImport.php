<?php

namespace App\Imports;


use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\AddCourse;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;

class CourseImport implements ToModel, WithHeadingRow
{
    use Importable;


    // public function model(array $row)
    // {

    //     $application_open = is_numeric($row['application_open']) ? Date::excelToDateTimeObject($row['application_open'])->format('Y-m-d') : $row['application_open'];
    //     $application_deadline = is_numeric($row['application_deadline']) ? Date::excelToDateTimeObject($row['application_deadline'])->format('Y-m-d') : $row['application_deadline'];

    //     return new AddCourse([
    //         'universityname' => $row['university_name'],
    //         'programmename' => $row['programme_name'],
    //         'ranking' => $row['ranking'],
    //         'level' => $row['level'],
    //         'fieldofstudy' => $row['subject_field'],
    //         'tuitionfee' => $row['tuition_fee'],
    //         'location' => $row['location'],
    //         'country' => $row['country'],
    //         'EntryRequirement' => $row['entry_requirement'],
    //         'IELTSTOFELRequirement' => $row['ieltstoefl_requirement'],
    //         'GREGMATSATRequirement' => $row['gregmat_requirement'],
    //         'Applicationopen' => $application_open,
    //         'ApplicationDeadline' => $application_deadline,
    //         'URL' => $row['url'],
    //         'title' => $row['title'],
    //         'namelocation' => $row['name_location'],
    //         'studymode' => $row['study_mode'],
    //     ]);
    // }




    public function model(array $row)
    {
        // Check if all fields are empty in the row
        $hasData = false;
        foreach ($row as $value) {
            if (!empty($value)) {
                $hasData = true;
                break;
            }
        }

        // If the entire row is empty, skip this row
        if (!$hasData) {
            return null;
        }

        $application_open = is_numeric($row['application_open']) ? Date::excelToDateTimeObject($row['application_open'])->format('Y-m-d') : $row['application_open'];
        $application_deadline = is_numeric($row['application_deadline']) ? Date::excelToDateTimeObject($row['application_deadline'])->format('Y-m-d') : $row['application_deadline'];

        return new AddCourse([
            'universityname' => $row['university_name'],
            'programmename' => $row['programme_name'],
            'ranking' => $row['ranking'],
            'level' => $row['level'],
            'fieldofstudy' => $row['subject_field'],
            'tuitionfee' => $row['tuition_fee'],
            'location' => $row['location'],
            'country' => $row['country'],
            'EntryRequirement' => $row['entry_requirement'],
            'IELTSTOFELRequirement' => $row['ieltstoefl_requirement'],
            'GREGMATSATRequirement' => $row['gregmat_requirement'],
            'Applicationopen' => $application_open,
            'ApplicationDeadline' => $application_deadline,
            'URL' => $row['url'],
            'title' => $row['title'],
            'namelocation' => $row['name_location'],
            'studymode' => $row['study_mode'],
        ]);
    }
}
