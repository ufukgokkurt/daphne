
# Daphne Admin Panel
<p>Üye girişi, şifremi unuttum, üye ekleme-güncelleme-silme, Rol ekleme-güncelleme-silme, profil düzenleme, mail ayarları, site genel ayarları ve yetki denetimi ile sayfa erişim kısıtlaması içeren admin paneli örneğidir. Authentication işlemleri için  Laravel'in standart Auth paketi yerine  <a href="https://github.com/cartalyst/sentinel">Sentinel</a> paketi kullanılmıştır.</p>

### Kurulum
<pre>git clone https://github.com/ufukgokkurt/daphne.git</pre>
<pre>composer update</pre>
<pre>php artisan key:generate</pre>
<pre>php artisan migrate</pre>
<pre>php artisan db:seed</pre>
### Admin Bilgileri
<p>http://domain.app/admin</p>
<p>Admin: admin@admin.com  Şifre: 123456 </p>
<p><b>Not:</b> İzinler <i>config/genel_ayarlar.php</i> dosyasında yer almaktadır.</p>
<p><b>Kullanılan Tema:</b> <a href="https://github.com/puikinsh/gentelella">Gentelella Admin Theme</a></p>
