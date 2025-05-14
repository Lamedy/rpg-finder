@extends('layouts.page_head')

@section('page_name', 'Создать анкету')

@section('content')
    <div>
        <div>
            <label for="playerType">Требуется:</label>
            <select name="playerType" id="playerType">
                <option value="master">Мастер</option>
                <option value="player">Игрок</option>
            </select>
        </div>

        <div>
            <label for="gameFormat">Формат игры:</label>
            <select name="gameFormat" id="gameFormat">
                <option value="online">Онлайн</option>
                <option value="offline">Оффлайн</option>
                <option value="notMater">Не важно</option>
            </select>
        </div>

        <div>
            Другие данные для формы - todo доделать форму позже
        </div>

        <button>Создать</button>
    </div>
@endsection
