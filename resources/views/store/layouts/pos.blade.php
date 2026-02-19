<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Satış Ekranı') - DrDrink</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak]{display:none!important}
        .hidden { display: none !important; }
        :root {
            --pos-bg: #0f1419;
            --pos-bg-secondary: #1a2332;
            --pos-bg-card: #232f3e;
            --pos-accent: #f59e0b;
            --pos-accent-hover: #d97706;
            --pos-accent-soft: rgba(245, 158, 11, 0.15);
            --pos-text: #f8fafc;
            --pos-text-muted: #94a3b8;
            --pos-border: #334155;
            --pos-radius: 12px;
            --pos-radius-sm: 8px;
        }
        body.pos-page { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--pos-bg); color: var(--pos-text); margin: 0; min-height: 100vh; overflow: hidden; }
        .pos-app { display: grid; grid-template-columns: 1fr 380px; grid-template-rows: 64px 1fr; height: 100vh; }
        .pos-header { grid-column: 1 / -1; background: var(--pos-bg-secondary); border-bottom: 1px solid var(--pos-border); display: flex; align-items: center; justify-content: space-between; padding: 0 24px; z-index: 10; }
        .pos-header-left { display: flex; align-items: center; gap: 20px; }
        .pos-brand { display: flex; align-items: center; gap: 12px; }
        .pos-logo { width: 36px; height: 36px; background: linear-gradient(135deg, var(--pos-accent), var(--pos-accent-hover)); border-radius: var(--pos-radius-sm); display: flex; align-items: center; justify-content: center; font-size: 18px; }
        .pos-brand h1 { font-size: 1.25rem; font-weight: 700; letter-spacing: -0.02em; margin: 0; }
        .pos-mode-tabs { display: flex; gap: 4px; background: var(--pos-bg-card); padding: 4px; border-radius: var(--pos-radius-sm); border: 1px solid var(--pos-border); }
        .pos-mode-tab { padding: 8px 16px; border: none; background: transparent; color: var(--pos-text-muted); border-radius: 6px; font-size: 0.9rem; font-weight: 500; cursor: pointer; transition: all 0.2s; font-family: inherit; text-decoration: none; }
        .pos-mode-tab:hover { color: var(--pos-text); }
        .pos-mode-tab.active { background: var(--pos-accent-soft); color: var(--pos-accent); }
        .pos-header-meta { display: flex; align-items: center; gap: 20px; font-size: 0.875rem; color: var(--pos-text-muted); }
        .pos-time { font-variant-numeric: tabular-nums; font-weight: 500; color: var(--pos-text); }
        .pos-main { display: flex; flex-direction: column; overflow: hidden; background: var(--pos-bg); }
        .pos-categories { display: flex; gap: 8px; padding: 16px 24px; background: var(--pos-bg-secondary); border-bottom: 1px solid var(--pos-border); overflow-x: auto; flex-shrink: 0; }
        .pos-categories::-webkit-scrollbar { height: 4px; }
        .pos-categories::-webkit-scrollbar-thumb { background: var(--pos-border); border-radius: 2px; }
        .pos-cat-btn { padding: 10px 20px; border: 1px solid var(--pos-border); background: var(--pos-bg-card); color: var(--pos-text-muted); border-radius: var(--pos-radius-sm); font-size: 0.9rem; font-weight: 500; cursor: pointer; white-space: nowrap; transition: all 0.2s; font-family: inherit; }
        .pos-cat-btn:hover { color: var(--pos-text); border-color: var(--pos-accent); }
        .pos-cat-btn.active { background: var(--pos-accent-soft); color: var(--pos-accent); border-color: var(--pos-accent); }
        .pos-products-wrap { flex: 1; overflow-y: auto; padding: 20px 24px; }
        .pos-products-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); gap: 12px; }
        .pos-product-card { background: var(--pos-bg-card); border: 1px solid var(--pos-border); border-radius: var(--pos-radius); padding: 16px; cursor: pointer; transition: all 0.2s; display: flex; flex-direction: column; align-items: center; text-align: center; min-height: 120px; justify-content: space-between; }
        .pos-product-card:hover { border-color: var(--pos-accent); transform: translateY(-2px); box-shadow: 0 4px 24px rgba(0,0,0,0.4); }
        .pos-product-card .icon { font-size: 28px; margin-bottom: 8px; line-height: 1; }
        .pos-product-card .name { font-size: 0.9rem; font-weight: 600; margin-bottom: 4px; line-height: 1.2; }
        .pos-product-card .price { font-size: 0.95rem; font-weight: 700; color: var(--pos-accent); }
        .pos-cart-panel { background: var(--pos-bg-secondary); border-left: 1px solid var(--pos-border); display: flex; flex-direction: column; overflow: hidden; }
        .pos-cart-header { padding: 20px 24px; border-bottom: 1px solid var(--pos-border); display: flex; align-items: center; justify-content: space-between; }
        .pos-cart-header h2 { font-size: 1.1rem; font-weight: 700; margin: 0; }
        .pos-cart-count { background: var(--pos-accent-soft); color: var(--pos-accent); font-size: 0.8rem; font-weight: 600; padding: 4px 10px; border-radius: 20px; }
        .pos-cart-list { flex: 1; overflow-y: auto; padding: 16px; }
        .pos-cart-empty { display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 200px; color: var(--pos-text-muted); font-size: 0.9rem; text-align: center; padding: 20px; }
        .pos-cart-empty .empty-icon { font-size: 48px; margin-bottom: 12px; opacity: 0.5; }
        .pos-cart-item { display: grid; grid-template-columns: 1fr auto auto; align-items: center; gap: 12px; padding: 12px 14px; background: var(--pos-bg-card); border-radius: var(--pos-radius-sm); margin-bottom: 8px; border: 1px solid var(--pos-border); }
        .pos-cart-item .item-name { font-weight: 500; font-size: 0.95rem; }
        .pos-cart-item .item-qty { display: flex; align-items: center; gap: 6px; background: var(--pos-bg-secondary); border-radius: var(--pos-radius-sm); padding: 2px 4px; }
        .pos-cart-item .qty-btn { width: 28px; height: 28px; border: none; background: var(--pos-border); color: var(--pos-text); border-radius: 6px; font-size: 1.1rem; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background 0.2s; }
        .pos-cart-item .qty-btn:hover { background: var(--pos-accent); }
        .pos-cart-item .qty-num { min-width: 24px; text-align: center; font-weight: 600; font-size: 0.9rem; }
        .pos-cart-item .item-total { font-weight: 700; color: var(--pos-accent); min-width: 60px; text-align: right; }
        .pos-cart-footer { padding: 20px 24px; border-top: 1px solid var(--pos-border); background: var(--pos-bg-card); }
        .pos-cart-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px; font-size: 0.95rem; }
        .pos-cart-row .label { color: var(--pos-text-muted); }
        .pos-cart-row .value { font-weight: 600; color: var(--pos-text); }
        .pos-cart-row.highlight .value { font-size: 1.25rem; color: var(--pos-accent); }
        .pos-cart-actions { display: flex; flex-direction: column; gap: 10px; margin-top: 12px; }
        .pos-btn { padding: 14px 20px; border: none; border-radius: var(--pos-radius-sm); font-size: 1rem; font-weight: 600; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; justify-content: center; gap: 8px; font-family: inherit; width: 100%; }
        .pos-btn-primary { background: linear-gradient(135deg, var(--pos-accent), var(--pos-accent-hover)); color: #fff; }
        .pos-btn-primary:hover:not(:disabled) { filter: brightness(1.1); transform: translateY(-1px); }
        .pos-btn-primary:disabled { opacity: 0.5; cursor: not-allowed; transform: none; }
        .pos-btn-secondary { background: var(--pos-bg-secondary); color: var(--pos-text); border: 1px solid var(--pos-border); }
        .pos-btn-secondary:hover { border-color: var(--pos-accent); color: var(--pos-accent); }
        /* Ödeme modalı */
        .pos-modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.7); display: flex; align-items: center; justify-content: center; z-index: 100; padding: 20px; opacity: 0; visibility: hidden; pointer-events: none; transition: opacity 0.2s, visibility 0.2s; }
        .pos-modal-overlay.open { opacity: 1; visibility: visible; pointer-events: auto; }
        .pos-modal { background: var(--pos-bg-secondary); border: 1px solid var(--pos-border); border-radius: var(--pos-radius); width: 100%; max-width: 440px; max-height: 90vh; overflow: hidden; display: flex; flex-direction: column; box-shadow: 0 4px 24px rgba(0,0,0,0.4); transform: scale(0.95); transition: transform 0.2s; }
        .pos-modal-overlay.open .pos-modal { transform: scale(1); }
        .pos-modal-header { padding: 20px 24px; border-bottom: 1px solid var(--pos-border); display: flex; align-items: center; justify-content: space-between; }
        .pos-modal-header h3 { font-size: 1.2rem; font-weight: 700; margin: 0; }
        .pos-modal-close { background: none; border: none; color: var(--pos-text-muted); font-size: 1.5rem; cursor: pointer; padding: 0 4px; line-height: 1; }
        .pos-modal-close:hover { color: var(--pos-text); }
        .pos-modal-body { padding: 24px; overflow-y: auto; flex: 1; }
        .pos-form-group { margin-bottom: 18px; }
        .pos-form-group label { display: block; font-size: 0.85rem; font-weight: 500; color: var(--pos-text-muted); margin-bottom: 8px; }
        .pos-form-group select, .pos-form-group input { width: 100%; padding: 12px 14px; background: var(--pos-bg-card); border: 1px solid var(--pos-border); border-radius: var(--pos-radius-sm); color: var(--pos-text); font-size: 1rem; font-family: inherit; }
        .pos-form-group input:focus, .pos-form-group select:focus { outline: none; border-color: var(--pos-accent); }
        .pos-discount-options { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 8px; }
        .pos-discount-opt { padding: 10px 16px; border: 1px solid var(--pos-border); background: var(--pos-bg-card); color: var(--pos-text-muted); border-radius: var(--pos-radius-sm); font-size: 0.9rem; cursor: pointer; transition: all 0.2s; font-family: inherit; }
        .pos-discount-opt:hover { border-color: var(--pos-accent); color: var(--pos-accent); }
        .pos-discount-opt.active { background: var(--pos-accent-soft); color: var(--pos-accent); border-color: var(--pos-accent); }
        .pos-payment-summary { background: var(--pos-bg-card); border-radius: var(--pos-radius-sm); padding: 16px; margin-bottom: 20px; border: 1px solid var(--pos-border); }
        .pos-payment-summary .row { display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 0.95rem; }
        .pos-payment-summary .row.final { margin-top: 12px; padding-top: 12px; border-top: 1px solid var(--pos-border); font-size: 1.1rem; font-weight: 700; color: var(--pos-accent); }
        .pos-split-list { margin-bottom: 16px; }
        .pos-split-item { display: grid; grid-template-columns: 120px 1fr auto; gap: 10px; align-items: center; margin-bottom: 10px; }
        .pos-split-item select { padding: 10px 12px; background: var(--pos-bg-card); border: 1px solid var(--pos-border); border-radius: var(--pos-radius-sm); color: var(--pos-text); font-size: 0.9rem; font-family: inherit; }
        .pos-split-item input { padding: 10px 12px; background: var(--pos-bg-card); border: 1px solid var(--pos-border); border-radius: var(--pos-radius-sm); color: var(--pos-text); font-size: 1rem; font-family: inherit; text-align: right; }
        .pos-split-item .remove-split { background: none; border: none; color: #ef4444; cursor: pointer; padding: 8px; font-size: 1.2rem; line-height: 1; }
        .pos-split-item .remove-split:hover { color: #f87171; }
        .pos-add-split { padding: 10px 16px; border: 1px dashed var(--pos-border); background: transparent; color: var(--pos-text-muted); border-radius: var(--pos-radius-sm); font-size: 0.9rem; cursor: pointer; width: 100%; transition: all 0.2s; font-family: inherit; }
        .pos-add-split:hover { border-color: var(--pos-accent); color: var(--pos-accent); }
        .pos-payment-total-row { margin-top: 12px; padding: 12px; background: var(--pos-bg); border-radius: var(--pos-radius-sm); display: flex; justify-content: space-between; font-weight: 600; font-size: 1rem; }
        .pos-payment-total-row.ok { color: #22c55e; }
        .pos-payment-total-row.missing { color: #ef4444; }
        .pos-modal-footer { padding: 20px 24px; border-top: 1px solid var(--pos-border); }
        .pos-modal-footer .pos-btn { width: 100%; }
        /* Başarı toast */
        .pos-success-toast { position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 110; background: var(--pos-bg-secondary); border: 1px solid var(--pos-border); border-radius: var(--pos-radius); padding: 32px 40px; text-align: center; box-shadow: 0 8px 32px rgba(0,0,0,0.5); min-width: 320px; opacity: 0; visibility: hidden; pointer-events: none; transition: opacity 0.25s, visibility 0.25s; }
        .pos-success-toast.open { opacity: 1; visibility: visible; pointer-events: auto; }
        .pos-success-toast .icon-wrap { width: 56px; height: 56px; margin: 0 auto 16px; border-radius: 50%; background: rgba(34, 197, 94, 0.2); display: flex; align-items: center; justify-content: center; font-size: 28px; }
        .pos-success-toast h3 { font-size: 1.25rem; font-weight: 700; margin: 0 0 8px; color: var(--pos-text); }
        .pos-success-toast .order-no { font-size: 1rem; color: var(--pos-accent); font-weight: 600; margin-bottom: 20px; }
        .pos-success-toast .pos-btn { max-width: 160px; margin: 0 auto; }
        .pos-success-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.6); z-index: 105; opacity: 0; visibility: hidden; pointer-events: none; transition: opacity 0.25s, visibility 0.25s; }
        .pos-success-overlay.open { opacity: 1; visibility: visible; pointer-events: auto; }
        /* Paket Sipariş / Orders theme */
        .pos-orders-page { min-height: 100vh; background: var(--pos-bg); color: var(--pos-text); font-family: 'Plus Jakarta Sans', sans-serif; }
        .pos-orders-header { background: var(--pos-bg-secondary); border-bottom: 1px solid var(--pos-border); padding: 0 24px; height: 64px; display: flex; align-items: center; justify-content: space-between; }
        .pos-orders-content { padding: 24px; overflow-y: auto; flex: 1; }
        .pos-orders-card { background: var(--pos-bg-card); border: 1px solid var(--pos-border); border-radius: var(--pos-radius); overflow: hidden; }
        .pos-orders-table { width: 100%; border-collapse: collapse; }
        .pos-orders-table th { padding: 14px 20px; text-align: left; font-size: 0.75rem; font-weight: 600; color: var(--pos-text-muted); text-transform: uppercase; letter-spacing: 0.05em; background: var(--pos-bg-secondary); border-bottom: 1px solid var(--pos-border); }
        .pos-date-cell { color: var(--pos-text-muted) !important; font-size: 0.875rem; }
        @media (max-width: 1024px) { .pos-orders-table th.pos-date-cell, .pos-orders-table td.pos-date-cell { display: none !important; } }
        .pos-orders-table td { padding: 14px 20px; border-bottom: 1px solid var(--pos-border); color: var(--pos-text); }
        .pos-orders-table tbody tr:hover { background: rgba(245, 158, 11, 0.06); }
        .pos-orders-input { background: var(--pos-bg-card); border: 1px solid var(--pos-border); border-radius: var(--pos-radius-sm); padding: 10px 14px; color: var(--pos-text); font-size: 0.9rem; }
        .pos-orders-input:focus { outline: none; border-color: var(--pos-accent); }
        .pos-orders-input::placeholder { color: var(--pos-text-muted); }
        .pos-badge { padding: 4px 10px; border-radius: 6px; font-size: 0.75rem; font-weight: 600; }
        .pos-badge-pending { background: rgba(234, 179, 8, 0.2); color: #facc15; }
        .pos-badge-delivered { background: rgba(34, 197, 94, 0.2); color: #22c55e; }
        .pos-badge-cancelled { background: rgba(239, 68, 68, 0.2); color: #f87171; }
        .pos-badge-paid { background: rgba(34, 197, 94, 0.2); color: #22c55e; }
        .pos-badge-refunded { background: rgba(249, 115, 22, 0.2); color: #fb923c; }
        .pos-badge-default { background: rgba(148, 163, 184, 0.2); color: var(--pos-text-muted); }
        .pos-link { color: var(--pos-accent); text-decoration: none; font-weight: 500; transition: color 0.2s; }
        .pos-link:hover { color: #fbbf24; }
        .pos-orders-card nav[role="navigation"] a, .pos-orders-card nav[role="navigation"] span { color: var(--pos-text) !important; }
        .pos-orders-card nav[role="navigation"] a:hover { color: var(--pos-accent) !important; }
        .pos-orders-card nav[role="navigation"] .bg-amber-600 { background: var(--pos-accent) !important; color: #fff !important; }
        .pos-orders-card nav[role="navigation"] .border-gray-200 { border-color: var(--pos-border) !important; }
        .pos-orders-card nav[role="navigation"] .rounded-md { border-radius: var(--pos-radius-sm); }
        @media (max-width: 900px) {
            .pos-app { grid-template-columns: 1fr; grid-template-rows: auto 1fr auto; }
            .pos-cart-panel { max-height: 45vh; border-left: none; border-top: 1px solid var(--pos-border); }
        }
    </style>
</head>
<body class="pos-page">
    @yield('content')
    @stack('scripts')
</body>
</html>
