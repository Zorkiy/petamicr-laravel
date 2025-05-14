<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Клас моделі UserLevel.
 *
 * Цей клас представляє рівні користувачів у системі та взаємодіє з таблицею 'UserLevel' у базі даних.
 * Рівень визначає приналежність користувача до певної групи (наприклад, VOHOR, HELSI).
 */
class UserLevel extends Model
{
    use HasFactory;

    /**
     * Назва таблиці, пов'язаної з моделлю.
     *
     * @var string
     */
    protected $table = 'user_levels';

    /**
     * Первинний ключ для моделі.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Вказує, чи повинна модель використовувати часові мітки (timestamps).
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
     * Отримує користувачів, які належать до цього рівня.
     *
     * Один рівень може мати багато користувачів.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'level_id');
    }
}
