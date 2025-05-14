<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Клас моделі RoleUser (зведена таблиця).
 *
 * Цей клас представляє запис у зведеній таблиці `role_user`,
 * яка реалізує зв'язок "багато-до-багатьох" між користувачами (User) та ролями (Role).
 * Він успадковує клас `Illuminate\Database\Eloquent\Relations\Pivot`,
 * що надає спеціалізований функціонал для роботи зі зведеними таблицями.
 */
class RoleUser extends Pivot
{
    use HasFactory;

    /**
     * Назва таблиці бази даних, що асоціюється з цією моделлю.
     *
     * @var string
     */
    protected $table = 'role_user';

    /**
     * Вказує, чи є первинні ключі моделі автоінкрементними.
     * Для зведених таблиць з композитними ключами це значення зазвичай `false`.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Первинний ключ для таблиці.
     * Для зведених таблиць, таких як `role_user`, це зазвичай композитний ключ.
     * Хоча Eloquent `Pivot` не використовує цю властивість так само, як стандартні моделі
     * для операцій типу `find()`, її визначення може бути корисним для ясності.
     * Композитний первинний ключ визначається у міграції таблиці.
     *
     * @var array<int, string>
     */
    protected $primaryKey = ['user_id', 'role_id'];

    /**
     * Вказує, чи повинна модель автоматично обробляти часові мітки `created_at` та `updated_at`.
     * Відповідно до `db_info.json`, таблиця `role_user` має ці стовпці.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Атрибути, які дозволено масово призначати.
     * Це важливо для безпеки при використанні методів типу `create()` або `update()` напряму на моделі.
     * У випадку зведених таблиць, операції частіше виконуються через методи відносин (`attach`, `sync`),
     * але визначення `$fillable` є хорошою практикою.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'role_id',
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
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * Отримує екземпляр користувача (User), до якого відноситься цей запис у зведеній таблиці.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Отримує екземпляр ролі (Role), до якої відноситься цей запис у зведеній таблиці.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
