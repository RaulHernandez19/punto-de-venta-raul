<?php

namespace App\Livewire;

use App\Repo\UserRepo;
use Livewire\Component;
use Livewire\Attributes\Rule;

class UserCrud extends Component
{
    public $editando = false;
    protected $repo;

    public $name = '';
    public $email = '';
    public $password = '';
    public $user_id;

    public function rules()
        {
            return [
                'name' => 'required|min:4|max:255',
                'email' => 'required|email|max:255|unique:users,email' . ($this->editando ? ",$this->user_id" : ''),
                'password' => 'required|min:4|max:255',
            ];
        }

    public function boot(UserRepo $repo)
    {
        $this->repo = $repo;
    }

    public function saveUser()
{
    $this->validate(); // Ahora usa automáticamente rules()

    $data = [
        'name' => $this->name,
        'email' => $this->email,
        'password'=> $this->password
    ];

    if($this->editando) {
        $this->repo->edit($this->user_id, $data);
    } else {
        $this->repo->save($data);
    }

    $this->cancelEdit();
}

    public function editUser($id)
    {
        $this->editando = true;
        $this->user_id = $id;

        $user = $this->repo->getUser($id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = '';
    }

    public function deleteUser($id)
    {
        $this->repo->delete($id);
    }

    public function cancelEdit()
    {
        $this->reset(['editando', 'user_id', 'name', 'email', 'password']);
    }

    public function render()
    {
        return view('livewire.user-crud', [
            'users' => $this->repo->getAllNonAdmins()
        ])->layout('layouts.app');
    }
}
