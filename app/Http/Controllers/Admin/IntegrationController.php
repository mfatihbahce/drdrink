<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IntegrationController extends Controller
{
    public function index(): View
    {
        return view('admin.integrations.index');
    }

    public function iyzico(): View
    {
        $apiKey = Setting::get('iyzico_api_key') ?? config('services.iyzico.api_key');
        $secretKey = Setting::get('iyzico_secret_key') ?? config('services.iyzico.secret_key');
        $baseUrl = Setting::get('iyzico_base_url') ?? config('services.iyzico.base_url');

        return view('admin.integrations.iyzico', compact('apiKey', 'secretKey', 'baseUrl'));
    }

    public function updateIyzico(Request $request): RedirectResponse
    {
        $request->validate([
            'api_key' => 'required|string|max:255',
            'secret_key' => 'required|string|max:255',
            'base_url' => 'required|string|in:https://sandbox-api.iyzipay.com,https://api.iyzipay.com',
        ]);

        Setting::set('iyzico_api_key', $request->api_key);
        Setting::set('iyzico_secret_key', $request->secret_key);
        Setting::set('iyzico_base_url', $request->base_url);

        return redirect()->route('admin.integrations.iyzico')->with('success', 'İyzico ayarları güncellendi.');
    }
}
