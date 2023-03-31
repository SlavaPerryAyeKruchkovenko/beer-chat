<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;

    class Message extends Model
    {
        protected $primaryKey = 'id';

        protected $table = 'messages';

        protected $fillable = [
            "text",
            "chat_id",
            "user_id"
        ];

        public function user(): BelongsTo
        {
            return $this->belongsTo(User::class);
        }
    }
