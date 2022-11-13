<?php
namespace App\Http\Controllers;

use App\Models\Santa;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SantaController extends Controller
{
    public function index(Santa $id)
    {
        $user = User::findOrFail($id->id);

        $santaFor = DB::table('santas')
            ->leftJoin('users', 'santa_for', '=', 'users.id')
            ->where('user_id', $id->id)
            ->select('users.nick')
            ->first();

        $hasSanta = DB::table('santas')
            ->leftJoin('users', 'santas.user_id', '=', 'users.id')
            ->where('santa_for', $id->id)
            ->select('users.nick')
            ->first();

        return response()->json([
            'username' => $user->nick,
            'santa_for' => $santaFor->nick,
            'has_santa' => $hasSanta->nick
        ]);
    }
}
