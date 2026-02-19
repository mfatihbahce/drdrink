# cPanel Production .env Ayarları

500 hatası `handleRequest()` sırasında oluşuyorsa, genelde **session** veya **cache** veritabanına bağlanmaya çalışıyor ve başarısız oluyor.

## Hızlı Çözüm

Sunucudaki `.env` dosyasında şu satırları değiştirin:

```
SESSION_DRIVER=file
CACHE_STORE=file
```

Eğer `SESSION_DRIVER=database` veya `CACHE_STORE=database` ise, MySQL bağlantısı veya `sessions`/`cache` tabloları eksikse 500 hatası verir.

## Tam Production .env Örneği

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://drdrink.com.tr

SESSION_DRIVER=file
CACHE_STORE=file

# Veritabanı - cPanel MySQL bilgilerinizle doldurun
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=cpanel_db_adi
DB_USERNAME=cpanel_db_kullanici
DB_PASSWORD=cpanel_db_sifre
```

## Kontrol

1. `.env` güncelledikten sonra cache temizleyin (SSH varsa):
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

2. Veya `storage/framework/` içindeki `config.php` ve `cache` dosyalarını silin (File Manager ile)
