<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Course;


class CoursesImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) 
        {
            $location = $this->getLocation($row);
            $centerId = $this->getCenterId($row);

            $student = new Student();
            $student->name = $row['name'];
            $student->date_of_birth = $row['dob'];
            $student->gender = $row['gender'];
            $student->nida = $row['nida'];
            $student->region = $location->rname;
            $student->district = $location->dname;
            $student->ward = $row['ward'];
            $student->street = $row['street'];
            $student->education_level = $row['education_level'];
            $student->education_type = $row['education_type'];
            $student->marital_status = $row['marital_status'];
            $student->employment_status = $row['employment_status'];
            $student->disability = $row['disability'];
            $student->phone_number = $row['phone_number'];
            $student->email = $row['student_email'];   
            $student->center_id = $centerId;
            $student->profile_picture = Storage::path($row['path_passport']);
            $student->birth_certificate = Storage::path($row['path_certificate']);
            $student->letter = Storage::path($row['path_letter']);
            $student->status = "continuous";
            $student->stage = $row['stage'];
            $student->save();

            $parent = new Guardian();
            $parent->name = $row['parent'];
            $parent->phone = $row['parent_phone'];
            $parent->email = $row['parent_email'];
            $parent->address = $row['parent_address'];
            $parent->occupation = $row['parent_occupation'];
            $parent->disability = $row['pdissability'];
            $parent->region = $location->rname;
            $parent->district = $location->dname;
            $parent->ward = $row['pward'];
            $parent->student_id = $student->id;
            $parent->save();
        }
    }

    private function getLocation()
    {
        // Logic to get the location from the row data
        // Example:
        return (object) [
            'rname' => $row['region'],
            'dname' => $row['district']
        ];
    }

    private function getCenterId($row)
    {
        // Logic to get the center ID from the row data or any other source
        // Example:
        return $row['center_id'];
    }
}
