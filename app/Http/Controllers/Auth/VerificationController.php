<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\SmsServices;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('signed')->only('verify');
        // $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    # Show the verification form. 
    public function show(Request $request)
    {
        if (session('login_with') == "phone") {
            return $request->user()->hasVerifiedEmail() ? redirect($this->redirectPath()) : redirect()->route('verification.phone');
        }
        return $request->user()->hasVerifiedEmail() ? redirect($this->redirectPath()) : view('auth.verify');
    }

    # resend verification email
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        $request->user()->sendVerificationNotification();

        return back()->with('resent', true);
    }

    # set as verified
    public function verification_confirmation($code)
    {
        $user = User::where('verification_code', $code)->first();
        if ($user != null) {
            $user->email_or_otp_verified = 1;
            $user->email_verified_at = Carbon::now();
            $user->save();
            auth()->login($user, true);
            flash(localize('Your account has been verified successfully'))->success();
        } else {
            flash(localize('Sorry, we could not verify you. Please try again'))->error();
        }

        return redirect()->route('customers.dashboard');
    }
    public function phone_verification_confirmation(Request $request)
    {
        $user = User::where('verification_code', $request->verification_code)->first();
        if ($user != null) {
            $user->email_or_otp_verified = 1;
            $user->email_verified_at = Carbon::now();
            $user->save();
            auth()->login($user, true);
            // flash(localize('Your account has been verified successfully'))->success();
        } else {
            // flash(localize('Sorry, we could not verify you. Please try again'))->error();
            return 0;
        }

        return 1;
    }

    # show phone verification form
    public function verifyPhone()
    {
        $user = auth()->user();
        $user->verification_code = rand(100000, 999999);
        $user->save();

        $this->sendOtp($user->phone, $user->verification_code);
        return view('auth.phoneVerify', compact('user'));
    }

    # show phone verification form
    public function sendotpPhone(Request $request)
    {
        $phone = $request->phone;
        $user = User::where('phone', $phone)->first();
        if (is_null($user)) {
            flash(localize('User not found with this phone number'))->error();
            return 0;
        }

        $user->verification_code = rand(100000, 999999);
        $user->save();

        $this->sendOtpRest($user->phone, $user->verification_code);
        return $user->verification_code;
    }

    public function sendOtpRest($phone, $otp)
    {
        // dd($request->phone());
        $id = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $url = "https://api.twilio.com/2010-04-01/Accounts/$id/Messages.json";
        $from = env('VALID_TWILIO_NUMBER');
        $to = $phone; // twilio trial verified number
        $body = env('APP_NAME') . " login verification otp is :" . $otp;
        $data = array (
            'From' => $from,
            'To' => $to,
            'Body' => $body,
        );
        $post = http_build_query($data);
        $x = curl_init($url);
        curl_setopt($x, CURLOPT_POST, true);
        curl_setopt($x, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($x, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($x, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($x, CURLOPT_USERPWD, "$id:$token");
        curl_setopt($x, CURLOPT_POSTFIELDS, $post);
        $y = curl_exec($x);
        curl_close($x);
        // var_dump($post);
        // var_dump($y);
        return 1;

    }

    # send otp
    public function sendOtp($phone, $otp)
    {
        (new SmsServices)->phoneVerificationSms($phone, $otp);
        flash(localize('A verification code has been sent to your phone.'))->info();
    }

    # set as verified
    // public function phone_verification_confirmation(Request $request)
    // {
    //     return $this->verification_confirmation($request->verification_code);
    // }
}
