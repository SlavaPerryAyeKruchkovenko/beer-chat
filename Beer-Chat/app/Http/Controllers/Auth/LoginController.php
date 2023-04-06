<?php

    namespace App\Http\Controllers\Auth;

    use App\Http\Controllers\Controller;
    use App\Providers\RouteServiceProvider;
    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Contracts\View\Factory;
    use Illuminate\Contracts\View\View;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Routing\Redirector;
    use Illuminate\Support\Facades\Log;
    use \Illuminate\Validation\ValidationException;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class LoginController extends Controller
    {
        public function create(): Factory|View|Application
        {
            return view('auth/login');
        }

        public function store(Request $request): RedirectResponse
        {
            $request->validate(
                [
                    'email' => ['required', 'string', 'email'],
                    'password' => ['required', 'string'],
                ]
            );
            if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
                throw ValidationException::withMessages(
                    [
                        'email' => trans('auth.failed')
                    ]
                );
            }
            try {
                $request->session()->regenerate();
                return redirect()->intended(RouteServiceProvider::MESSENGER);
            } catch (\Exception $ex) {
                Log::info("token not change");
                abort(501);
            }
            return back();
        }

        public function destroy(): Redirector|Application|RedirectResponse|string
        {
            try {
                Auth::logout();
                return redirect(RouteServiceProvider::HOME);
            } catch (\Exception $ex) {
                Log::error($ex);
                abort(405);
            }
            return "error";
        }
    }
