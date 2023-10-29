<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;

class CustomerImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
            if ($row[0] != 'الاسم') {
                $exists_id = Customer::where('id_number', $row[4])->first();
                if (!$exists_id) {
                    return new Customer([
                        'admin_id' => auth()->user()->id,
                        'name' => $row[0],
                        'phone' => $row[1],
                        'phone2' => $row[2],
                        'phone3' => $row[3],
                        'id_number' => $row[4],
                        'address_id' => $row[5],
                        'address' => $row[6],
                        'governorate' => $row[7],
                        'center' => $row[8],
                        'note' => $row[9],
                    ]);
                }
            }



    }
}
