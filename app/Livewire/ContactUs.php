<?php

namespace App\Livewire;

use App\Models\Inquiry;
use Flux\Flux;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class ContactUs extends Component
{
    public $name;

    public $email;

    public $phone;

    public $message;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'phone' => 'nullable',
        'message' => 'required|min:10',
    ];

    public function submit()
    {
        $this->validate();

        Inquiry::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message,
        ]);

        // Or send an email notification
        // Mail::to(config('mail.from.address'))->send(new ContactMessage($this->name, $this->email, $this->phone, $this->message));

        $this->reset(['name', 'email', 'phone', 'message']);

        Flux::toast(
            heading: 'Contact Us',
            text: 'Contact message sent successfully!',
            variant: 'success',
        );
    }

    public function render()
    {
        return view('livewire.contact-us');
    }
}
