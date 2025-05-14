<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes; // Додано для м'якого видалення
use Illuminate\Database\Eloquent\Builder; // Додано для статичних методів-скоупів

/**
 * Клас моделі User.
 *
 * Цей клас представляє користувача системи та взаємодіє з таблицею 'users' у базі даних.
 * Він включає стандартні можливості Laravel для автентифікації, сповіщень, API токенів,
 * фабрик моделей, а також реалізує м'яке видалення та приклади зв'язків.
 * Цей клас може слугувати зразком для створення інших моделей у проєкті Petamicr.
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * Назва таблиці, пов'язаної з моделлю.
     *
     * Кожна модель Eloquent за замовчуванням пов'язана з таблицею,
     * ім'я якої є множинною формою назви моделі в snake_case.
     * Якщо назва таблиці відрізняється, її слід вказати явно.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Первинний ключ для моделі.
     *
     * Eloquent передбачає, що кожна таблиця має первинний ключ з ім'ям 'id'.
     * Якщо первинний ключ вашої таблиці має інше ім'я, ви повинні вказати його тут.
     * За замовчуванням тип первинного ключа - integer з автоінкрементом.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Вказує, чи використовує модель автоінкрементний первинний ключ.
     *
     * Якщо ваш первинний ключ не є автоінкрементним (наприклад, UUID),
     * встановіть цю властивість у false.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Тип даних первинного ключа.
     *
     * Якщо ваш первинний ключ не є цілим числом (integer), наприклад, UUID,
     * вам слід вказати тип ключа тут. Це важливо для правильної роботи деяких функцій Eloquent.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * Вказує, чи повинна модель використовувати часові мітки (timestamps).
     *
     * Eloquent автоматично керує колонками `created_at` та `updated_at`.
     * Якщо ваша таблиця не має цих колонок, або ви не хочете, щоб Eloquent ними керував,
     * встановіть цю властивість у `false`.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Атрибути, які можна масово призначати (mass assignable).
     *
     * Властивість `$fillable` визначає, які атрибути моделі можна заповнювати
     * за допомогою методів `create()` або `fill()`. Це міра безпеки для захисту
     * від несанкціонованого масового призначення даних.
     * Кожна модель, яка передбачає створення або оновлення через масове призначення,
     * повинна мати цю властивість.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'level_id', // Додано level_id, якщо він теж масово призначається
    ];

    /**
     * Атрибути, які повинні бути приховані при серіалізації моделі.
     *
     * Атрибути, перелічені в `$hidden`, не будуть включені в масиви або JSON-представлення
     * моделі. Це корисно для приховування чутливої інформації, такої як паролі.
     * Майже кожна модель, що представляє користувача або містить конфіденційні дані,
     * повинна мати цю властивість.
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
     * Властивість `$casts` дозволяє автоматично перетворювати значення атрибутів
     * до певних типів даних при їх отриманні з моделі або збереженні.
     * Це корисно для роботи з датами, булевими значеннями, JSON тощо.
     * Моделі, що працюють з такими типами даних, повинні використовувати цю властивість.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'created_at' => 'datetime:Y-m-d H:i:s', // Приклад явного форматування дати
        'updated_at' => 'datetime:Y-m-d H:i:s', // Приклад явного форматування дати
        // 'is_admin' => 'boolean', // Приклад для булевого значення
        // 'options' => 'array', // Приклад для JSON
    ];

    /**
     * Атрибути, які повинні бути завантажені разом з моделлю за замовчуванням.
     *
     * Властивість `$with` дозволяє вказати зв'язки, які завжди повинні
     * завантажуватися разом з моделлю при її отриманні з бази даних.
     * Це може бути корисним для оптимізації запитів, але слід використовувати обережно,
     * щоб не завантажувати зайві дані.
     *
     * @var array<int, string>
     */
    // protected $with = ['roles', 'level']; // Приклад

    /**
     * Кількість елементів, що відображаються на сторінці при пагінації.
     *
     * Ця властивість встановлює значення за замовчуванням для пагінації,
     * коли використовується метод `paginate()` на моделі без явного вказання кількості.
     *
     * @var int
     */
    protected $perPage = 15;

    /**
     * Визначає зв'язок "багато до багатьох" з моделлю Role.
     *
     * Цей метод описує, що користувач може мати багато ролей,
     * і одна роль може належати багатьом користувачам.
     * Використання таких методів для визначення зв'язків є стандартною практикою в Eloquent.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id')->withTimestamps();
        // ->withTimestamps() додано для автоматичного оновлення created_at/updated_at у проміжній таблиці
    }

    /**
     * Визначає зв'язок "один до багатьох" (зворотний) з моделлю Level.
     *
     * Цей метод описує, що користувач належить до одного рівня.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    /**
     * Аксесор для отримання повного імені користувача.
     *
     * Аксесори дозволяють форматувати значення атрибутів Eloquent при їх отриманні.
     * Наприклад, об'єднати ім'я та прізвище, або змінити формат дати.
     * Назва методу повинна починатися з 'get', за яким слідує назва атрибута в CamelCase,
     * і закінчуватися 'Attribute'.
     *
     * @param  string|null  $value Значення атрибута 'name' з бази даних.
     * @return string
     */
    public function getFullNameAttribute(?string $value): string
    {
        return ucfirst($this->name); // Приклад, якщо 'name' - це повне ім'я
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
     * Статичні методи можуть бути корисними для створення зручних способів
     * отримання моделей за певними критеріями.
     *
     * @param  string  $email Електронна пошта користувача.
     * @return static|null Модель User або null, якщо не знайдено.
     */
    public static function findByEmail(string $email): ?static
    {
        return static::where('email', $email)->first();
    }
}
