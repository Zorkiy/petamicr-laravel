<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Level extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'levels';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Атрибути, які можна призначити масово.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'priority',
    ];

    /**
     * Отримайте користувачів для рівня.
     */
    public function users(): HasMany  // Зв'язок з користувачами
    {
        return $this->hasMany(User::class, 'level_id');
    }

    /**
     * Отримайте ролі для рівня.  // Якщо потрібно отримати ролі, пов'язані з рівнем (можливо, не потрібно напряму)
     */
    public function roles(): HasMany
    {
        return $this->hasMany(Role::class, 'level_id');
    }
}
