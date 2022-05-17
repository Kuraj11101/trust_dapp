<?php

namespace App\Models;

//use Illuminate\Auth\Authenticatable;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Bavix\Wallet\Traits\HasWallet;
use Bavix\Wallet\Traits\HasWallets;
use Bavix\Wallet\Interfaces\Wallet;
use Bavix\Wallet\Traits\CanPay;
use Bavix\Wallet\Interfaces\Customer;
//use Illuminate\Auth\Passwords\CanResetPassword;
//use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
//use Illuminate\Contracts\Auth\Authenticatable as AuthContract;
//use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
//use App\Notifications\PasswordResetNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
//use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Foundation\Auth\User as Authenticatable;

//use Laravel\Passport\HasApiTokens;

class User extends Authenticatable Implements MustVerifyEmail, Wallet, Customer
{
    use CanPay, HasWallets, HasWallet, Notifiable;
    //Authorizable, AuthorizableContract, Authenticatable, CanResetPassword, HasApiTokens, MustVerifyEmail,


    /**
     * The database table used by the model
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'username', 'email', 'email_verified_at',
        'password', 'remember_token', 'activated', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Create E wallet Attribute
     */

    public function createWallet()
    {

        $user = User::first();
        $last = User::orderBy('id', 'desc')->first(); //last user
        $first->getKey() !== $last->getKey(); //true

        $first->balance;//0
        $last->balance;//0

        $first->transfer($last, 0);
        $first->balance;
        $last->balance;

        $user->balance; //0
        $user->balanceInt; //int(0)


        // $firstWallet = $first->createWallet(['username' => 'First User Wallet']);
        // $lastWallet = $last->createWallet(['username' => 'Second User Wallet']);

        $user->deposit();
        $user->balance; //0
        $user->balanceInt; //int(0)

        $user->withdraw(0);
        $user->balance; //0
        $user->balanceInt;

        $user->balance;
        $user->wallet->refreshBalance();
        $user->balance;

        $user->hasWallet('my-wallet'); // bool(false)
        $wallet = $user->createWallet([
            'name' => 'New Wallet',
            'slug' => 'my-wallet',
        ]);

        $user->hasWallet('my-wallet'); // bool(true)

        $wallet->deposit(0);
        $wallet->balance; // 100

        $user->deposit(0);
        $user->balance;

        $myWallet = $user->getWallet('my-wallet');
        $myWallet->balance;

        $wallet = $user->wallet;
        $wallet->balance;

        $item = Item::first();
        $item->getAmountProduct($user);

        $user->pay($item);
        $user->balance;

        $user->balance;
        $user->pay($item);

        (bool)$user->paid($item);


    }

    // protected $hidden = ['password', 'remember_token'];

    //public function user() {
    //    return $this->belongsTo(User::class);
    //}

	public function getFullNameAttribute()
	{
		if (is_null($this->last_name)) {
			return "{$this->first_name}";
		}

		return "{$this->first_name} {$this->last_name}";
	}


}
