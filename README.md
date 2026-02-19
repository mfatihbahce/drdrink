# DrDrink - Online Sipariş Sistemi

Kütahya merkezli DrDrink firması için çok şubeli online kahve ve içecek sipariş platformu.

## Gereksinimler

- PHP 8.2+
- Composer
- MySQL
- Node.js & NPM (frontend için)

## Kurulum

1. **Veritabanı**: phpMyAdmin'de `drdrink` veritabanını oluşturun (zaten oluşturulmuş olabilir)

2. **Bağımlılıklar**:
```bash
composer install
npm install
```

3. **Ortam Değişkenleri**:
```bash
cp .env.example .env
php artisan key:generate
```

4. **.env dosyasında veritabanı ayarları**:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=drdrink
DB_USERNAME=root
DB_PASSWORD=
```

5. **Veritabanı**:
```bash
php artisan migrate
php artisan db:seed
```

6. **Frontend build**:
```bash
npm run build
```

7. **XAMPP ile çalıştırma**: Projeyi `c:\xampp\htdocs\drdrink` konumuna koyun ve tarayıcıdan `http://localhost/drdrink/public` adresine gidin.

   Veya `php artisan serve` ile: `http://localhost:8000`

## Varsayılan Hesaplar

- **Admin**: admin@drdrink.com / password123
- **Yönetici**: yonetici@drdrink.com / password123

## Özellikler

### Müşteri Tarafı
- One-page firma tanıtım sayfası
- Hizmet verilen illerden il seçimi
- İl bazlı ürün listesi (örn: /siparis/kutahya/urunler)
- Kayıt ol / Giriş yap
- Sepete ürün ekleme
- Online ödeme (iyzico - yapılandırma gerekli)
- Sipariş takibi

### Admin Paneli (/admin)
- Dashboard (bugünkü ve bekleyen siparişler)
- Sipariş listesi ve detay
- Manuel sipariş durumu güncelleme (Beklemede, Hazırlanıyor, Kurye Atandı, Yolda, Teslim Edildi)
- Yeni sipariş bildirimi (dashboard açıkken 15 saniyede bir kontrol)
- Rol tabanlı yetkilendirme (Spatie Permission)
- Activity log (Spatie Activity Log)

## iyzico Ödeme Kurulumu

`.env` dosyasına ekleyin:
```
IYZICO_API_KEY=your_api_key
IYZICO_SECRET_KEY=your_secret_key
IYZICO_BASE_URL=https://sandbox-api.iyzipay.com
```

- Sandbox (test) için: `IYZICO_BASE_URL=https://sandbox-api.iyzipay.com`
- Canlı için: `IYZICO_BASE_URL=https://api.iyzipay.com`
- API anahtarlarını iyzico panelinden alın

## Sipariş Durumları

- **Beklemede**: Yeni sipariş
- **Onaylandı**: Sipariş onaylandı
- **Hazırlanıyor**: Ürünler hazırlanıyor
- **Kurye Atandı**: Kurye siparişi aldı
- **Yolda**: Teslimat yapılıyor
- **Teslim Edildi**: Sipariş tamamlandı
- **İptal Edildi**: Sipariş iptal

## Mobil Uyumluluk

Tüm sayfalar responsive tasarımlıdır (Tailwind CSS).
