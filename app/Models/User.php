<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

/**
 * Клас моделі User.
 *
 * Цей клас представляє користувача системи та взаємодіє з таблицею 'users' у базі даних.
 * Він включає стандартні можливості Laravel для автентифікації, сповіщень, API токенів,
 * фабрик моделей, а також реалізує м'яке видалення та приклади зв'язків з ролями та рівнями.
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * Назва таблиці, пов'язаної з моделлю.
     *
     * За замовчуванням Eloquent використовує множинну форму snake_case назви моделі.
     * Явно вказано для наочності.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Первинний ключ для моделі.
     *
     * За замовчуванням Eloquent передбачає первинний ключ з ім'ям 'id'.
     * Явно вказано для наочності.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Вказує, чи використовує модель автоінкрементний первинний ключ.
     *
     * За замовчуванням true для цілочисельних первинних ключів.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Тип даних первинного ключа.
     *
     * За замовчуванням 'int' для автоінкрементних первинних ключів.
     *
     * @var string
     */
    protected $keyType = 'int';


    /**
     * Вказує, чи повинна модель використовувати часові мітки (timestamps).
     *
     * За замовчуванням Eloquent керує колонками `created_at` та `updated_at`.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Атрибути, які можна масово призначати (mass assignable).
     *
     * Визначає атрибути, які можуть бути заповнені за допомогою масового призначення.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'login',
        'email',
        'password',
        'level_id',
    ];

    /**
     * Атрибути, які повинні бути приховані при серіалізації моделі.
     *
     * Приховує чутливу інформацію, таку як паролі.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Атрибути, які повинні бути приведені до нативних типів.
     *
     * Використовується для автоматичного перетворення типів даних.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * Атрибути, які повинні бути завантажені разом з моделлю за замовчуванням.
     *
     * Розкоментуйте, якщо потрібно завжди завантажувати певні зв'язки.
     *
     * @var array<int, string>
     */
    // protected $with = ['roles', 'level'];

    /**
     * Кількість елементів, що відображаються на сторінці при пагінації.
     *
     * Встановлює значення за замовчуванням для методу `paginate()`.
     *
     * @var int
     */
    protected $perPage = 15;

    /**
     * Визначає зв'язок "багато до багатьох" з моделлю RoleUser.
     *
     * Користувач може мати багато ролей.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(RoleUser::class, 'role_user', 'user_id', 'role_id')->withTimestamps();
    }

    /**
     * Визначає зв'язок "один до багатьох" (зворотний) з моделлю Level.
     *
     * Користувач належить до одного рівня.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function level(): BelongsTo
    {
        return $this->belongsTo(UserLevel::class, 'level_id');
    }

    /**
     * Локальний скоуп для вибірки користувачів певного типу (рівня).
     *
     * @param  \Illuminate\Database\Eloquent\Builder<User>  $query
     * @param  string  $levelName Назва рівня.
     * @return \Illuminate\Database\Eloquent\Builder<User>
     */
    public function scopeOfLevel(Builder $query, string $levelName): Builder
    {
        return $query->whereHas('level', function (Builder $q) use ($levelName) {
            $q->where('name', $levelName);
        });
    }

    /**
     * Знаходить користувача за його електронною поштою.
     *
     * @param  string  $email Електронна пошта користувача.
     * @return static|null Модель User або null, якщо не знайдено.
     */
    public static function findByEmail(string $email): ?static
    {
        return static::where('email', $email)->first();
    }
}
