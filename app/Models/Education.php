<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    /**
     * Назва таблиці, пов'язаної з моделлю.
     *
     * @var string
     */
    protected $table = 'educations';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Атрибути, які повинні бути приведені до нативних типів.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * Атрибути, які можна масово призначати (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Зв'язок один до багатьох з працівниками VOHOR.
     * Одна освіта може бути у багатьох працівників VOHOR.
     */
    public function vhEmployees(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Vh\Employee::class, 'education_id', 'id');
    }
}
