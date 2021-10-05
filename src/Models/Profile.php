<?php

namespace KontribusiKuy\LapackProfiles\Models;

use Illuminate\Database\Eloquent\Model;
use KontribusiKuy\Latraits\ApiResponseTrait;
use KontribusiKuy\Latraits\ExternalLinkTrait;
use KontribusiKuy\Latraits\ValidateTrait;

class Profile extends Model
{
    use ApiResponseTrait, ExternalLinkTrait, ValidateTrait;

    protected $fillable = [
        'name',
        'gender',
        'birthdate',
    ];

    protected $rules = [
        'name' => 'required',
        'birthdate' => 'nullable|date_format:Y-m-d'
    ];

    public function createData($params)
    {
        $this->validates($params, $this->rules);
        return Profile::create($params);
    }

    public function updateData($params)
    {
        $this->validates($params, $this->rules);
        return $this->update($params);
    }

    public function deleteData($force = false)
    {
        if ($force) {
            $this->delete();
        }

        $this->update([
            'is_archived' => 1
        ]);
    }
}
