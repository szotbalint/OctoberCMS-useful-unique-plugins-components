<?php namespace Szb\Contact\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Redirect as FacadesRedirect;
use Input;
use Mail;
use Redirect;
use Validator;
use ValidationException;
use RedirectResponse;
use October\Rain\Support\Facades\Flash;

class ContactForm extends ComponentBase
{

    
    public function SuccessRedirect() {
        return Redirect::to('/');

    }

    public function componentDetails() {
        return [
            'name' => 'Contact Form',
            'description' => 'Simple contact form'
        ];
    }

    public function onSend(){

        $data = post();

        $rules = [
            'phone' => 'required|min:6',
            'email' => 'required|email'
        ];

        $validator = Validator::make($data, $rules);

        if($validator->fails()){
            throw new ValidationException($validator);
        } else {
            $vars = ['name' => Input::get('username'), 'email' => Input::get('email'), 'phone' => Input::get('phone'), 'subject' => Input::get('subject'),'content' => Input::get('content')];

            Mail::send('Szb.contact::mail.message', $vars, function($message) {

                $message->to('info@jasz-butor.hu', 'Jászbútor');
                $message->subject('Új üzenet a jasz-butor.hu-ról');
            });

            Flash::success('Üzenet elküldve');

            SuccessRedirect();
        }   
     }

    }