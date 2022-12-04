<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ContactForm extends Component
{
    /**
     * @var string
     */
    public string $first_name = '';

    /**
     * @var string
     */
    public string $last_name = '';

    /**
     * @var string
     */
    public string $email = '';

    /**
     * @var string
     */
    public string $phone = '';

    /**
     * @var string
     */
    public string $object = '';

    /**
     * @var string
     */
    public string $message = '';

    /**
     * @var array
     */
    protected $rules = [
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'email' => 'required|email',
        'object' => 'required',
        'message' => 'required',
    ];

    /**
     * @return void
     */
    public function save(): void
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.contact-form', ['objects' => ['Assistance commande', 'Demande d\'informations', 'Problème technique', 'Réclamation', 'Désabonnement']]);
    }
}
