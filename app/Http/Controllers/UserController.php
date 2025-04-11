<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use App\Traits\CustomLogTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Alert;
use App\Models\Package;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Attribute\Cache;
use App\Http\Controllers\ClubSwanController;
use App\Models\Project;
use App\Models\Theme;

class UserController extends Controller
{
    use CustomLogTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth()->user()->id;

        $user = User::find($id);

        $wallet = Wallet::where('user_id', $id)->latest()->first();

        $user->wallet = $wallet->wallet ?? null;

        return view('user.myinfo', compact('user'));
    }

    public function theme()
    {
        $themeUser = Theme::find(auth()->user()->theme_id);
        $themes = Theme::with('project')->get();

        return view('user.theme', compact('themes', 'themeUser'));
    }

    public function changeTheme(Request $request)
    {
        User::where('id', auth()->user()->id)->update(['theme_id' => $request->theme]);

        return redirect()->route('users.theme');
    }

    public function password()
    {
        return view('user.password');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->only([
            'name',
            'password',
            'last_name',
            'birthday',
            'address1',
            'address2',
            'postcode',
            'state',
            'city',
            'gender',
            'email',
            'telephone',
            'cell',
            'country',
        ]);

        try {

            if ($request->hasFile('image')) {
                $images = $request->file('image')->store('user', 'public');
                $data['image_path'] = $images;
            }

            $user = User::find($id);

            if (!Hash::check($request->get('password'), $user->password)) {
                Alert::error(__('backoffice_alert.current_password_is_not_correct'));
                return redirect()->back();
            }

            if (!empty($request->get('wallet'))) {
                $datawallet = [
                    "wallet" => $request->get('wallet'),
                    "description" => "wallet"
                ];

                // $exists = Wallet::where('user_id', $id)->first();
                // if (isset($exists)) {
                //    $user->wallet()->update($datawallet);
                // } else {
                //    $user->wallet()->create($datawallet);
                // }


                $datawallet = [
                    "wallet" => $request->get('wallet'),
                    "description" => "wallet"
                ];
                $user->wallet()->create($datawallet);
            }



            $club = new ClubSwanController;
            $clubResponse = NULL;
            if ($user->contact_id == NULL) {
                $clubResponse = $club->singUp($data);
                if ($clubResponse->status == 'success') {
                    $data['contact_id'] = $clubResponse->data->contactId;
                }
                //  else {
                // throw new Exception(json_encode($clubResponse));

                // }
            }

            unset($data['password']);

            $user->update($data);


            $this->createLog('User updated successfully', 200, 'success', auth()->user()->id);

            if ($clubResponse == NULL) {
                Alert::success(__('backoffice_alert.user_update'));
            }
            return redirect()->route('users.index');
        } catch (Exception $e) {
            $error = json_decode($e->getMessage(), true);
            if (isset($error['status']) && $error['status'] == 'fail') {
                $this->errorCatch($error['message'] . ' - PayLoad: ' . json_encode($data) . ' - Response: ' . $e->getMessage(), auth()->user()->id);
                $q = '';
                if ($error['message'] == 'Invalid parameter(s)') {
                    foreach ($error['data']['invalid-params'] as $value) {
                        $q .= '<br>' . $value;
                    }
                }
                Alert::error($error['message'] . $q);
            } else {
                $this->errorCatch($e->getMessage(), auth()->user()->id);
                Alert::error(__('backofffice_alert.user_not_update'));
            }
            return redirect()->route('users.index');
        }
    }
    public function updateBinaryPositionIndication(Request $request)
    {
        User::where('id', auth()->user()->id)->update(['perna_cad' => $request['position']]);
        return response()->json('success');
    }
    public function changePassword(Request $request)
    {
        $data = $request->only([
            'password',
            'old_password'
        ]);

        try {
            $id = auth()->user()->id;

            $user = User::find($id);
            if (!Hash::check($data['old_password'], $user->password)) {
                Alert::error(__('backoffice_alert.current_password_is_not_correct'));
                return redirect()->back();
            }

            $password = Hash::make($data['password']);

            $user->update([
                'password' => $password
            ]);
            $this->createLog('Password updated successfully', 200, 'success', auth()->user()->id);
            Alert::success(__('backoffice_alert.password_changed'));
            return redirect()->route('users.password');
        } catch (Exception $e) {
            $this->errorCatch($e->getMessage(), auth()->user()->id);
            Alert::error(__('backoffice_alert.password_not_changed'));

            return redirect()->route('users.password');
        }
    }

    public function register($project_id, $id)
    {
        Auth::logout();

        $packages = Package::where('activated', 1)->where('type', '!=', 'activator')->orderBy('price')->get();
        $project = Project::find($project_id);
        $user = User::where('id', $id)->orWhere('login', $id)->first();
        if (!isset($user)) {
            Alert::error('User not found!');
            return view('auth.register_must_active');
        } else {
            return view('auth.register_indication', compact('id', 'packages', 'user','project'));
        }
    }
}
