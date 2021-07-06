<?php
namespace services;

use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class CSVModal implements ToCollection
{
    private $data = [];
    public function collection(Collection $rows)
    {
        $count = 0;
        foreach ($rows as $row)
        {
            if (!empty($row[0]) && $count != 0){
                array_push($this->data, [
                    "domain" => $row[0],
                    "user" => $row[1],
                    "password" => $row[2],
                ]);
            }
            $count = 1;
        }
    }

    public function getData(){
        return $this->data;
    }
}
