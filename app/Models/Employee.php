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
    public function getFullNameAttribute()
    {
        return $this->fisrt_name . '' . $this->last_name;
    }
}
