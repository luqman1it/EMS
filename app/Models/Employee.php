<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Department;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'first_name',
        'last_name',
        'email'
    ];
    public function find($id)
    {
        $employee = Employee::all();
        foreach ($employee as $emp) {
            if ($employee->id == $id)
                return $emp;
        }
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function project()
    {
        return $this->belongsToMany(Project::class);
    }
    public function note()
    {
        return $this->morphMany(Note::class, 'notable');
    }
    public function getFirstNameAttribute($firstName)
    {
        return ucfirst($firstName);
    }
    public function setFirstNameAttribute($firstName)
    {
        $this->attributes['fisrt_name'] = ucfirst($firstName);
    }
    public function getLastNameAttribute($lastName)
    {
        return ucfirst($lastName);
    }
    public function setLastNameAttribute($lastName)
    {
        $this->attributes['last_name'] = ucfirst($lastName);
    }
}
