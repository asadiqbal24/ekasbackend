<?php

namespace App\Imports;


use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\AddCourse;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class CourseImport implements ToModel, WithHeadingRow
{
    use Importable;
    public function model(array $row)
    {
        return new AddCourse([
            'universityname' => $row['university_name'],
            'programmename' => $row['programme_name'],
            'ranking' => $row['ranking'],
            'level' => $row['level'],
            'courseranking' => $row['course_ranking'],
            'tuitionfee' => $row['tuition_fee'],
            'location' => $row['location'],
            'EntryRequirement' => $row['entry_requirement'],
            'IELTSTOFELRequirement' => $row['ieltstoefl_requirement'],
            'GREGMATSATRequirement' => $row['gregmat_requirement'],
            'Applicationopen' => $row['application_open'],
            'ApplicationDeadline' => $row['application_deadline'],
            'URL' => $row['url'],
            'title' => $row['title'],
            'namelocation' => $row['name_location'],
            'studymode' => $row['study_mode'],
            'fieldofstudy' => $row['field_of_study'],
            
        ]);
    }
}
