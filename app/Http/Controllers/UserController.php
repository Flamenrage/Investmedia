<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $messages = [
            'name.cyrillic' => 'Имя должно содержать только буквы алфавита',
        ];
        $rules = [
            'name' => 'cyrillic|required|max:150|min:3',
            'email' => 'required|email|unique:users', //проверка на уникальность в таблице БД
            'password' => 'required|max:25|min:5|confirmed', //сранивается с confirm_password
        ];
        $this->validate($request, $rules, $messages); //или $request->validate([ 'массив валидационных правил' ]);
        $user = User::create([
            'name' => $request->name, //или $request->input('name');
            'email' => $request->email,
            'password' => Hash::make($request->password), //хэшируем пароль или bcrypt('что-то там');
        ]);
        session()->flash('success', 'Success registration');
        Auth::login($user);
        return redirect()->home();
    }

    public function login(Request $request)
    {

        $rules = [
            'email' => 'required|email', //проверка на уникальность в таблице БД
            'password' => 'required',
        ];
        $this->validate($request, $rules); //или $request->validate([ 'массив валидационных правил' ]);
        //dd($request->all());
        if(Auth::attempt([
            'email' => $request->email,  //или $request->input('name');
            'password' => $request->password
        ])) {
            session()->flash('success', 'Success authentication');
            if (Auth::user()->is_admin) {
                return redirect()->route('admin.index');
            }
            else {
                return redirect()->home();
            }
        }
        return redirect()->back()->with('error', 'Логин или пароль неправильные'); //возвращаемся назад
        //выводим flash сообщение, что дата неверная
    }

    public function loginForm()
    {

        return view('user.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.create');
    }

    public function account()
    {
        $user = User::query()->where('email', auth()->user()->email)->firstOrFail();
        $comments = Comment::query()->where('user_id', Auth::id())->paginate(20);
        //позволяет обращаться напрямую к переменной user в шаблоне: $user->name
        //если используем get (получим массив) - придется писать так: $user[0]->name
        return view('user.account')->with('user', $user)->with('comments', $comments);
    }

    public function getUserList()
    {
        $users = User::query()->where('is_admin', 0)->paginate(20);
        return view('admin.users.index')->with('users', $users);
    }

    public function getData()
    {
        $user = User::query()->where('email', auth()->user()->email)->firstOrFail();
        //позволяет обращаться напрямую к переменной user в шаблоне: $user->name
        //если используем get (получим массив) - придется писать так: $user[0]->name
        return view('user.update')->with('user', $user);
    }

    public function updateData(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'name' => 'required',
            'password' => 'nullable|max:25|min:5'
        ]);

        try {
            $user = User::query()->find(auth()->user()->id);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password)
            {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            $request->session()->flash('success', 'Данные обновлены');
            return redirect()->back();
        }
        catch (Throwable $e) {
            return redirect()->back()->with('error', 'Что-то пошло не так'); //возвращаемся назад
        }
    }
}
