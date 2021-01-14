<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Person
 * @package App\Models
 */
class Person extends Model
{
    use SoftDeletes;
    use Uuid;

    /**
     * @var string
     */
    protected $table = 'persons';
    /**
     * @var string[]
     */
    protected $fillable = [
        'cpf',
        'name',
        'email',
        'phone',
    ];
    /**
     * @var string[]
     */
    protected $guarded = [
        'deleted_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(Person::class, 'person_id');
    }
}
