<?php

namespace App\Models;

use CodeIgniter\Model;

class M_otp extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'otp';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'number',
        'otp',
        'status'

    ];


    public function insert_otp($number)
    {
        do {
            $randomNumber = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
            $this->where('otp', $randomNumber);
            $existingOtp = $this->where('status', 0)->first();
        } while ($existingOtp);

        $this->where('number', $number)->delete();

        $d['number'] = $number;
        $d['otp'] = $randomNumber;

        $in = $this->save($d);

        if ($in) {
            return $randomNumber;
        }

        return false;
    }
}
