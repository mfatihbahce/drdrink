# cPanel Kurulum Rehberi

## Yöntem 1: Document Root'u public Klasörüne Ayarla (ÖNERİLEN)

1. Laravel projesini FTP/File Manager ile yükleyin (örn: `public_html/drdrink/`)
2. cPanel → **Domains** → **Domains** → domain adınız → **Manage** → **Document Root**
3. Document Root'u şu şekilde değiştirin: `public_html/drdrink/public`
4. Kaydedin

Bu yöntem en temiz çözümdür.

---

## Yöntem 2: Laravel'i public_html Dışına Taşı

1. **File Manager** ile `public_html` ile aynı seviyede `drdrink` klasörü oluşturun
   - Yol: `/home/KULLANICI/drdrink/` (KULLANICI = cPanel kullanıcı adınız)

2. Laravel dosyalarını (app, bootstrap, config, database, public, resources, routes, storage, vendor, .env, artisan, composer.json) `drdrink` klasörüne yükleyin

3. `deploy/cpanel/` içindeki `index.php` ve `.htaccess` dosyalarını `public_html/` içine kopyalayın

4. Eğer `drdrink` farklı bir isimdeyse, `index.php` içindeki `drdrink` yollarını güncelleyin

---

## Yöntem 3: Alt Klasör (site.com/drdrink)

Proje `public_html/drdrink/` içindeyse:

1. `public_html/drdrink/.htaccess` dosyasına `RewriteBase /drdrink/` ekleyin:

```
RewriteEngine On
RewriteBase /drdrink/

RewriteRule ^(build|images|css|js|fonts|storage|videos)/(.*)$ public/$1/$2 [L,NC]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^ index.php [L]
```

2. `.env` dosyasında: `APP_URL=https://siteniz.com/drdrink`

---

## Kontrol Listesi

- [ ] `.env` dosyası yüklendi (veya .env.example'dan oluşturuldu)
- [ ] `php artisan key:generate` çalıştırıldı
- [ ] `storage` ve `bootstrap/cache` klasörleri 775 izinli
- [ ] PHP 8.1+ seçili (cPanel → Select PHP Version)
- [ ] `composer install --no-dev` çalıştırıldı (vendor klasörü yoksa)
