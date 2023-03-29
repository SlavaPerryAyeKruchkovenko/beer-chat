<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;

    class Message extends Model
    {
        protected $fillable = [
            "message_date",
            "text",
            "chat_id",
            "user_id"
        ];

        protected $casts = [
            'message_date' => 'datetime',
        ];

        public function users(): BelongsTo
        {
            return $this->belongsTo(User::class);
        }
    }
