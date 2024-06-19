<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\Guardian;
use App\Models\Region;
use App\Models\Center;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentsImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) 
        {
            $location = $this->getLocation();

            $student = new Student();
            $student->name = $row['student_name'];
            $student->registration_number = $row['registration_number'];
            $student->date_of_birth = $row['date_of_birth'];
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
            $student->email = $row['email'];   
            $student->center_id = $this->getCenterId();
            $student->status = "continuous";
            $student->stage = $row['stage'];
            $student->save();

            $parent = new Guardian();
            $parent->name = $row['parent_name'];
            $parent->phone = $row['parent_phone'];
            $parent->email = $row['parent_email'];
            $parent->address = $row['parent_address'];
            $parent->occupation = $row['parent_occupation'];
            $parent->disability = $row['parent_disability'];
            $parent->region = $location->rname;
            $parent->district = $location->dname;
            $parent->ward = $row['parent_ward'];
            $parent->student_id = $student->id;
            $parent->save();
        }
    }

    private function getLocation()
    {
        return Region::select('regions.name as rname', 'districts.name as dname')
            ->join('districts', 'districts.region_id', '=', 'regions.id')
            ->join('centers', 'districts.id', '=', 'centers.district_id')
            ->where('centers.hod_id', '=', Auth::user()->id)
            ->first();
    }

    private function getCenterId()
    {
        return Center::where('hod_id', Auth::user()->id)->value('id');
    }
}
