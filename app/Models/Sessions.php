<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sessions extends Model
{
    protected $table = 'sessions';
    public $incrementing = false;          // Это важно, если id — строка

    public static function getUserSessionsList(int $user_id): array {
        return self::where('user_id', $user_id)
            ->select('id', 'ip_address', 'user_agent', 'last_activity')
            ->get()
            ->toArray();
    }
    public static function deletedSessions(array $sessionsId): void {
        self::whereIn('id', $sessionsId)->delete();
    }

    public static function isUserHaveSessions(int $user_id): bool {
        return self::where('user_id', $user_id)->exists();
    }
}
