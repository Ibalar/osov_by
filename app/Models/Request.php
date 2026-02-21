<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'source_type',
        'source_id',
        'source_title',
        'comment',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'source_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Status options for admin
     */
    public static function getStatusOptions(): array
    {
        return [
            'new' => 'Новая',
            'processed' => 'В обработке',
            'completed' => 'Завершена',
            'rejected' => 'Отклонена',
        ];
    }

    /**
     * Get source type label
     */
    public function getSourceTypeLabelAttribute(): string
    {
        return match ($this->source_type) {
            'service' => 'Услуга',
            'service_category' => 'Категория услуг',
            'landing' => 'Лендинг',
            default => 'Другое',
        };
    }
}
