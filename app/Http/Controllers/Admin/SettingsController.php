<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function index(): View
    {
        $settings = [
            'site_name' => Setting::get('site_name', config('app.name')),
            'site_description' => Setting::get('site_description', ''),
            'contact_email' => Setting::get('contact_email', ''),
            'contact_phone' => Setting::get('contact_phone', ''),
            'currency' => Setting::get('currency', 'TRY'),
            'order_notification_sound' => (bool) Setting::get('order_notification_sound', '0'),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string|max:500',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string|max:50',
            'currency' => 'required|string|in:TRY,USD,EUR',
            'order_notification_sound' => 'nullable|in:0,1',
        ]);

        Setting::set('site_name', $request->site_name);
        Setting::set('site_description', $request->site_description ?? '');
        Setting::set('contact_email', $request->contact_email ?? '');
        Setting::set('contact_phone', $request->contact_phone ?? '');
        Setting::set('currency', $request->currency);
        Setting::set('order_notification_sound', $request->has('order_notification_sound') ? '1' : '0');

        return redirect()->route('admin.settings.index')->with('success', 'Genel ayarlar güncellendi.');
    }
}
