<?php
namespace App\Http\Controllers;

use App\Models\Santa;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SantaController extends Controller
{
    public function index(Santa $id)
    {
        $user = User::findOrFail($id->user_id);
        $santaFor = User::findOrFail($id->santa_for);
        $hasSanta = DB::table('users')
            ->leftJoin('santas', 'users.id', '=', 'santas.user_id')
            ->where('santa_for', $id->user_id)
            ->select('users.nick')
            ->first();

        return response()->json([
            'username' => $user->nick,
            'santa_for' => $santaFor->nick,
            'has_santa' => $hasSanta->nick
        ]);
    }
}
