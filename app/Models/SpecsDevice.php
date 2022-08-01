<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class SpecsDevice extends Model
{
//    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'name',
        'slug',
        'data',
        'position',
        'author_id',
    ];

    public function save(array $options = [])
    {
        $this->dataPrepare();
        return parent::save($options);
    }

    protected function dataPrepare()
    {
        if(!isset($this->data) || !is_array($this->data))
            return;

        $data = [];
        foreach ($this->data as $key => $value){
            if($value !== null)
                $data[$key] = $value;
        }
        $this->data = json_encode($data);
    }

    public function vendor()
    {
        return $this-> belongsTo(SpecsVendor::class);
    }
}
