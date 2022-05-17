<?php

namespace App\Traits;

use App\Logic\Activation\ActivationRepository;
use App\Models\User;
use App\Models\ActivationKey;
use Illuminate\Support\Facades\Validator;
use App\Notifications\ActivationKeyCreatedNotification;
use App\Mails\ActivationKeyCreated;

trait ActivationKeyTrait {

    public function queueActivationKeyNotification(User $user)
    {
        //check if we need to send anactivation email to the user. If not, we simply break
        if ( (config('settings.send_activation_email') == false) || ($this->validateEmail($user) == false)) {

            return true;
        }

        $this->createActivationKeyAndNotify($user);

    }

    public function validateEmail(User $user)
    {
        //Check that the user poses a valid email
        $validator = Validator::make(['email' => $user->email], ['email' => 'require|email']);

        if ($validator->fails()) {
            return false; // could not get a valid email
        }

        return true;
    }

    public function createActivationKeyAndNotify(User $user)
    {
        //if user is already activated, then there is nothing todo
        if ($user->activated) {
            return redirect ()->route('home')
            ->with('message', 'This account is already activate')
            ->with('status', 'success');
        }

        //Check to see if we already have an activation key for user. If so, use it. If not , create one
        $activationKey = activationKey::where('user_id', $user->id)->first();
        if(empty($activationKey)) {
            // Create new ActivationKey for this user/email
            $activationKey = new ActivationKey;
            $activationKey->user_id = $user->id;
            $activationKey->activation_key = str_random(64);
            $activationKey->save();
        }

        //send Activvation key notifcation
        //To do: In the future, you may want to queue the mail since sending the mail  can slow down the response
        $user->notify(new ActivationKeyCreatedNotification($activationKey));
    }

    public function processActivationKey(ActivationKey $activationKey) {
        // get the user associated to this activation key
        $userToActivate = User::where('id', $activationKey->user_id)
            ->first();

            if (empty($userToActivate)) {
                return redirect ()->route('home')
                ->with('message', 'We could not find a user with this activation key! Please register to get a valid key')
                ->with('status', 'success');
            }


            // set the user to activated
            $userToActivate->activated = true;
            $userToActivate->save();

            //delet the activation key
            $activationKey->delete();
        //}

    }

}