<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        return $this->belongsTo(Departments::class);
    }
    public function project()
    {
        return $this->belongsToMany(Project::class);
    }
    public function note()
    {
        return $this->morphMany(Note::class, 'notable');
    }
    public function getFirstNameAttribute()
    {
        return ucfirst($this->first_name);
    }
    public function setFirstNameAttribute($firstName)
    {
        $this->attributes['fisrt_name'] = ucfirst($firstName);
    }
    public function getLastNameAttribute()
    {
        return ucfirst($this->last_name);
    }
    public function setLastNameAttribute($lastName)
    {
        $this->attributes['last_name'] = ucfirst($lastName);
    }
}
